@php
    $route = \Route::current()->getName();
    $isActive = function($route,$subMenu ='profile-customer')
    {
        return $route==$subMenu?'is-active':'';
    };
@endphp
<nav class="lynessa-MyAccount-navigation">
    <ul>
        <li class="lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--info {{ $isActive($route,'profile-customer') }}">
            <a href="{{route('profile-customer') }}"  >{{ trans('Auth::customer.list.header_title_info') }}</a>
        </li>
        <li class="lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--info {{ $isActive($route,'profilePoint') }}">
            <a href="{{route('profilePoint') }}"  >{{ trans('Auth::customer.breadcrumb.profilePoint') }}</a>
        </li>
        <li class="lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--orders {{ $isActive($route,'orders-customer') }} {{ $isActive($route,'order-detail') }}">
        <a href="{{ route('orders-customer') }}">{{ trans('Auth::customer.add.form.order.header_list') }}</a>
        </li>
        <li class="lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--address {{ $isActive($route,'address-customer') }} {{ $isActive($route,'add-address-customer') }}">
           
            <a href="{{ route('address-customer') }}">{{ trans('Auth::customer.breadcrumb.address-customer') }}</a>
        </li>
        <li class="lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--changepassword {{ $isActive($route,'change-password') }}">
            <a href="{{ route('change-password') }}">{{ trans('Auth::customer.breadcrumb.change-password') }}</a>
        </li>
        <li class="lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--customer-logout">
            <a href="{{route('logout')}}">{{ trans('Auth::auth.logout') }}</a>
        </li>
        
    </ul>
</nav>