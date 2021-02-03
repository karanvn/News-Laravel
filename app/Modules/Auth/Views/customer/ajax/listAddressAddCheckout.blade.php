@php
$sttOrder = 1;
$countAllOrder = count($orders);
@endphp
@foreach($orders->where('status','A') as $order)
<div class="col-12 border rounded my-2">
    <div class="row">
        <div class="col-1 text-center border-0">
            <input type="radio" name="id_order"
                value="{{$order->id}}" id="{{@$order->ward_id}}"
                class="WardLast"
                @if((($sttOrder == $countAllOrder) && (empty($address_update_id)))||($address_update_id == $order->id)) checked @endif >
        </div>
        <div class="col-11">
            {{trans('Cart::cart.checkCode.form.nameTo')}}: <b>{{@$order->name}}</b> <span>[ <a class="editAddressbtn" data-toggle="modal" data-target="#frmAddressNew" id="editAddress_{{$order->id}}">
				{{trans('Cart::cart.checkCode.form.addressUpdate')}}
			</a>
				]</span><br>
				{{trans('Cart::cart.checkCode.form.address')}}: <b>{{@$order->address}},
                {{@$order->ward->name}},
                {{@$order->district->name}},
                {{@$order->state->name}}</b>
            <br>
        </div>
    </div>
</div>
@php $sttOrder++; @endphp


@endforeach

<script>
    $(".WardLast").on("click", function () {
	id = $(this).attr("id"),
	addressShip = id,
	$.ajax("/shipPing/" + id, {
		method: "GET",
		dataType: "JSON",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (a) {
			$('.countShipTd').css('opacity','1');
			var e = $(".countShip").html();
			e = "" == e ? 0 : e.replace(",", ""),
			$(".countShip").html(a.shipPing.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
			var t = $(".countTotal").html();
			t = t.split(",").join(""),
			priceEnd = Number(t) + Number(a.shipPing) - Number(e),
			$(".countTotal").html(priceEnd.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"))
		}
	})
});


$('.editAddressbtn').on('click', function(){
		var id  = $(this).attr('id');
        id = id.split("_");
		id = id[1];
		$('#address_update_id').val(id);
		$('#titleAddressNew').html('Cập nhật địa chỉ');
		$(".animationloadpage").show();
	    $.ajax("/user/address/searchAddressAjax/"+id, {
		method: "GET",
		dataType: "json",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (a) {
			$(".animationloadpage").hide();
			if(a.status=='1'){
				console.log(a);
				$('#state').val(a.data.state_id);
				$('#address_new').val(a.data.address);

				$("#district").html("");
				$("#ward").html("");
				var e = "<option></option>";
				$("#district").append($(e).attr("value", 0).text("---Chọn quận/huyện---"));
				$.each(a.districts, function (a, t) {
					var d = t.district_id;
					$("#district").append($(e).attr("value", t.district_id).attr(d ? "selected": "data-id", d ? "selected": t.district_id).text(t.name));
				})
			$("#district").val(a.data.district_id);

			e = "<option></option>";
				$("#ward").append($(e).attr("value", 0).text("---Chọn phường/xã---")),
				$.each(a.wards, function (a, t) {
					var d = t.ward_id;
					$("#ward").append($(e).attr("value", t.ward_id).attr(d ? "selected": "data-id", d ? "selected": t.ward_id).text(t.name))
				})
			$("#ward").val(a.data.ward_id);
			}else{
				$(".alertAjax").removeClass("alert-success");
				$(".alertAjax").addClass("alert-warning");
				$(".alertAjax .content").html(a.message);
				$(".alertAjax").show();
				$(".alert").delay(5000).fadeOut();
			}
		}
	})

		
	})


</script>