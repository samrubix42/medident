<div class="mx-auto max-w-5xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <a href="{{ route('admin.page-seos') }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 transition hover:text-med-blue">
                <i class="ri-arrow-left-line"></i>
                Back to page SEO
            </a>

            <h2 class="mt-3 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                {{ $pageSeoId ? 'Edit page SEO' : 'Create page SEO' }}
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                {{ $pageSeoId ? 'Update the search engine details for this page.' : 'Add search engine details for a website page.' }}
            </p>
        </div>

        <div class="flex w-fit items-center gap-2">
            <a href="{{ route('admin.page-seos') }}"
               class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                Cancel
            </a>

            <button
                type="submit"
                form="page-seo-form"
                wire:loading.attr="disabled"
                wire:target="save"
                class="inline-flex items-center justify-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200 disabled:cursor-not-allowed disabled:opacity-60">
                <i class="ri-loader-4-line animate-spin" wire:loading wire:target="save"></i>
                <i class="ri-save-3-line" wire:loading.remove wire:target="save"></i>
                <span wire:loading.remove wire:target="save">{{ $pageSeoId ? 'Save changes' : 'Create entry' }}</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </div>

    <form id="page-seo-form" wire:submit="save" class="space-y-6">
        <section class="border border-slate-200 bg-white">
            <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                <h3 class="font-bold text-med-navy">Page details</h3>
                <p class="mt-1 text-xs text-slate-500">
                    The page key is used by the website to find the matching metadata.
                </p>
            </div>

            <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">
                <div>
                    <label for="page-seo-name" class="text-sm font-semibold text-med-navy">
                        Page name
                    </label>

                    <input
                        id="page-seo-name"
                        type="text"
                        wire:model.live.debounce.300ms="pageName"
                        placeholder="e.g. About Us"
                        autocomplete="off"
                        class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                    @error('pageName')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="page-seo-slug" class="text-sm font-semibold text-med-navy">
                        Page key
                    </label>

                    <input
                        id="page-seo-slug"
                        type="text"
                        wire:model.live.debounce.300ms="pageSlug"
                        placeholder="e.g. about"
                        autocomplete="off"
                        class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                    @error('pageSlug')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <p class="text-xs leading-6 text-slate-400">
                        Existing page keys:
                        <span class="font-semibold text-slate-500">home</span>,
                        <span class="font-semibold text-slate-500">about</span>,
                        <span class="font-semibold text-slate-500">gallery</span>,
                        <span class="font-semibold text-slate-500">blog</span>,
                        <span class="font-semibold text-slate-500">services</span>,
                        <span class="font-semibold text-slate-500">contact</span>,
                        <span class="font-semibold text-slate-500">dentist</span>.
                    </p>
                </div>
            </div>
        </section>

        <section class="border border-slate-200 bg-white">
            <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                <h3 class="font-bold text-med-navy">Search engine details</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Leave a field empty to use the page's built-in default.
                </p>
            </div>

            <div class="space-y-5 p-5 sm:p-6">
                <div>
                    <div class="flex items-center justify-between gap-3">
                        <label for="page-seo-meta-title" class="text-sm font-semibold text-med-navy">
                            Meta title
                        </label>

                        <span class="text-[11px] text-slate-400">
                            {{ strlen($metaTitle) }}/255
                        </span>
                    </div>

                    <input
                        id="page-seo-meta-title"
                        type="text"
                        wire:model="metaTitle"
                        placeholder="The title shown in search results"
                        autocomplete="off"
                        class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                    @error('metaTitle')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between gap-3">
                        <label for="page-seo-meta-description" class="text-sm font-semibold text-med-navy">
                            Meta description
                        </label>

                        <span class="text-[11px] text-slate-400">
                            {{ strlen($metaDescription) }}/1000
                        </span>
                    </div>

                    <textarea
                        id="page-seo-meta-description"
                        wire:model="metaDescription"
                        rows="4"
                        placeholder="A short summary for search results and social previews."
                        class="mt-2 w-full resize-y border border-slate-200 bg-white px-3 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100"></textarea>

                    @error('metaDescription')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="page-seo-meta-keywords" class="text-sm font-semibold text-med-navy">
                        Meta keywords
                    </label>

                    <input
                        id="page-seo-meta-keywords"
                        type="text"
                        wire:model="metaKeywords"
                        placeholder="e.g. dentist in Ghaziabad, dental clinic Shastri Nagar"
                        autocomplete="off"
                        class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                    @error('metaKeywords')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-[11px] text-slate-400">
                        Separate keywords with commas.
                    </p>
                </div>
            </div>
        </section>
    </form>
</div>
