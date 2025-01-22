<div
    class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-3 sm:py-4 bg-white border-t gap-3 sm:gap-0">
    {{-- Info Section --}}
    <div class="flex items-center text-sm text-gray-500 space-x-1 order-2 sm:order-1">
        <span class="hidden sm:inline">Showing</span>
        <span class="sm:hidden">Results</span>
        @if ($paginator->firstItem())
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        <span>-</span>
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
        <span>{{ $paginator->count() }}</span>
        @endif
        <span>of</span>
        <span>{{ $paginator->total() }}</span>
        <span class="hidden sm:inline">entries</span>
    </div>

    {{-- Pagination Navigation --}}
    @if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation"
        class="flex items-center space-x-1 sm:space-x-2 order-1 sm:order-2">
        {{-- Previous Button --}}
        <span>
            @if ($paginator->onFirstPage())
            <button
                class="px-2 sm:px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg opacity-50 cursor-not-allowed">
                <span class="hidden sm:inline">Previous</span>
                <span class="sm:hidden">&larr;</span>
            </button>
            @else
            <button wire:click="previousPage" wire:loading.attr="disabled"
                class="px-2 sm:px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
                <span class="hidden sm:inline">Previous</span>
                <span class="sm:hidden">&larr;</span>
            </button>
            @endif
        </span>

        {{-- Page Numbers --}}
        <div class="hidden sm:flex space-x-1">
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($paginator->lastPage() > 6 && $page > 3 && $page < $paginator->lastPage() - 2)
                @if ($page == 4)
                <span class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg">...</span>
                @endif
                @continue
                @endif
                <button wire:click="gotoPage({{ $page }})"
                    class="{{ $page === $paginator->currentPage() 
                                    ? 'px-3 py-1 text-sm text-white bg-green-600 rounded-lg hover:bg-green-700'
                                    : 'px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100' }}">
                    {{ $page }}
                </button>
                @endforeach
        </div>

        {{-- Mobile Current Page Indicator --}}
        <span class="sm:hidden text-sm text-gray-500">
            Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
        </span>

        {{-- Next Button --}}
        <span>
            @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled"
                class="px-2 sm:px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
                <span class="hidden sm:inline">Next</span>
                <span class="sm:hidden">&rarr;</span>
            </button>
            @else
            <button
                class="px-2 sm:px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg opacity-50 cursor-not-allowed">
                <span class="hidden sm:inline">Next</span>
                <span class="sm:hidden">&rarr;</span>
            </button>
            @endif
        </span>
    </nav>
    @endif
</div>