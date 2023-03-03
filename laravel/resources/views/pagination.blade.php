
@if ($paginator->hasPages())
<style type="text/css">
    a.disabled {
      pointer-events: none;
      cursor: default;
    }
</style>
<div class="page-pagination">
        <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
        <!-- <li><a href="#" class="disabled"><i class="icofont-rounded-left"></i></a></li> -->
        @else
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="icofont-rounded-left"></i></a></li>
        @endif
  
        @foreach ($elements as $element)
        @if (is_string($element))
        <li><a href="#">{{ $element }}</a></li>
        @endif
  
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li><a class="active" href="#" class="disabled">{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach
  
        @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}"><i class="icofont-rounded-right"></i></a></li>
        @else
        <!-- <li><a href="#" class="disabled"><i class="icofont-rounded-right"></i></a></li> -->
        @endif
    </ul>
  </div>
    @endif