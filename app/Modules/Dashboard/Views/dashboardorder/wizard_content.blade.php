<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::List Widget 10-->
                <div class="">
                    <!--begin::Header-->
                    <div class="card-headers border-0">
                        <span class="card-title font-weight-bolder text-dark">
                            <form action="{{route("excelOrderStatis")}}" method="POST">
                                @csrf
                                
                                @if(count($dates)==1)
                                <input type="hidden" name="dates" value="Thống kê cho ngày {{$dates[0]}}">
                                @else
                                <input type="hidden" name="dates" value="Thống kê từ {{$dates[0]}} đến {{$dates[count($dates)-1]}}">
                                @endif
                                @if(!empty($categories))
                                @foreach($categories as $key => $value)
                                    <input type="hidden" name="categories[]" value="{{$value}}">
                                    <input type="hidden" name="com[]" value="{{!empty($values[$key]) ? $values[$key] : 0}}">
                                    <input type="hidden" name="can[]" value="{{!empty($valuesFalse[$key]) ? $valuesFalse[$key] : 0}}">
                                    <input type="hidden" name="conf[]" value="{{!empty($valuesCONF[$key]) ? $valuesCONF[$key] : 0}}">
                                    <input type="hidden" name="ship[]" value="{{!empty($valuesSHIP[$key]) ? $valuesSHIP[$key] : 0}}">
                                    <input type="hidden" name="pln[]" value="{{!empty($valuesPLN[$key]) ? $valuesPLN[$key] : 0}}">
                                                            @endforeach
                                                        @endif
                                
                                                         
                            <h5 style="display:inline-block"><strong>{{ trans('Dashboard::dashboard.revenue') }}</strong></h5>
                            / <button  class="border-0 bg-transparent text-success" id="ExcelOut">Xuất thống kê EXCEL</button>
                            </form>
                        </span>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!--end::Header-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Body-->
                    <div class="card-bodys mt-4">
                        <div id="wedget-chart-step-{{ $step }}"></div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::List Widget 10-->
                <div class="">
                    <!--begin::Header-->
                    <div class="card-headers border-0">
                        <span class="card-title font-weight-bolder text-dark">
                            <h5><strong>Thống kê tổng quan</strong></h5>
                        </span>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!--end::Header-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Body-->
                    <div class="card-bodys mt-4">
                    

<div id="chartElip-{{ $step }}"></div>
                         
                       
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>