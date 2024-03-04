
@if($paginator->hasPages())
<div class="product__pagination" id="paginationContainer">
    @foreach ($elements as $element)
        @if(is_string($element))
        <li class="page-item disabled">
            <a href="javascript:void(0);">{{$element}}</a>
            <a href="javascript:void(0);">3</a>
            <a href="javascript:void(0);"><i class="fa fa-long-arrow-right"></i></a>
        </li>
        @endif

        @if(is_array($element))
            @foreach($element as $page=>$url)
                @if($page == $paginator->currentPage())
                     <li class="page-item active">
                        <a href="javascript:void(0);">{{$page}}</a>
                     </li>
                @else
                    <li class="page-item active">
                        <a href="{{$url}}">{{$page}}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach
</div>
@endif
