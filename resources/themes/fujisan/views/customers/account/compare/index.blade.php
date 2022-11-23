@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.compare.compare_similar_items') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('vendor/webkul/ui/assets/css/shop.css') }}">
@endpush

@section('content-wrapper')
<div class="page-content-wrapper sp-y">
    <div class="wishlist-page-content-wrap">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="product-config">
                                @include('shop::customers.account.partials.sidemenu')
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="product-config">
                                <div class="col-lg-12">
                                    <div class="shopping-cart-list-area">
                                        @if (count($cproduct))
                                            <div class="account-action">
                                                <a class="btn btn-blue" href="{{ route('customer.product.delete.compare') }}">{{ __('shop::app.customer.account.wishlist.deleteall') }}</a>
                                            </div>
                                        @endif
                                        <br>
                                        @if (count($cproduct))
                                            <div class="shop-page-product">
                                                <div class="container container-wide">
                                                    <div class="product-wrapper product-layout layout-grid">
                                                        <div class="row mtn-30">
                                                            @foreach ($cproduct as $key => $item)
                                                                <!-- Start Product Item -->
                                                                <div class="col-sm-6 col-lg-4 col-xl-4">
                                                                    <div class="product-item">
                                                                        <div class="product-item__thumb">
                                                                            <a href="{{ route('shop.productOrCategory.index', $item['product']['url_key']) }}">
                                                                                <img class="thumb-primary" src="{{ $item['galleryImages'][0]['medium_image_url'] }}" alt="" />
                                                                                <img class="thumb-secondary" src="{{ $item['galleryImages'][1]['medium_image_url'] }}" alt="" />
                                                                            </a>
                                        
                                                                        </div>
                                        
                                                                        <div class="product-item__content">
                                                                            <div class="product-item__info">
                                                                                <h4 class="title"><a href="{{ route('shop.productOrCategory.index', $item['product']['url_key']) }}">{{ \Illuminate\Support\Str::limit($item['product']['name'], 60, '...') }}</a></h4>
                                                                                {!! $item['priceHTML'] !!}
                                                                            </div>
                                        
                                                                            <div class="product-item__action">
                                                                                <a onclick="document.getElementById('add-to-cart-{{$item['product']['id']}}').submit();" class="btn-add-to-cart"><i class="ion-bag"></i></a>
                                                                                <a href="{{ route('customer.wishlist.add', $item['product']['id']) }}" class="btn-add-to-cart"><i class="ion-ios-heart-outline"></i></a>
                                                                                <a href="{{ route('customer.product.single.delete.compare', $item['product']['id']) }}" class="btn-add-to-cart"><i class="ion-close"></i></a>
                                                                            </div>
                                                                            <form id="add-to-cart-{{$item['product']['id']}}" action="{{ route('cart.add', $item['product']['id']) }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}">
                                                                                <input type="hidden" name="quantity" value="1">
                                                                            </form>
                                        
                                                                            <div class="product-item__desc">
                                                                                {!! $item['short_description'] !!}
                                                                            </div>
                                                                        </div>
                                        
                                                                        @if ($item['new'])
                                                                            <div class="product-item__new">
                                                                                <span>{{ __('shop::app.products.new') }}</span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <!-- End Product Item -->
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="empty">
                                                {{ __('You Don\'t Have Any Items In Your Compare List') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')

@endpush
