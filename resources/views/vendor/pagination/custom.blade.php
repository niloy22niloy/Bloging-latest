
@if ($paginator->hasPages())

        <div class="custom-pagination">
        @if ($paginator->onFirstPage())

            <a href="#" class="prev disabled" tabindex="-1">Prevous</a>
        @else

            <a href="{{ $paginator->previousPageUrl() }}" class="prev">Prevous</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))

                <a href="#" class="prev disabled" tabindex="-1">{{ $element }}</a>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())

                            <a class="page-link active">{{ $page }}</a>

                    @else

                            <a href="{{ $url }}" class="">{{ $page }}</a>

                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())

                <a href="{{ $paginator->nextPageUrl() }}" class="next">Next</a>

        @else

                <a href="#" class="next">Next</a>

        @endif

        </div>
@endif
