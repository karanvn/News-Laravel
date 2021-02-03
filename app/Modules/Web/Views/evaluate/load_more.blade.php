@foreach(@$data as $evaluate)
<div class="col-12 bg-light mb-1 py-3">
	<p class="py-0 my-0">
		<b>{{@$evaluate->name}}</b>
		<span class="text-success ml-2"><i class="fa fa-check-circle mx-2" aria-hidden="true"></i>Chứng nhận đã mua hàng</span>
	</p>
	<div class="star-rating"><span style="width:{{@$evaluate->star * 20}}%">Rated <strong class="rating">0</strong> out
			of
			5</span></div>
	<p class="py-0 my-0">
		<i><small>{{@$evaluate->created_at}}</small></i>
	</p>
	<p class="pt-0 my-0">
		{{@$evaluate->content}}
		@php $showImageEvaluates = $evaluate->evaluateimage()->get(); @endphp
		@if(!empty(@$showImageEvaluates))
		<br>
		@foreach ($showImageEvaluates as $showImageEvaluate)
		<img class="thumbE" src="{{asset('storage/evaluate/thumb')}}/{{@$showImageEvaluate->image}}" alt="Evaluate"
			style="width:80px" id="{{@$showImageEvaluate->image}}">
		@endforeach
		@endif
	</p>
</div>
@endforeach
<script>
	$('.thumbE').on('click', function () {
		var url = $(this).attr('id');
		$('.SeeimageEvaluate img').attr('src', '../storage/evaluate/source/' + url);
		$('.SeeimageEvaluate').show();
	});
	$('.SeeimageEvaluate button').on('click', function () {
		$('.SeeimageEvaluate').hide();
	})
</script>
<style>

</style>