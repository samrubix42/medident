<?php

use App\Imports\ReviewsImport;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;

new #[Layout('layouts::admin')] #[Title('Reviews')] class extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $file;

    public string $search = '';

    public int $perPage = 10;

    public ?int $lastImportCount = null;

    public ?int $lastSkippedCount = null;

    public ?string $statusMessage = null;

    public bool $showDeleteModal = false;

    public ?int $reviewIdBeingDeleted = null;

    /**
     * @return LengthAwarePaginator<int, Review>
     */
    #[Computed]
    public function reviews(): LengthAwarePaginator
    {
        $search = trim($this->search);

        return Review::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('author_title', 'like', "%{$search}%")
                        ->orWhere('review_text', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('place_id', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('review_datetime_utc')
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }

    #[Computed]
    public function reviewToDelete(): ?Review
    {
        if (! $this->reviewIdBeingDeleted) {
            return null;
        }

        return Review::find($this->reviewIdBeingDeleted);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function import(): void
    {
        abort_unless(auth()->check(), 403);

        $this->validate([
            'file' => ['required', 'file', 'extensions:csv,txt,json,xlsx', 'max:10240'],
        ]);

        $this->lastImportCount = null;
        $this->lastSkippedCount = null;
        $this->statusMessage = null;

        try {
            $rows = $this->readRows($this->file->getRealPath(), $this->file->getClientOriginalExtension());
        } catch (Throwable $exception) {
            report($exception);

            $this->addError('file', 'The file could not be read. Please check the file and try again.');

            return;
        }

        if ($rows === []) {
            $this->addError('file', 'The file does not contain any review rows.');

            return;
        }

        $timestamp = now()->toDateTimeString();
        $records = [];
        $skipped = 0;

        foreach ($rows as $row) {
            $record = $this->normalizeRow($row);

            if ($record === null) {
                $skipped++;

                continue;
            }

            $records[] = $record + [
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        if ($records === []) {
            $this->addError('file', 'No valid reviews were found in the file.');

            return;
        }

        $updateColumns = array_values(array_diff(array_keys($records[0]), ['review_id', 'created_at']));

        foreach (array_chunk($records, 500) as $chunk) {
            Review::upsert($chunk, ['review_id'], $updateColumns);
        }

        $this->lastImportCount = count($records);
        $this->lastSkippedCount = $skipped;
        $this->statusMessage = 'Reviews imported successfully.';
        $this->reset('file');
        $this->resetPage();
    }

    public function confirmDelete(int $reviewId): void
    {
        $this->reviewIdBeingDeleted = $reviewId;
        $this->showDeleteModal = true;
        $this->statusMessage = null;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->reviewIdBeingDeleted = null;
    }

    public function deleteReview(): void
    {
        abort_unless(auth()->check(), 403);

        if (! $this->reviewIdBeingDeleted) {
            return;
        }

        Review::whereKey($this->reviewIdBeingDeleted)->delete();

        $this->cancelDelete();
        $this->statusMessage = 'Review deleted successfully.';
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readRows(string $path, string $extension): array
    {
        return match (strtolower($extension)) {
            'json' => $this->readJsonRows($path),
            'xlsx' => $this->readXlsxRows($path),
            default => $this->readCsvRows($path),
        };
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readCsvRows(string $path): array
    {
        $handle = fopen($path, 'rb');

        if ($handle === false) {
            return [];
        }

        $headers = fgetcsv($handle, 0, ',', '"', '');

        if ($headers === false) {
            fclose($handle);

            return [];
        }

        $headers = $this->normalizeHeaders($headers);
        $rows = [];

        while (($values = fgetcsv($handle, 0, ',', '"', '')) !== false) {
            if ($this->isEmptyRow($values)) {
                continue;
            }

            $values = array_pad($values, count($headers), null);
            $rows[] = array_combine($headers, array_slice($values, 0, count($headers)));
        }

        fclose($handle);

        return $rows;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readJsonRows(string $path): array
    {
        $contents = file_get_contents($path);
        $decoded = $contents === false ? null : json_decode($contents, true);

        if (! is_array($decoded)) {
            return [];
        }

        if (array_is_list($decoded)) {
            return array_values(array_filter($decoded, 'is_array'));
        }

        $rows = $decoded['reviews'] ?? $decoded['items'] ?? null;

        if (is_array($rows)) {
            return array_values(array_filter($rows, 'is_array'));
        }

        return [$decoded];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readXlsxRows(string $path): array
    {
        $import = new ReviewsImport;
        Excel::import($import, $path, null, ExcelType::XLSX);

        return array_values(array_filter(
            $import->rows,
            fn (array $row): bool => ! $this->isEmptyRow(array_values($row)),
        ));
    }

    /**
     * @param  array<int, mixed>  $values
     */
    private function isEmptyRow(array $values): bool
    {
        foreach ($values as $value) {
            if ($value !== null && trim((string) $value) !== '') {
                return false;
            }
        }

        return true;
    }

    /**
     * @param  array<int, mixed>  $headers
     * @return array<int, string>
     */
    private function normalizeHeaders(array $headers): array
    {
        $normalized = [];
        $seen = [];

        foreach ($headers as $index => $header) {
            $header = ltrim((string) $header, "\xEF\xBB\xBF");
            $key = $this->normalizeKey($header);

            if ($key === '') {
                $key = 'column_'.$index;
            }

            if (isset($seen[$key])) {
                $key .= '_'.$index;
            }

            $seen[$key] = true;
            $normalized[] = $key;
        }

        return $normalized;
    }

    private function normalizeKey(string $key): string
    {
        return Str::of($key)
            ->trim()
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/', '_')
            ->trim('_')
            ->toString();
    }

    /**
     * @param  array<string, mixed>  $row
     * @return array<string, mixed>|null
     */
    private function normalizeRow(array $row): ?array
    {
        $data = [];

        foreach ($row as $key => $value) {
            $data[$this->normalizeKey((string) $key)] = is_string($value) ? trim($value) : $value;
        }

        $reviewText = $this->stringOrNull($data['review_text'] ?? null);
        $authorTitle = $this->stringOrNull($data['author_title'] ?? null);
        $reviewId = $this->stringOrNull($data['review_id'] ?? null);
        $reviewTimestamp = $this->integerOrNull($data['review_timestamp'] ?? null);

        if ($reviewId === null) {
            $reviewId = sha1(implode('|', [
                $this->stringOrNull($data['author_id'] ?? null),
                $authorTitle,
                $reviewTimestamp,
                $reviewText,
            ]));
        }

        if ($reviewText === null && $authorTitle === null) {
            return null;
        }

        if (mb_strlen($reviewId) > 255) {
            $reviewId = sha1($reviewId);
        }

        $reviewsPerScore = $this->arrayOrNull($data['reviews_per_score'] ?? null);
        $reviewImgUrls = $this->arrayOrNull($data['review_img_urls'] ?? null);
        $reviewRating = $this->integerOrNull($data['review_rating'] ?? null);
        $reviewLikes = $this->integerOrNull($data['review_likes'] ?? null);

        return [
            'name' => $this->stringOrNull($data['name'] ?? null),
            'google_id' => $this->stringOrNull($data['google_id'] ?? null),
            'place_id' => $this->stringOrNull($data['place_id'] ?? null),
            'location_link' => $this->urlOrNull($data['location_link'] ?? null),
            'reviews_link' => $this->urlOrNull($data['reviews_link'] ?? null),
            'reviews_per_score' => $this->jsonOrNull($reviewsPerScore),
            'rating' => $this->floatOrNull($data['rating'] ?? null),
            'review_id' => $reviewId,
            'review_pagination_id' => $this->stringOrNull($data['review_pagination_id'] ?? null),
            'author_link' => $this->urlOrNull($data['author_link'] ?? null),
            'author_title' => $authorTitle,
            'author_id' => $this->stringOrNull($data['author_id'] ?? null),
            'author_image' => $this->urlOrNull($data['author_image'] ?? null),
            'review_text' => $reviewText,
            'review_img_urls' => $this->jsonOrNull($reviewImgUrls),
            'review_img_url' => $this->urlOrNull($data['review_img_url'] ?? null),
            'owner_answer' => $this->stringOrNull($data['owner_answer'] ?? null),
            'owner_answer_timestamp' => $this->integerOrNull($data['owner_answer_timestamp'] ?? null),
            'owner_answer_timestamp_datetime_utc' => $this->dateTimeOrNull($data['owner_answer_timestamp_datetime_utc'] ?? null),
            'review_link' => $this->urlOrNull($data['review_link'] ?? null),
            'review_rating' => $reviewRating === null ? null : max(0, min(255, $reviewRating)),
            'review_timestamp' => $reviewTimestamp,
            'review_datetime_utc' => $this->dateTimeOrNull($data['review_datetime_utc'] ?? null),
            'review_likes' => max(0, $reviewLikes ?? 0),
            'reviews_id' => $this->stringOrNull($data['reviews_id'] ?? null),
        ];
    }

    private function stringOrNull(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return in_array(strtolower($value), ['', 'null'], true) ? null : $value;
    }

    private function integerOrNull(mixed $value): ?int
    {
        $value = $this->stringOrNull($value);

        return $value !== null && is_numeric($value) ? (int) $value : null;
    }

    private function floatOrNull(mixed $value): ?float
    {
        $value = $this->stringOrNull($value);

        return $value !== null && is_numeric($value) ? (float) $value : null;
    }

    private function urlOrNull(mixed $value): ?string
    {
        $value = $this->stringOrNull($value);

        if ($value === null || ! filter_var($value, FILTER_VALIDATE_URL)) {
            return null;
        }

        $scheme = strtolower((string) parse_url($value, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https'], true) ? $value : null;
    }

    private function dateTimeOrNull(mixed $value): ?string
    {
        $value = $this->stringOrNull($value);

        if ($value === null) {
            return null;
        }

        if (is_numeric($value) && strlen($value) >= 13) {
            return Carbon::createFromTimestampMs((int) $value, 'UTC')->format('Y-m-d H:i:s');
        }

        if (is_numeric($value) && strlen($value) >= 10) {
            return Carbon::createFromTimestamp((int) $value, 'UTC')->format('Y-m-d H:i:s');
        }

        if (is_numeric($value) && strlen($value) >= 5 && (float) $value < 100000) {
            $seconds = (float) $value * 86400;

            return Carbon::create(1899, 12, 30, 0, 0, 0, 'UTC')
                ->addSeconds((int) round($seconds))
                ->format('Y-m-d H:i:s');
        }

        try {
            return Carbon::parse($value)->utc()->format('Y-m-d H:i:s');
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @return array<int|string, mixed>|null
     */
    private function arrayOrNull(mixed $value): ?array
    {
        if (is_array($value)) {
            return $value;
        }

        $value = $this->stringOrNull($value);

        if ($value === null) {
            return null;
        }

        $decoded = json_decode($value, true);

        if (is_array($decoded)) {
            return $decoded;
        }

        $items = array_values(array_filter(
            array_map('trim', preg_split('/[\r\n,]+/', $value) ?: []),
            fn (string $item): bool => $item !== '',
        ));

        return $items === [] ? null : $items;
    }

    /**
     * @param  array<int|string, mixed>|null  $value
     */
    private function jsonOrNull(?array $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $encoded = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);

        return $encoded === false ? null : $encoded;
    }
};
