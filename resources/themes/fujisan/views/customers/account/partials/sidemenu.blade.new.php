<ul class="nav nav-tabs flex-lg-column mb-3 sticky-top" id="myTab" role="tablist">
    @foreach ($menu->items as $menuItem)
        @php
            $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;

            $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
        @endphp

        @if (! $showCompare)
            @php
                unset($menuItem['children']['compare']);
            @endphp
        @endif

        @if (! $showWishlist)
            @php
                unset($menuItem['children']['wishlist']);
            @endphp
        @endif

        <li class="nav-item"> <a class="nav-link {{ Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/profile' ? 'active' : '' }}" href="{{ url('customer/account/profile') }}"><i class="ion-android-person"></i> Profile</a> </li>
        <li class="nav-item"> <a class="nav-link {{ Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/addresses' ? 'active' : '' }}" href="{{ url('customer/account/addresses') }}" href="{{ url('customer/account/addresses') }}"><i class="ion-location"></i> Address</a> </li>
        <li class="nav-item"> <a class="nav-link {{ Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/reviews' ? 'active' : '' }}" href="{{ url('customer/account/reviews') }}"><i class="ion-android-star-outline"></i> Reviews</a> </li>
        <li class="nav-item"> <a class="nav-link {{ Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/wishlist' ? 'active' : '' }}" href="{{ url('customer/account/wishlist') }}"><i class="ion-ios-heart"></i> Wishlist</a> </li>
        <li class="nav-item"> <a class="nav-link {{ Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/comparison' ? 'active' : '' }}" href="{{ url('customer/account/comparison') }}"><i class="ion-arrow-swap"></i> Compare</a> </li>
        <li class="nav-item"> <a class="nav-link {{ Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/orders' ? 'active' : '' }}" href="{{ url('customer/account/orders') }}"><i class="ion-android-document"></i> Orders</a> </li>
        <li class="nav-item"> <a class="nav-link {{ Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/downloadable-products' ? 'active' : '' }}" href="{{ url('customer/account/downloadable-products') }}"><i class="ion-android-download"></i> Downloadable Products</a> </li>
    @endforeach
</ul>

@push('scripts')

@endpush