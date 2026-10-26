<div class="mx-auto max-w-7xl space-y-6">

    {{-- Page header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Google Reviews
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Reviews
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Import your Google Maps review export and manage the reviews stored for the clinic.
            </p>
        </div>

        <div class="inline-flex w-fit items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
            <i class="ri-star-line text-lg text-amber-500"></i>
            {{ number_format($this->reviews->total()) }} total reviews
        </div>
    </div>

    {{-- Import --}}
    <section class="border border-slate-200 bg-white">
        <div class="border-b border-slate-100 p-5 sm:p-6">
            <div class="flex items-start gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center bg-sky-50 text-xl text-med-blue">
                    <i class="ri-upload-cloud-2-line"></i>
                </span>

                <div>
                    <h3 class="font-bold text-med-navy">Import reviews</h3>
                    <p class="mt-1 text-sm leading-6 text-slate-500">
                        Upload a CSV, JSON, or XLSX Google Maps export. Reviews are matched by
                        <code class="bg-slate-100 px-1.5 py-0.5 text-xs text-slate-600">review_id</code>,
                        so importing the same file again updates existing rows instead of duplicating them.
                    </p>
                </div>
            </div>
        </div>

        <form wire:submit="import" class="p-5 sm:p-6">
            <div class="grid gap-5 lg:grid-cols-[1fr_auto] lg:items-end">
                <div>
                    <label for="reviews-file" class="block text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">
                        Review export file
                    </label>

                    <input
                        id="reviews-file"
                        type="file"
                        wire:model="file"
                        accept=".csv,.txt,.json,.xlsx,text/csv,application/json,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                        class="mt-2 block w-full cursor-pointer border border-slate-200 bg-slate-50 text-sm text-slate-500 file:mr-4 file:cursor-pointer file:border-0 file:bg-med-navy file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-800">

                    <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-400">
                        <span>CSV, JSON, or XLSX (UTF-8), up to 10 MB.</span>

                        <span wire:loading wire:target="file" class="inline-flex items-center gap-1.5 text-med-blue">
                            <i class="ri-loader-4-line animate-spin"></i>
                            Uploading file...
                        </span>

                        @if ($file)
                            <span class="inline-flex min-w-0 items-center gap-1.5 text-slate-500">
                                <i class="ri-file-list-3-line"></i>
                                <span class="max-w-xs truncate">{{ $file->getClientOriginalName() }}</span>
                            </span>
                        @endif
                    </div>

                    @error('file')
                        <p class="mt-2 flex items-start gap-2 text-sm text-red-600">
                            <i class="ri-error-warning-line mt-0.5"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="import"
                    class="inline-flex items-center justify-center gap-2 bg-med-red px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-70">
                    <i class="ri-upload-cloud-2-line" wire:loading.remove wire:target="import"></i>
                    <i class="ri-loader-4-line animate-spin" wire:loading wire:target="import"></i>
                    <span wire:loading.remove wire:target="import">Import reviews</span>
                    <span wire:loading wire:target="import">Importing...</span>
                </button>
            </div>

            @if ($lastImportCount !== null)
                <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2 border border-sky-100 bg-sky-50 px-4 py-3 text-sm text-sky-800">
                    <span class="inline-flex items-center gap-2 font-semibold">
                        <i class="ri-file-check-line"></i>
                        {{ number_format($lastImportCount) }} {{ \Illuminate\Support\Str::plural('review', $lastImportCount) }} processed
                    </span>

                    @if ($lastSkippedCount > 0)
                        <span class="text-sky-700">
                            {{ number_format($lastSkippedCount) }} empty {{ \Illuminate\Support\Str::plural('row', $lastSkippedCount) }} skipped
                        </span>
                    @endif
                </div>
            @endif
        </form>
    </section>

    {{-- Listing --}}
    <section class="border border-slate-200 bg-white">
        <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h3 class="font-bold text-med-navy">Review library</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Showing the latest reviews first.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative">
                    <i class="ri-search-line pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400"></i>

                    <input
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search reviews..."
                        aria-label="Search reviews"
                        class="h-10 w-full border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 sm:w-64">
                </div>

                <select
                    wire:model.live="perPage"
                    aria-label="Reviews per page"
                    class="h-10 border border-slate-200 bg-white px-3 text-sm text-slate-600 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Author</th>
                        <th scope="col" class="px-5 py-3">Rating</th>
                        <th scope="col" class="px-5 py-3">Review</th>
                        <th scope="col" class="px-5 py-3">Date</th>
                        <th scope="col" class="px-5 py-3">Likes</th>
                        <th scope="col" class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->reviews as $review)
                        @php
                            $authorName = $review->author_title ?: 'Anonymous';
                            $initials = str($authorName)
                                ->explode(' ')
                                ->filter()
                                ->map(fn ($part) => str($part)->substr(0, 1)->upper())
                                ->take(2)
                                ->implode('');
                            $imageCount = count($review->review_img_urls ?? []);
                        @endphp

                        <tr wire:key="review-{{ $review->id }}" class="align-top transition hover:bg-slate-50/70">
                            <td class="px-5 py-4">
                                <div class="flex min-w-52 items-center gap-3">
                                    @if ($review->author_image)
                                        <img
                                            src="{{ $review->author_image }}"
                                            alt=""
                                            loading="lazy"
                                            referrerpolicy="no-referrer"
                                            class="h-9 w-9 shrink-0 object-cover">
                                    @else
                                        <span class="grid h-9 w-9 shrink-0 place-items-center bg-slate-100 text-[11px] font-semibold text-slate-500">
                                            {{ $initials ?: 'A' }}
                                        </span>
                                    @endif

                                    <div class="min-w-0">
                                        <p class="max-w-52 truncate text-sm font-semibold text-med-navy">
                                            {{ $authorName }}
                                        </p>

                                        @if ($review->name)
                                            <p class="mt-0.5 max-w-52 truncate text-xs text-slate-400">
                                                {{ $review->name }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                @if ($review->review_rating)
                                    <span class="inline-flex items-center gap-1 bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/10">
                                        <i class="ri-star-fill"></i>
                                        {{ $review->review_rating }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <p class="max-w-md text-sm leading-6 text-slate-600">
                                    {{ $review->review_text ? \Illuminate\Support\Str::limit($review->review_text, 160) : 'No review text.' }}
                                </p>

                                <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] text-slate-400">
                                    @if ($review->owner_answer)
                                        <span class="inline-flex items-center gap-1 text-emerald-600">
                                            <i class="ri-reply-line"></i>
                                            Owner replied
                                        </span>
                                    @endif

                                    @if ($imageCount > 0)
                                        <span class="inline-flex items-center gap-1">
                                            <i class="ri-image-line"></i>
                                            {{ $imageCount }} {{ \Illuminate\Support\Str::plural('photo', $imageCount) }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                {{ $review->review_datetime_utc?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex items-center gap-1 text-sm text-slate-500">
                                    <i class="ri-thumb-up-line text-base"></i>
                                    {{ number_format($review->review_likes) }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($review->review_link)
                                        <a href="{{ $review->review_link }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            aria-label="Open review for {{ $authorName }}"
                                            class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                            <i class="ri-external-link-line"></i>
                                        </a>
                                    @endif

                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $review->id }})"
                                        aria-label="Delete review by {{ $authorName }}"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-red-200 hover:bg-red-50 hover:text-med-red">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-14 text-center">
                                <span class="mx-auto grid h-12 w-12 place-items-center bg-slate-100 text-2xl text-slate-400">
                                    <i class="ri-star-line"></i>
                                </span>

                                <p class="mt-4 text-sm font-semibold text-med-navy">
                                    {{ $search !== '' ? 'No reviews match your search.' : 'No reviews yet.' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $search !== '' ? 'Try a different author, clinic, or review keyword.' : 'Upload a Google Maps review export above to get started.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->reviews->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $this->reviews->links() }}
            </div>
        @endif
    </section>

    {{-- Import loading overlay --}}
    <div
        wire:loading.flex
        wire:target="import"
        class="fixed inset-0 z-[60] items-center justify-center bg-slate-900/40 p-4 backdrop-blur-sm">
        <div class="flex items-center gap-3 border border-slate-200 bg-white px-5 py-4 shadow-xl">
            <i class="ri-loader-4-line animate-spin text-2xl text-med-blue"></i>

            <div>
                <p class="text-sm font-semibold text-med-navy">Importing reviews</p>
                <p class="mt-0.5 text-xs text-slate-500">Please wait while the file is processed...</p>
            </div>
        </div>
    </div>

    {{-- Delete confirmation modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.showDeleteModal"
        x-transition.opacity
        @keydown.escape.window="$wire.cancelDelete()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">

        <div class="absolute inset-0 bg-slate-900/50" wire:click="cancelDelete"></div>

        @if ($this->reviewToDelete)
            <div
                x-transition
                class="relative w-full max-w-md border border-slate-200 bg-white p-6 shadow-xl">

                <div class="flex items-start gap-4">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                        <i class="ri-delete-bin-6-line"></i>
                    </span>

                    <div class="min-w-0">
                        <h3 class="text-lg font-bold text-med-navy">Delete this review?</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            The review by
                            <span class="font-semibold text-slate-700">{{ $this->reviewToDelete->author_title ?: 'this author' }}</span>
                            will be permanently removed from the review library.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <button
                        type="button"
                        wire:click="cancelDelete"
                        class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-med-navy">
                        Cancel
                    </button>

                    <button
                        type="button"
                        wire:click="deleteReview"
                        wire:loading.attr="disabled"
                        wire:target="deleteReview"
                        class="inline-flex items-center justify-center gap-2 bg-med-red px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-70">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="deleteReview"></i>
                        <span wire:loading.remove wire:target="deleteReview">Delete review</span>
                        <span wire:loading wire:target="deleteReview">Deleting...</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
