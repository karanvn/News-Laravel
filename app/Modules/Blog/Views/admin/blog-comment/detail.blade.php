@extends('admin.main')

@section('title')
Xem Comment
@endsection

@section('content')
<style>
    .avatar{
        width: 35px; 
        height: 35px;
        background: #C30; 
        text-align: center;
        color: #dfb99e;
        border-radius: 30px; 
        float: left;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <form method="post" class="form-horizontal" role="form" action="{{route('comment-add-post')}}">
        @csrf
            <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            <input type="hidden" name="blog_id" value="{{ $comment->blog_id }}" />
            <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Mobile Toggle-->
                        <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none"
                            id="kt_subheader_mobile_toggle">
                            <span></span>
                        </button>
                        <!--end::Mobile Toggle-->
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase"><a
                                    href="{{ route('comment-list',$comment->blog_id) }}" class="text-dark text-hover-success"><i
                                        class="icon-1x text-dark-10 flaticon2-fast-back"></i></a>Xem Comment
                            </h5>
                            <!--end::Page Title-->
                            <!--begin::Breadcrumb-->

                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <!--begin::Button-->
                        {{-- <a href="{{ route('comment-list',$comment->blog_id) }}"
                            class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i
                                class="icon-1x text-dark-50 flaticon2-back-1"></i>
                                Xem Comment</a> --}}
                        <!--end::Button-->
                        <!--begin::Button-->
                        {{-- <div class="btn-group ml-2">
                            <a href="#" class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base"><i
                                class="icon-x far fa-plus-square"></i>
                                Thêm danh mục con
                            </a>
                        </div> --}}
                        <!--end::Button-->
                        <div class="btn-group ml-2">
                            <a href="{{ route('comment-delete',$comment->id) }}" class="btn btn-warning font-weight-bold btn-sm px-3 font-size-base"><i
                                    class="icon-x fas fa-save"></i>
                                Xóa comment này
                            </a>
                        </div>
                        <!--begin::Dropdown-->
                        <div class="btn-group ml-2">
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i
                                    class="icon-x fas fa-save"></i>
                                Trả lời
                            </button>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
        <!--end::Subheader-->
        
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container container-cus">
                <!--begin::Card-->
                <div class="d-flex flex-row">
                    <div class="flex-row-fluid">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-lg-7">
                                <!--begin::List Widget 14-->
                                <div class="card card-custom gutter-b">
                                    <!--begin::Header-->
                                    <div class="card-header border-0">
                                        <h3 class="card-title font-weight-bolder text-dark">
                                            {{trans('Blog::blogcategory.add.header_title') }}</h3>
                                        <div class="card-toolbar">

                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <div class="separator separator-solid"></div>
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <label class="col-form-label">Trả lời</label>
                                                <textarea class="form-control" name="comment"></textarea>
                                                @if($errors->has('comment'))
                                                <p class="text-danger"> {{$errors->first('comment')}}</p>
                                                @endif
                                            </div>
                                            <!-- status -->
                                            {{-- <div class="form-group row">
                                                <label
                                                    class="col-form-label">{{trans('Blog::blogcategory.add.form.status') }}
                                                </label>
                                                <select class="form-control custom-select" name="status"
                                                    id="status">
                                                    <option>--Trạng thái--</option>
                                                    <option value="D">
                                                        {{trans('Blog::blogcategory.add.form.statuses.D') }}
                                                    </option>
                                                    <option value="A">
                                                        {{trans('Blog::blogcategory.add.form.statuses.A') }}
                                                    </option>
                                                </select>
                                                @if($errors->has('status'))
                                                <p class="text-danger"> {{$errors->first('status')}}</p>
                                                @endif
                                                </p>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::List Widget 14-->
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!--begin::List Widget 10-->
                                        <div class="card card-custom card-stretchs gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0 col-lg-12">
                                                <div class="grid-comment col-lg-12">
                                                    <label><h1>Bình luận</h1></label>
                                                    <hr>
                                                    <!--start node-->
                                                    <div class="node-commnet">
                                                        <div class="avatar">
                                                            <span class="yotpo-user-letter">{{ $comment->name['0'] }}</span>
                                                            <span class="yotpo-icon yotpo-icon-circle-checkmark yotpo-action-hover" data-type="toggleFade" data-target="yotpo-tool-tip" data-target-container="yotpo-header"></span>
                                                        
                                                        </div>
                                                        <div class="info-comment">
                                                            <div class="info-preson">
                                                                <span class="name"><b>{{ $comment->name }}</b></span>
                                                            </div>
                                                            <div class="comment">
                                                                {{ $comment->comment }}
                                                                @foreach($replies as $reply)
                                                            
                                                                <div style="text-indent:70px">
                                                                    <div class="info_answer"><b class="qtv">{{ $reply->user->name }}</b>Trả lời : </div>
                                                                        <p>{{ $reply->comment }}</p>
                                                                </div>
                                                            
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <br>
                                                    
                                                    
                                                    <!--end node-->
                                                </div>
                                            </div>
                                            <!--end::Header-->
                                           
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </form>
</div>




@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="js/pages/branch.js?v=1.0.0"></script>
<script src="js/pages/location.js?v=1.0.0"></script>
@endsection