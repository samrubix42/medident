<div class="mx-auto max-w-7xl space-y-6">

    @if (session('status'))
        <div class="flex items-center gap-3 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            <i class="ri-checkbox-circle-line text-lg"></i>
            {{ session('status') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Search visibility
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Page SEO
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Manage the titles, descriptions and keywords used by search engines and social previews for the main website pages.
            </p>
        </div>

        <div class="flex w-fit flex-wrap items-center gap-2">
            <div class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
                <i class="ri-seo-line text-lg text-med-blue"></i>
                {{ number_format($this->pageSeos->total()) }} pages
            </div>

            <a
                href="{{ route('admin.page-seos.create') }}"
                class="inline-flex items-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                <i class="ri-add-line text-lg"></i>
                Add page SEO
            </a>
        </div>
    </div>

    <section class="border border-slate-200 bg-white">
        <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h3 class="font-bold text-med-navy">Page metadata</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Seeded entries cover the home, about, gallery, blog, services, contact and dentist pages.
                </p>
            </div>

            <div class="relative">
                <i class="ri-search-line pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400"></i>

                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search pages..."
                    aria-label="Search page SEO"
                    class="h-10 w-full border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 sm:w-64">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Page</th>
                        <th scope="col" class="px-5 py-3">Meta title</th>
                        <th scope="col" class="px-5 py-3">Description</th>
                        <th scope="col" class="px-5 py-3">Updated</th>
                        <th scope="col" class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->pageSeos as $pageSeo)
                        <tr wire:key="page-seo-{{ $pageSeo->id }}" class="transition hover:bg-slate-50/70">
                            <td class="px-5 py-4">
                                <span class="block text-sm font-semibold text-med-navy">
                                    {{ $pageSeo->page_name }}
                                </span>
                                <span class="mt-0.5 block text-xs text-slate-400">
                                    {{ $pageSeo->page_slug }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="block max-w-sm truncate text-sm text-slate-600">
                                    {{ $pageSeo->meta_title ?: 'Using page default' }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="block max-w-md truncate text-sm text-slate-500">
                                    {{ $pageSeo->meta_description ?: 'No description set' }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                {{ $pageSeo->updated_at?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('admin.page-seos.edit', $pageSeo) }}"
                                        aria-label="Edit {{ $pageSeo->page_name }} SEO"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="ri-pencil-line"></i>
                                    </a>

                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $pageSeo->id }})"
                                        aria-label="Delete {{ $pageSeo->page_name }} SEO"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-red-200 hover:bg-red-50 hover:text-med-red">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-14 text-center">
                                <span class="mx-auto grid h-12 w-12 place-items-center bg-slate-100 text-2xl text-slate-400">
                                    <i class="ri-seo-line"></i>
                                </span>

                                <p class="mt-4 text-sm font-semibold text-med-navy">
                                    {{ $search !== '' ? 'No pages match your search.' : 'No page SEO entries yet.' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $search !== '' ? 'Try a different page name, slug or meta title.' : 'Add your first page SEO entry or run the page SEO seeder.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->pageSeos->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $this->pageSeos->links() }}
            </div>
        @endif
    </section>

    <div
        x-data
        x-cloak
        x-show="$wire.showDeleteModal"
        @keydown.escape.window="$wire.showDeleteModal && $wire.cancelDelete()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">

        <div class="absolute inset-0 bg-slate-900/50" wire:click="cancelDelete"></div>

        @if ($this->pageSeoToDelete)
            <div x-transition class="relative w-full max-w-md border border-slate-200 bg-white p-6 shadow-xl">
                <div class="flex items-start gap-4">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                        <i class="ri-delete-bin-6-line"></i>
                    </span>

                    <div>
                        <h3 class="text-lg font-bold text-med-navy">Delete page SEO</h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Are you sure you want to delete the SEO entry for
                            <span class="font-semibold text-med-navy">{{ $this->pageSeoToDelete->page_name }}</span>?
                            The page will fall back to its default metadata.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-2">
                    <button
                        type="button"
                        wire:click="cancelDelete"
                        class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                        Cancel
                    </button>

                    <button
                        type="button"
                        wire:click="deletePageSeo"
                        wire:loading.attr="disabled"
                        wire:target="deletePageSeo"
                        class="inline-flex items-center justify-center gap-2 bg-med-red px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-200 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="deletePageSeo"></i>
                        <i class="ri-delete-bin-6-line" wire:loading.remove wire:target="deletePageSeo"></i>
                        <span wire:loading.remove wire:target="deletePageSeo">Delete entry</span>
                        <span wire:loading wire:target="deletePageSeo">Deleting...</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
