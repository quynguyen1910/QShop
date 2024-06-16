@if ($paginator->hasPages())
    <div id="ct-pagination" class="d-flex gap-3 ">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                    </li>
                @endif

                {{-- Link to the first page --}}
                @if ($paginator->currentPage() > 2)
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}&{{ http_build_query(request()->except('page')) }}" aria-label="First">
                            <span aria-hidden="true">1</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:;" aria-label="First">
                            <span aria-hidden="true">...</span>
                        </a>
                    </li>
                @endif

                {{-- Links to current page, one before, and one after --}}
                @if ($paginator->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}&{{ http_build_query(request()->except('page')) }}">{{ $paginator->currentPage() - 1 }}</a>
                    </li>
                @endif

                <li class="page-item active" aria-current="page">
                    <span class="page-link">{{ $paginator->currentPage() }}</span>
                </li>

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}&{{ http_build_query(request()->except('page')) }}">{{ $paginator->currentPage() + 1 }}</a>
                    </li>
                @endif

                {{-- Link to the last page --}}
                @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                    <li class="page-item">
                        <a class="page-link" href="javascript:;" aria-label="Last">
                            <span aria-hidden="true">...</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}&{{ http_build_query(request()->except('page')) }}" aria-label="Last">
                            <span aria-hidden="true">{{ $paginator->lastPage() }}</span>
                        </a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>

        <form class="d-flex gap-1" method="GET">
            @foreach(request()->except('page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input min="1" max="{{ $paginator->lastPage() }}" type="number" class="text-center" name="page" id="page" placeholder="{{ $paginator->currentPage() }}">
            <button type="submit" class="btn btn-primary">GO</button>
        </form>
    </div>
@endif
