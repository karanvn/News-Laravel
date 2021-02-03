
@if(count($datas)>0)

    <thead>
    <tr>
        <th class="product-remove"></th>
        <th class="product-thumbnail"></th>
        <th class="product-name">
            <span class="nobr">{{ trans('Auth::customer.withlist.productname') }}</span>
        </th>
        <th class="product-price">
<span class="nobr">{{ trans('Auth::customer.withlist.productprice') }}</span>
        </th>
        <th class="product-add-to-cart"></th>
    </tr>
    </thead>
    <tbody>

 @foreach($datas as $data)
@php 
 $product = $data->product;
@endphp
@if(empty($product))
@php continue; @endphp
@endif
 <tr id="yith-wcwl-row-29 ">
    <td class="product-remove">
        <div>
            <a class="remove remove_from_wishlist" title="Remove this product" id="12345_{{$product->product_id}}">×</a>
        </div>
    </td>
    <td class="product-thumbnail">
        <a class="thumb-link" href="@if(!empty($product->categories)) 
            @php	
                @$cate_slug   = $product->categories()->first();
                @$cate_slug_1 = @$cate_slug->slug; 
            @endphp 
            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
            @elseif(!empty($cate_slug->parent)) 
            @php
                @$cate_slug_2 = $cate_slug->parent->first()->slug;
            @endphp 
                {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
            @else
                {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
            @endif">
            @if(!empty($product->images))
            @foreach($product->images as $img)
            @php
                $image_product = show_image(config('product.image.product.thumb_path').$product->product_id, $img->image_path, config('product.image.product.no_image'));
            @endphp
            <img class="img-responsive lazyload" src="{{ $image_product }}" alt="{{!empty($img->name) ? $img->name : 'no_product_found'}}" width="270" height="350" >
            @php break; @endphp
            @endforeach
            @else
                <img src="{{asset('admin/assets/media/products/no_product.svg')}}" alt="image_product_notfound">
            @endif
        </a>
    </td>
    <td class="product-name">
        <a class="thumb-link" href="@if(!empty($product->categories)) 
            @php	
                @$cate_slug   = $product->categories()->first();
                @$cate_slug_1 = @$cate_slug->slug; 
            @endphp 
            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
            @elseif(!empty($cate_slug->parent)) 
            @php
                @$cate_slug_2 = $cate_slug->parent->first()->slug;
            @endphp 
                {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
            @else
                {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
            @endif" tabindex="0">
            {{@$product->name}}
        </a>
    <td class="product-price">
        <span class="lynessa-Price-amount amount">
            @if($product->sell_price!='0')
            <span class="price">
                <del>
                    <span class="lynessa-Price-amount amount">{{Number_format($product->org_price)}}₫</span>
                </del>
                <ins>
                    <span class="lynessa-Price-amount amount">{{Number_format($product->sell_price)}}₫</span>
                </ins>
            </span>
            @else
            <span class="price">
                <ins>
                    <span class="lynessa-Price-amount amount">{{Number_format($product->org_price)}}₫</span>
                </ins>
            </span>
            @endif
        </td>
   
    <td class="product-add-to-cart">
        @php $g = 0; @endphp
       @if(empty($product->parent_product_id)&&($product->qty>0))
       <button class="btnallNew addTrue" id="addlist_{{$product->product_id}}">{{ trans('Auth::customer.withlist.addtocart') }}</button>
       @php $g++; @endphp
       @endif
       
       @if(empty($product->parent_product_id)&&(!empty($product->qty))&&($g==0))
       <button class="btnallNew">{{ trans('Auth::customer.withlist.noqty') }}</button>
       @php $g++; @endphp
       @endif
       @if($g==0)
       <a class="thumb-link" href="@if(!empty($product->categories)) 
        @php	
            @$cate_slug   = $product->categories()->first();
            @$cate_slug_1 = @$cate_slug->slug; 
        @endphp 
        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
        @elseif(!empty($cate_slug->parent)) 
        @php
            @$cate_slug_2 = $cate_slug->parent->first()->slug;
        @endphp 
            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
        @else
            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
        @endif" tabindex="0">
            <button class="btnallNew">{{ trans('Auth::customer.withlist.addtocart') }}</button>
       </a>
       @php $g++; @endphp
       @endif

    
    </td>
</tr>

 @endforeach
   
    </tbody>
@else
<div class="container text-center text-danger">Danh sách rổng!</div>

@endif
<script>
    
    $('.remove_from_wishlist').on('click', function(){
        var id  = $(this).attr('id');
        id = id.split("_");
		id = id[1];
        $(".animationloadpage").show();
	    $.ajax("/user/deleteWithList/"+id+"/"+$('#currentPage').val(), {
		method: "GET",
		dataType: "json",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (a) {
        $(".animationloadpage").hide();
        console.log(a);
            $('#listWithList').html(a.html);
            if(a.status=='0'){
               $('#seemore').hide(); 
            }
        }
    })
    });

    // add to cart
    $(".addTrue").on("click", function () {
        var b = $(this).attr("id");
        b = b.split("_")[1];
        $(".animationloadpage").show();
        $.ajax("/addcartAjax/" + b, {
            method: "GET",
            dataType: "json",
            contentType: !1,
            cache: !1,
            processData: !1,
            success: function (a) {
                $(".animationloadpage").hide();
                if(a.status=='1'){
                    $(".alertAjax").removeClass("alert-warning");
                    $(".alertAjax").addClass("alert-success");
    
                    //  cập nhật giỏ hàng bên phải
                    $(".widget_shopping_cart").html(a.htmlCartToggle);
                    $(".countCart").html(a.count);
                }else{
                    $(".alertAjax").removeClass("alert-success");
                    $(".alertAjax").addClass("alert-warning");
                }
                $(".alertAjax .content").html(a.message),
                $(".alertAjax").show(),
                $(".alert").delay(5000).fadeOut()
            }
        })
        
    })


</script>