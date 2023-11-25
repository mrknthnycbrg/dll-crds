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
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 cursor-default leading-5 select-none">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        <button type="button" dusk="previousPage" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 leading-5 hover:text-blue-900 hover:underline active:text-gray-700">
                                {!! __('pagination.previous') !!}
                        </button>
                    @else
                        <button
                            type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 leading-5 hover:text-blue-900 hover:underline active:text-gray-700">
                                {!! __('pagination.previous') !!}
                        </button>
                    @endif
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        <button type="button" dusk="nextPage" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 leading-5 hover:text-blue-900 hover:underline active:text-gray-700">
                                {!! __('pagination.next') !!}
                        </button>
                    @else
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 leading-5 hover:text-blue-900 hover:underline active:text-gray-700">
                                {!! __('pagination.next') !!}
                        </button>
                    @endif
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 cursor-default leading-5 select-none">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>
