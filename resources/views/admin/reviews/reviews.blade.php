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
                Manage the reviews stored for the clinic or reset them to the seeded data.
            </p>
        </div>

        <div class="flex w-fit flex-wrap items-center gap-2">
            <div class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
                <i class="ri-star-line text-lg text-amber-500"></i>
                {{ number_format($this->reviews->total()) }} total reviews
            </div>

            <button
                type="button"
                wire:click="resetReviews"
                wire:confirm="Reset all reviews to the seeded data? This will remove any changes."
                wire:loading.attr="disabled"
                wire:target="resetReviews"
                class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-med-red disabled:cursor-not-allowed disabled:opacity-70">
                <i class="ri-loader-4-line animate-spin" wire:loading wire:target="resetReviews"></i>
                <i class="ri-restart-line" wire:loading.remove wire:target="resetReviews"></i>
                <span wire:loading.remove wire:target="resetReviews">Reset reviews</span>
                <span wire:loading wire:target="resetReviews">Resetting...</span>
            </button>
        </div>
    </div>

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
                                    {{ $search !== '' ? 'Try a different author, clinic, or review keyword.' : 'Use Reset reviews to restore the seeded reviews.' }}
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
