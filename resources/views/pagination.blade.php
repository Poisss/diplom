<div class="paginate">
    <div>
        @if (!($paginator->onFirstPage()))
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><button class="paginate-block">Предыдущая</button></a>
        @endif
    </div>
    <div class="bold">
        Результат {{$paginator->total()}}
    </div>
    <div>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"><button class="paginate-block">Следующая</button></a>
        @endif
    </div>
</div>
@if ($paginator->hasPages())
<ul class="pager">
    @if ($paginator->onFirstPage())
        <li ><button class="paginate-notactive">←</button></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><button class="paginate-block">←</button></a></li>
    @endif
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li ><button class="paginate-active">{{ $page }}</button></li>
                @else
                    <li><a href="{{ $url }}"><button class="paginate-block">{{ $page }}</button></a></li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><button class="paginate-block">→</button></a></li>
    @else
        <li><button class="paginate-notactive">→</button></li>
    @endif
</ul>
@endif
