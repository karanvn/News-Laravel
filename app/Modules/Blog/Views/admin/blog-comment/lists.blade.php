@extends('admin.main')

@section('title')
QUẢN LÝ BÌNH LUẬN BLOG
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
               QUẢN LÝ BÌNH LUẬN BLOG
               
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
        @if(session()->has('success'))
<div class="alert alert-success " role="alert">
    {{ session('success') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
        <div class="row">
            <!--begin::Filter-->
            <div class="col-lg-12">
                <form id="frmFilterOrder" name="frmFilterOrder" class="form-horizontal" role="form">
                    <!--begin::List Widget 10-->
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
                                <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base"><i
                                        class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Order::order.list.filter.btn') }}</button>
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
                                            <p>Tên bài viết</b></p>
                                            <input type="text" class="form-control" name="nameBlog">
                                        </div>
                                        <div class="col-md-6">
                                            <p><b>{{ trans('Evaluate::evaluate.list.status.header') }}</b></p>
                                            <select name="status" class="form-control">
                                                <option value="">{{ trans('Evaluate::evaluate.list.status.None') }}
                                                </option>
                                                <option value="A">{{ trans('Evaluate::evaluate.list.status.A') }}
                                                </option>
                                                <option value="D">{{ trans('Evaluate::evaluate.list.status.D') }}
                                                </option>
                                            </select>
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
                                        <a href="{{route('listsCommentBlog')}}?page={{$datas->currentPage()-1}}&status={{$status}}&nameBlog={{$nameBlog}}"
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

                                                    @if(($i-$datas->currentPage() <= 6)&&($i-$datas->currentPage() >= -6))
                                                    <a href="{{route('listsCommentBlog')}}?page={{$i}}&status={{$status}}&nameBlog={{$nameBlog}}"
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
                                        <a href="{{route('listsCommentBlog')}}?page={{$datas->currentPage()+1}}&status={{$status}}&nameBlog={{$nameBlog}}"
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
                                            <a href="{{route('editStatusCommentBlog',['id' => $data->id])}}"
                                                class="text-white text-hover-white">{{ trans('Evaluate::evaluate.list.status.A') }}</a>
                                        </span>
                                        @else
                                        <span
                                            class="label label-warning label-inline mr-2 font-size-h6 font-weight-bold">
                                            <a href="{{route('editStatusCommentBlog',['id' => $data->id])}}"
                                                class="text-white text-hover-white">{{ trans('Evaluate::evaluate.list.status.D') }}</a>
                                        </span>
                                        @endif
                                       
                                        
                                        <a target="_blank">
                                            {{$data->name}}
                                        </a>
                                        comment in
                                        <i class="text-info">
                                            {{@$data->blog->title}}
                                        </i>
                                    </span>
                                    <span class="my-2" style="font-size:0.8em">
                                        <i class="far fa-envelope"></i>
                                        @if($data->user_id!=null)
                                        {{App\User::find($data->user_id)->email}}
                                        @else
                                        {{$data->email}}
                                        @endif
                                    </span>
                                    <span style="font-size:0.8em">
                                        <i class="far fa-clock"></i>
                                        {{$data->created_at}}
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
                                        {!! $data->comment !!}
                                        <p>
                                            <a href="{{route('deleteStatusCommentBlog',['id' => $data->id])}}">X</a>
                                           </p>
                                        <!--end::Content-->
                                        <div class="commentChild">
                                            @if(count(@$data->child()->get())>0)
                                              @foreach(@$data->child()->get() as $child)
                                                <div class="alert alert-light mb-1">
                                                <b>{{@$child->name}}</b>
                                               
                                                    {{@$child->comment}}
                                               <i>{{@$child->created_at}}</i>
                                               <p>
                                                <a href="{{route('deleteStatusCommentBlog',['id' => $child->id])}}">X</a>
                                               </p>
                                                </div>
                                              @endforeach
                                            @else
                                               
                                            @endif
                                            <div class="form">
                                                <form action="{{route('comment')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="blog_id" value="{{@$data->product_id}}">
                                                    <input type="hidden" name="parent_id" value="{{@$data->id}}">
                                                    <input type="hidden" name="user_id" value="{{@Auth::id()}}">
                                                    <input type="hidden" name="name" value="{{@Auth::user()->name}}" placeholder="Họ tên" pattern="[a-zA-Z0-9]{1,150}"
                                                    title="Không được để trống">
                                                    <input type="hidden" name="email" value="{{@Auth::user()->email}}" placeholder="Địa chỉ Email">
                                                    <textarea name="comment" pattern="[a-zA-Z0-9]{1,7000}"
                                                    title="Không được để trống" class="form-control border"></textarea>	
                                                    <button class="btn btn-info mt-1">Trã lời</button>
                                                    </form>
                                            </div>
                                        </div>
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