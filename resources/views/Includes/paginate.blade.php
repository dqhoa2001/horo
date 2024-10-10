@if (isset($paginate) && !empty($paginate))
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-dark justify-content-center mt-3">
            @if ($paginate->previousPageUrl())
                <li class="page-item">
                    <a class="page-link" href={{ $paginate->previousPageUrl() }}>
                        <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </a>
                </li>
            @endif

            @if ($paginate->currentPage() > 3)
                <li class="page-item">
                    <a class="page-link" href={{ $paginate->url(1) }}>1</a>
                </li>
            @endif
            @if ($paginate->currentPage() > 4)
                <li class="page-item"><a class="page-link">...</a></li>
            @endif

            @for ($i = 1; $i <= $paginate->lastPage(); $i++)
                @if ($i >= $paginate->currentPage() - 2 && $i <= $paginate->currentPage() + 2)
                    @if ($i == $paginate->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link"
                                href="{{ $paginate->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endfor

            @if ($paginate->currentPage() < $paginate->lastPage() - 3)
                <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @if ($paginate->currentPage() < $paginate->lastPage() - 2)
                <li class="page-item">
                    <a class="page-link"
                        href="{{ $paginate->url($paginate->lastPage()) }}">{{ $paginate->lastPage() }}</a>
                </li>
            @endif

            @if ($paginate->nextPageUrl())
                <li class="page-item">
                    <a class="page-link" href={{ $paginate->nextPageUrl() }}>
                        <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
