@if ($paginator->hasPages())
    <div class="block-27">
        <ul>
            @if ($paginator->onFirstPage())
                <li class="disabled"><a href="#">&lt;</a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}">&lt;</a></li>
            @endif

                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}">&gt;</a></li>
                @else
                    <li class="disabled"><a href="">&gt;</a></li>
                @endif

        </ul>
    </div>
@endif
