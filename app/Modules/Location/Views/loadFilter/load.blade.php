@if(@$type=='districts')

        <input type="text" id="myInput" onkeyup="myFunctionShipping()" placeholder="Chọn huyện" title="Type in a name">
        <ul id="myUL">
        
        @if(isset($districts))
        @if(!empty($districts))
        @foreach($districts as $district)
        <li class="districts" id="districts_{{$district->district_id}}"><a>{{$district->name}}</a></li>
        @endforeach
        @endif
        @endif
        </ul>

        <script>
            
            $('.districts').on('click', function(){
            var id  = $(this).attr('id');
            id = id.split("_");
            id = id[1];

            $('.animationloadpage').show();
            $.ajax('/ward/loadFilter/' + id, {
                method: 'GET',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (res) {
                    $('.animationloadpage').hide();
                    $('.shippingInProduct').hide();
                    $('.shippingInProduct').html(res.data);
                    $('.shippingInProduct').show();

                }
            });
        });

       // button reload
        $('#leftshippingis').on('click',  function(){
            $('#leftshippingis').attr("id","leftshippingstates");
            $('.animationloadpage').show();
        $.ajax('/states/loadFilter/', {
            method: 'GET',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
			$('.animationloadpage').hide();
            $('.shippingInProduct').hide();
			$('.shippingInProduct').html(res.data);
            $('.shippingInProduct').show();
           

		}
	});
        })
        </script>
@endif

@if(@$type=='wards')
<input type="hidden" id="myInput" onkeyup="myFunctionShipping()" placeholder="Chọn xã" title="Type in a name">
<ul id="myUL">
  @if(isset($wards))
  @if(!empty($wards))
  @foreach($wards as $ward)
  <li class="wards" id="wards_{{$ward->ward_id}}"><a>{{$ward->name}}</a></li>
  @endforeach
  @endif
  @endif
</ul>

<input type="hidden" value="{{@$states}}" id="backdist">
<script>
    $('.wards').on('click', function(){
	var id  = $(this).attr('id');
    id = id.split("_");
    id = id[1];
    
    $('.animationloadpage').show();
	$.ajax('/shipPing/' +id, {
		method: 'GET',
		dataType: 'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success: function (res) {
			$('.animationloadpage').hide();
            console.log(res);
            $('.shipping .countShip').html(res.shipPing.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
            $('.nameLocationShipProduct').html(res.nameLocation);
            $('.shipping').show();
            $('.close').click();
		}
	});
});

// BUT QUAY LAI
$('#leftshippingstates').on('click',  function(){
            $('.animationloadpage').show();
            $(this).attr('id','leftshippingis');
            $.ajax('/district/loadFilter/' + $('#backdist').val(), {
		method: 'GET',
		dataType: 'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success: function (res) {
            $('.animationloadpage').hide();
            $('.shippingInProduct').hide();
            $('.shippingInProduct').html(res.data);
            $('.shippingInProduct').show();
           
		}
	});

		});

</script>

@endif

@if(@$type=='states')

<input type="text" id="myInput" onkeyup="myFunctionShipping()" placeholder="Chọn tỉnh" title="Type in a name">
<ul id="myUL">
  
  @if(isset($states))
  @if(!empty($states))
  @foreach($states->where('state_id', '437') as $state)
  <li class="states" id="states_{{$state->state_id}}"><a>{{$state->name}}</a></li>
  @endforeach
  @foreach($states->where('state_id','440') as $state)
  <li class="states" id="states_{{$state->state_id}}"><a>{{$state->name}}</a></li>
  @endforeach
  @foreach($states->where('state_id','<>','440')->where('state_id','<>','437') as $state)
  <li class="states" id="states_{{$state->state_id}}"><a>{{$state->name}}</a></li>
  @endforeach
  @endif
  @endif
</ul>

<script>
    
$('.states').on('click', function(){
	var id  = $(this).attr('id');
    id = id.split("_");
	id = id[1];

	$('.animationloadpage').show();
	$.ajax('/district/loadFilter/' + id, {
		method: 'GET',
		dataType: 'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success: function (res) {
            $('.animationloadpage').hide();
            $('.shippingInProduct').hide();
            $('.shippingInProduct').html(res.data);
            $('.shippingInProduct').show();
            
            
		}
	});
});
</script>

@endif 

<script>
    function myFunctionShipping() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

