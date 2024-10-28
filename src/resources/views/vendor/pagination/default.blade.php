@if ($paginator->hasPages())
<ol class="pagination-2">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="prev disabled" aria-disabled="true"><span>前へ</span></li>
    @else
    <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="current"><a href="#">{{ $page }}</a></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next">次へ</a></li>
    @else
    <li class="next disabled" aria-disabled="true"><span>次へ</span></li>
    @endif
</ol>
@endif