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
        <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            {{-- Mobile pagination --}}
            <div class="flex items-center justify-between gap-3 sm:hidden">
                <span class="flex flex-1">
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="inline-flex h-10 flex-1 items-center justify-center border border-slate-100 bg-slate-50 px-4 text-sm font-semibold text-slate-300">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="inline-flex h-10 flex-1 items-center justify-center border border-slate-200 bg-white px-4 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:bg-sky-50 hover:text-med-blue focus:outline-none focus:ring-2 focus:ring-sky-100 disabled:cursor-not-allowed disabled:opacity-60">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span class="flex flex-1 justify-end">
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="inline-flex h-10 flex-1 items-center justify-center border border-slate-200 bg-white px-4 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:bg-sky-50 hover:text-med-blue focus:outline-none focus:ring-2 focus:ring-sky-100 disabled:cursor-not-allowed disabled:opacity-60">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="inline-flex h-10 flex-1 items-center justify-center border border-slate-100 bg-slate-50 px-4 text-sm font-semibold text-slate-300">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            {{-- Desktop pagination --}}
            <div class="hidden items-center justify-between gap-6 sm:flex sm:flex-1">
                <p class="text-sm leading-5 text-slate-500">
                    <span>{!! __('Showing') !!}</span>
                    <span class="font-semibold text-med-navy">{{ $paginator->firstItem() }}</span>
                    <span>{!! __('to') !!}</span>
                    <span class="font-semibold text-med-navy">{{ $paginator->lastItem() }}</span>
                    <span>{!! __('of') !!}</span>
                    <span class="font-semibold text-med-navy">{{ $paginator->total() }}</span>
                    <span>{!! __('results') !!}</span>
                </p>

                <div class="inline-flex items-center gap-1 rtl:flex-row-reverse">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="inline-grid h-9 w-9 place-items-center border border-slate-100 bg-slate-50 text-slate-300">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="inline-grid h-9 w-9 place-items-center border border-slate-200 bg-white text-slate-500 transition hover:border-med-blue hover:bg-sky-50 hover:text-med-blue focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100 disabled:cursor-not-allowed disabled:opacity-60" aria-label="{{ __('pagination.previous') }}">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true" class="inline-grid h-9 min-w-9 place-items-center text-sm font-medium text-slate-400">{{ $element }}</span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                    @if ($page == $paginator->currentPage())
                                        <span aria-current="page" class="inline-grid h-9 min-w-9 place-items-center border border-med-blue bg-med-blue px-3 text-sm font-semibold text-white">{{ $page }}</span>
                                    @else
                                        <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="inline-grid h-9 min-w-9 place-items-center border border-slate-200 bg-white px-3 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:bg-sky-50 hover:text-med-blue focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </button>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="inline-grid h-9 w-9 place-items-center border border-slate-200 bg-white text-slate-500 transition hover:border-med-blue hover:bg-sky-50 hover:text-med-blue focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100 disabled:cursor-not-allowed disabled:opacity-60" aria-label="{{ __('pagination.next') }}">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="inline-grid h-9 w-9 place-items-center border border-slate-100 bg-slate-50 text-slate-300">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </nav>
    @endif
</div>
