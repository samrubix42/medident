<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

final class ReviewsImport implements ToCollection, WithHeadingRow
{
    /**
     * @var array<int, array<string, mixed>>
     */
    public array $rows = [];

    /**
     * @param  Collection<int, Collection<string, mixed>>  $collection
     */
    public function collection(Collection $collection): void
    {
        $this->rows = $collection
            ->map(fn (Collection $row): array => $row->all())
            ->all();
    }
}
