@if ($paginator->hasPages())
    <div class="mailbox-controls">
        <div class="float-right">
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() }}
                -
                {{ $paginator->lastItem() }}
            @else
                {{ $paginator->count() }}
            @endif
            /
            {{ $paginator->total() }}
            <div class="btn-group">
                @if ($paginator->onFirstPage())
                    <button type="button" disabled class="btn btn-default btn-sm">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                @else   
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-default btn-sm">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-default btn-sm">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <button type="button" disabled class="btn btn-default btn-sm">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @endif
            </div>

        </div>

    </div>
@endif
