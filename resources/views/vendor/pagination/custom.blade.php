@if ($paginator->hasPages())
    {{-- <div class="text-start py-4">
                            <div class="custom-pagination">
                                <a href="{{ $category->postsPagination()->previousPageUrl() }}" class="prev">Prevous</a>
                                <a href="#" class="active">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="{{ $$category->postsPagination()->nextPageUrl() }}" class="next">Next</a>
                            </div>
                        </div> --}}
    <div class="text-start py-4">
        <div class="custom-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="prev disabled">
                    Prevous
                </a>
            @else
                <a class="prev" href="{{ $paginator->previousPageUrl() }}">Prevous</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="#" class="disabled">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="#" class="active">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="next" href="{{ $paginator->nextPageUrl() }}">Next</a>
            @else
                <a class="next disabled">
                    Next
                </a>
            @endif
        </div>
    </div>
@endif
