@if($datas != null)
<form action="{{route('addcart')}}" method="POST">
@csrf
    <div style="max-height:220px;overflow:auto" class="mt-3">
        @foreach($datas as $data)
        <div class="col-12 py-1 border-bottom">
            <div class="row">
                <div class="col-2">
                    @if(!empty($data->images))
                    <img src="{{asset('storage/editor/thumbs/'.@$data->parent_product_id.'/'.@$data->images->first()->image_path)}}"
                        alt="" style="width:55px">
                    @endif
                </div>
                <div class="col-8">
                    <b>{{@$data->name}}</b>
                    <br>
                    @if(!empty(@$data->sell_price)&&(@$data->sell_price>0))
                    <span class="price">
                        <del>
                            <span class="lynessa-Price-amount amount">
                                {{Number_format(@$data->org_price)}}
                                VND
                            </span>
                        </del>
                        <ins>
                            <span class="lynessa-Price-amount amount text-danger">
                                {{Number_format(@$data->sell_price)}} VND
                            </span>
                        </ins>
                    </span>
                    @else
                    <span class="price">
                        <ins>
                            <span class="lynessa-Price-amount amount text-danger">
                                {{Number_format(@$data->org_price)}}VND
                            </span>
                        </ins>
                    </span>
                    @endif
                </div>
                <div class="col-2 py-2">
                    <input type="hidden" name="product[]" value="{{$data->product_id}}" id="product">
                    <input class="border col-12 btn" min="1" name="count[{{$data->product_id}}]" value="1"
                        type="number">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="col-12 mt-2 btn-dark rounded-0 btnOneClick" type="submit" id="addtocart">
        Thêm vào giỏ hàng
    </button>
</form>
@else
<div class="alert alert-warning">Không có sản phẩm này</div>
@endif