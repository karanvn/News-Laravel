@extends('admin.main')

@section('title')
ĐÁNH GIÁ
@endsection

@section('styles')
<link href="admin/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                <i class="far fa-comment-alt"></i>
                <a class="text-dark text-hover-success"
                    href="{{ route('listvaluate') }}">ĐÁNH GIÁ</a>
            </h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold"></span>
            </div>
        </div>
        <!--end::Details-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container container-cus">
        <div class="row">
            <!--begin::Filter-->
            <div class="col-lg-12">
                <form id="frmaddRaiting" name="frmaddRaiting" class="form-horizontal" role="form" >
                    <!--begin::List Widget 10-->
                    @csrf
                    <div class="card card-custom card-stretchs gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">
                                <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus"
                                    id="accordion_filters">
                                    <div class="card">
                                        <div class="card-header">

                                        </div>
                                    </div>
                                </div>
                            </h3>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base">Thêm</button>
                            </div>
                        </div>
                        <!--end::Header-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><b>Họ tên</b></p>
                                            <input type="text" class="form-control" name="name">
                                            <span class="form-text text-error name-error"></span>
                                            <br>
                                            <p><b>Email</b></p>
                                            <input type="email" class="form-control" name="email">
                                            <span class="form-text text-error email-error"></span>
                                            <br>
                                            <p><b>Chọn làm review</b></p>
                                            <select name="review" class="form-control">
                                                <option value="A">Chọn</option>
                                                <option value="D">Vô hiệu hóa</option>
                                            </select>
                                            
                                            <br>
                                        </div>
                                        <div class="col-md-6">
                                            <p><b>Nội dung đánh giá</b></p>
                                            <textarea class="form-control" cols="10" rows="6" name="content"></textarea>
                                            <span class="form-text text-error content-error"></span>
                                            <br>
                                            <p><b>Số sao đánh giá</b></p>
                                            <input type="number" class="form-control" name="star" min="1" max="5">
                                            <span class="form-text text-error star-error"></span>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row collapse {{ @$collapse_total > 0 ? 'show' : '' }}"
                                        id="collapse_filters" data-parent="#accordion_filters">
                                        //
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->

                        <div class="separator separator-solid"></div>
                        <div class="card-body">
                            <!--begin::Pagination-->
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                               

                                @if($datas->lastPage()>1)
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="d-flex flex-wrap mr-3">
                                        @if($datas->currentPage()==1)
                                        <a class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-back icon-xs"></i>
                                        </a>
                                        @else
                                        <a href="{{asset('/evaluate/list')}}?page={{$datas->currentPage()-1}}&status={{$status}}&id={{$id}}"
                                            class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-back icon-xs"></i>
                                        </a>
                                        @endif
                                        <!-- dem so -->
                                        @for($i=1; $i<=$datas->lastPage();$i++)
                                                @if($i==$datas->currentPage())
                                                    <a
                                                class="btn btn-icon btn-sm border-0 btn-hover-success active mr-2 my-1">
                                                <strong>{{$i}}</strong></a>
                                                @else

                                                    @if(($i-$datas->currentPage() <= 3)||($i-$datas->currentPage() <= -3))
                                                    <a href="{{asset('/evaluate/list')}}?page={{$i}}&status={{$status}}&id={{$id}}"
                                                    class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1">{{$i}}</a>
                                           
                                                   @endif

                                                @endif
                                        @endfor
                                        <!--  next -->
                                        @if($datas->currentPage()==$datas->lastPage())
                                        <a class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-next icon-xs"></i>
                                        </a>
                                        @else
                                        <a href="{{asset('/evaluate/list')}}?page={{$datas->currentPage()+1}}&status={{$status}}&id={{$id}}"
                                            class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-next icon-xs"></i>
                                        </a>
                                        @endif
                                        </div>
                                        </div>
                                @endif
                            </div>
                            <!--end:: Pagination-->
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Filter-->
            <!--begin::Card-->
            @if($datas!=null)
            @foreach($datas as $data)
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-dark">
                                        @if($data->status=='A')
                                        <span
                                            class="label label-success label-inline mr-2 font-size-h6 font-weight-bold">
                                            <a href="{{route('editevaluate',['id' => $data->id])}}"
                                                class="text-white text-hover-white">{{ trans('Evaluate::evaluate.list.status.A') }}</a>
                                        </span>
                                        @else
                                        <span
                                            class="label label-warning label-inline mr-2 font-size-h6 font-weight-bold">
                                            <a href="{{route('editevaluate',['id' => $data->id])}}"
                                                class="text-white text-hover-white">{{ trans('Evaluate::evaluate.list.status.D') }}</a>
                                        </span>
                                        @endif
                                        /
                                        @if($data->review=='A')
                                        <span
                                            class="label label-success label-inline mr-2 font-size-h6 font-weight-bold">
                                            <a href="{{route('editreviewproduct',['id' => $data->id])}}"
                                                class="text-white text-hover-white">{{ trans('Evaluate::evaluate.list.review.A') }}</a>
                                        </span>
                                        @else
                                        <span
                                            class="label label-warning label-inline mr-2 font-size-h6 font-weight-bold">
                                            <a href="{{route('editreviewproduct',['id' => $data->id])}}"
                                                class="text-white text-hover-white">{{ trans('Evaluate::evaluate.list.review.D') }}</a>
                                        </span>
                                        @endif

                                        <a target="_blank">
                                            {{@$data->name}}
                                        </a>
                                    </span>
                                    <span class="my-2" style="font-size:0.8em">
                                        <i class="far fa-envelope"></i>
                                        {{@$data->email}}
                                    </span>
                                    <span style="font-size:0.8em">
                                        <i class="far fa-clock"></i>
                                        {{@$data->created_at}}
                                    </span>
                                    <span class="mt-1">
                                        @for($i=1; $i<=$data->star;$i++)
                                            <i class="fas fa-star text-warning"></i>
                                            @endfor
                                    </span>

                                </h3>

                            </div>
                            <div class="card-body pt-0">
                                <!--begin::Top-->
                                <div class="d-flex">
                                    <!--begin: Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->

                                        <!--end::Title-->
                                        <!--begin::Content-->
                                        @if($data->content!='')
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <!--begin::Description-->

                                            <div class="col-lg-12 mt-2">
                                                <!--begin::Top-->
                                                <div class="card row p-3 bg-light-cus">
                                                    <div class="d-flex">
                                                        <!--begin::Pic-->

                                                        <!--end::Pic-->
                                                        <!--begin: Info-->
                                                        <div class="flex-grow-1">
                                                            <!--begin::Title-->
                                                            <div
                                                                class="d-flex align-items-center justify-content-between flex-wrap mt-0">
                                                                <!--begin::User-->
                                                                <div class="mr-3">
                                                                    <!--begin::Name-->
                                                                    <a target="_blank" class="text-hover-success"
                                                                        href=""><span
                                                                            class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-0">{{$data->content}}</span></a>
                                                                            @php $showImageEvaluates = $data->evaluateimage()->get(); @endphp
                                                                            @if(!empty(@$showImageEvaluates))
                                                                            <br>  
                                                                            @foreach ($showImageEvaluates as $showImageEvaluate)
                                                                            <img class="thumbE" src="{{asset('storage/evaluate/thumb')}}/{{@$showImageEvaluate->image}}" alt="Evaluate" style="width:80px" id="{{@$showImageEvaluate->image}}">
                                                                            @endforeach
                                                                            @endif
                                                                    <span class="text-danger">

                                                                    </span>
                                                                    <!--end::Name-->
                                                                </div>
                                                                <!--begin::User-->
                                                            </div>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Top-->
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        @endif

                                        <!--end::Content-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Top-->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!--end::Card-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<div class="SeeimageEvaluate"><img src="" alt=""><button type="button" class="close"><span aria-hidden="true">&times;</span></button></div>

@endsection


@section('scripts')
<script src="admin/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/features/miscellaneous/treeview.js?v=7.0.5"></script>
<script src="js/pages/order.js"></script>
<script src="js/pages/product.js"></script>
<script>
    $('.thumbE').on('click', function(){
        var url = $(this).attr('id');
       $('.SeeimageEvaluate img').attr('src','../storage/evaluate/source/'+url);
       $('.SeeimageEvaluate').show();
  });
  $('.SeeimageEvaluate button').on('click', function(){
      $('.SeeimageEvaluate').hide();
  })
</script>
<style>
    .SeeimageEvaluate{
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index: 10000;
    overflow:hidden;
    background:#000;
    display:none;
}
.SeeimageEvaluate img{
    max-height:100%;
	object-fit: cover;
	position: absolute;
	top:50%;
	left:50%;
	transform: translate(-50%, -50%);
}
.SeeimageEvaluate button{
    position: absolute;
    top:10px;
    right:10px;
    color:#fff;
}
</style>
@endsection