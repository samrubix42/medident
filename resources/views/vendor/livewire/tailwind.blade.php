@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center gap-6 sm:flex-row sm:items-center sm:justify-center">
            {{-- Mobile pagination --}}
            <div class="flex w-full items-center justify-between gap-3 sm:hidden">
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-5 text-sm font-semibold text-slate-400">
                        <i class="ri-arrow-left-line"></i>
                        <span>{!! __('pagination.previous') !!}</span>
                    </span>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="group inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-med-blue hover:text-med-blue hover:shadow-md focus:outline-none focus:ring-2 focus:ring-sky-100 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="ri-arrow-left-line transition-transform duration-200 group-hover:-translate-x-0.5"></i>
                        <span>{!! __('pagination.previous') !!}</span>
                    </button>
                @endif

                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="group inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-med-blue hover:text-med-blue hover:shadow-md focus:outline-none focus:ring-2 focus:ring-sky-100 disabled:cursor-not-allowed disabled:opacity-60">
                        <span>{!! __('pagination.next') !!}</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-0.5"></i>
                    </button>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-5 text-sm font-semibold text-slate-400">
                        <span>{!! __('pagination.next') !!}</span>
                        <i class="ri-arrow-right-line"></i>
                    </span>
                @endif
            </div>

            {{-- Desktop pagination --}}
            <div class="hidden flex-wrap items-center justify-center gap-2 sm:flex">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-400">
                        <i class="ri-arrow-left-line text-lg"></i>
                    </span>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="group inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-med-blue hover:bg-sky-50 hover:text-med-blue hover:shadow-md focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100" aria-label="{{ __('pagination.previous') }}">
                        <i class="ri-arrow-left-line text-lg transition-transform duration-200 group-hover:-translate-x-0.5"></i>
                    </button>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="inline-flex h-10 min-w-10 items-center justify-center px-2 text-sm font-medium text-slate-400">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="inline-flex h-10 min-w-10 items-center justify-center rounded-full bg-med-navy px-4 text-sm font-semibold text-white shadow-md shadow-med-navy/15">{{ $page }}</span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-full border border-slate-200 bg-white px-4 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-med-blue hover:bg-sky-50 hover:text-med-blue hover:shadow-md focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="group inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-med-blue hover:bg-sky-50 hover:text-med-blue hover:shadow-md focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100" aria-label="{{ __('pagination.next') }}">
                        <i class="ri-arrow-right-line text-lg transition-transform duration-200 group-hover:translate-x-0.5"></i>
                    </button>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-400">
                        <i class="ri-arrow-right-line text-lg"></i>
                    </span>
                @endif
            </div>
        </nav>
    @endif
</div>
