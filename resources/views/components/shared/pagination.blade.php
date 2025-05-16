@if ($paginator->hasPages())
    <ul class="uc-pagination">
        @if ($paginator->onFirstPage())
            <li class="uc-pagination__item">
                <span class="uc-pagination__link uc-pagination__link--disabled">&laquo;</span>
            </li>
        @else
            <li class="uc-pagination__item">
                <a href="{{ $paginator->previousPageUrl() }}" class="uc-pagination__link">&laquo;</a>
            </li>
        @endif
        @foreach ($paginator->links()->elements as $element)
            @if (is_string($element))
                <li class="uc-pagination__item">
                    <span class="uc-pagination__link uc-pagination__link--disabled">{{ $element }}</span>
                </li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="uc-pagination__item">
                            <span class="uc-pagination__link uc-pagination__link--active">{{ $page }}</span>
                        </li>
                    @else
                        <li class="uc-pagination__item">
                            <a href="{{ $url }}" class="uc-pagination__link">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="uc-pagination__item">
                <a href="{{ $paginator->nextPageUrl() }}" class="uc-pagination__link">&raquo;</a>
            </li>
        @else
            <li class="uc-pagination__item">
                <span class="uc-pagination__link uc-pagination__link--disabled">&raquo;</span>
            </li>
        @endif
    </ul>
@endif
