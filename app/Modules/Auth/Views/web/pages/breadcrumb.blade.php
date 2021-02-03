<div class="banner-wrapper">
    <div class="banner-wrapper-inner">
        <h1 class="page-title  text-uppercase">{{ trans('Auth::customer.breadcrumb.'.\Route::current()->getName()) }}</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="{{ asset('') }}"><span>Home</span></a></li>
                <li class="trail-item trail-end "><span>{{ trans('Auth::customer.breadcrumb.'.\Route::current()->getName()) }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>