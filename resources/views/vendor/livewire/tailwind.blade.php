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
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-slate-400 bg-white border border-slate-200 cursor-default leading-5 rounded-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-500">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-med-navy bg-white border border-slate-200 leading-5 rounded-sm hover:bg-slate-50 hover:text-med-blue focus:outline-none focus:ring-2 focus:ring-sky-100 focus:border-med-blue active:bg-slate-100 transition ease-in-out duration-150 disabled:opacity-60 disabled:cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold text-med-navy bg-white border border-slate-200 leading-5 rounded-sm hover:bg-slate-50 hover:text-med-blue focus:outline-none focus:ring-2 focus:ring-sky-100 focus:border-med-blue active:bg-slate-100 transition ease-in-out duration-150 disabled:opacity-60 disabled:cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold text-slate-400 bg-white border border-slate-200 cursor-default leading-5 rounded-sm dark:text-gray-500 dark:bg-gray-800 dark:border-gray-600">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-slate-600 leading-5 dark:text-gray-400">
                        <span>{!! __('Showing') !!}</span>
                        <span class="font-semibold text-med-navy dark:text-gray-200">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="font-semibold text-med-navy dark:text-gray-200">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('of') !!}</span>
                        <span class="font-semibold text-med-navy dark:text-gray-200">{{ $paginator->total() }}</span>
                        <span>{!! __('results') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex items-center rtl:flex-row-reverse">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span class="relative inline-flex items-center h-9 w-9 justify-center text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default rounded-l-sm leading-5 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-500" aria-hidden="true">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="relative inline-flex items-center h-9 w-9 justify-center text-sm font-medium text-med-navy bg-white border border-slate-200 rounded-l-sm leading-5 hover:bg-slate-50 hover:text-med-blue focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100 focus:border-med-blue active:bg-slate-100 transition ease-in-out duration-150 disabled:opacity-60 disabled:cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:border-blue-800" aria-label="{{ __('pagination.previous') }}">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center h-9 px-3 -ml-px text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-500">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="relative inline-flex items-center h-9 px-3 -ml-px text-sm font-semibold text-white bg-med-blue border border-med-blue cursor-default leading-5 dark:bg-blue-600 dark:border-blue-600">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center h-9 px-3 -ml-px text-sm font-semibold text-med-navy bg-white border border-slate-200 leading-5 hover:bg-slate-50 hover:text-med-blue focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100 focus:border-med-blue active:bg-slate-100 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" class="relative inline-flex items-center h-9 w-9 justify-center -ml-px text-sm font-medium text-med-navy bg-white border border-slate-200 rounded-r-sm leading-5 hover:bg-slate-50 hover:text-med-blue focus:z-10 focus:outline-none focus:ring-2 focus:ring-sky-100 focus:border-med-blue active:bg-slate-100 transition ease-in-out duration-150 disabled:opacity-60 disabled:cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:border-blue-800" aria-label="{{ __('pagination.next') }}">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span class="relative inline-flex items-center h-9 w-9 justify-center -ml-px text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default rounded-r-sm leading-5 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-500" aria-hidden="true">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
