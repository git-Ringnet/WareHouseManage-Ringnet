@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <!-- ... -->

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    {{-- <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li> --}}
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($paginator->currentPage() == $page)
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            @if (
                                $page === 1 ||
                                $page === $paginator->lastPage() ||
                                ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2)
                            )
                                <li class="page-item"><a class="paginate-a page-link text-dark" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                            @if (
                                ($page == 2 && $paginator->currentPage() > 4) ||
                                ($page == $paginator->lastPage() - 1 && $paginator->currentPage() < $paginator->lastPage() - 3)
                            )
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <!-- ... -->
        </ul>
    </nav>
@endif
