@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.wishlist.page-title') }}
@endsection

@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')

@push('css')
    <style>
        /* .account-action{
            padding-left: 550px;
            background-position: left 550px;
            justify-content: right;
        } */
    </style>
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
                                        @if (count($items))
                                            <div class="account-action">
                                                <a class="btn btn-blue" href="{{ route('customer.wishlist.removeall') }}">{{ __('shop::app.customer.account.wishlist.deleteall') }}</a>
                                            </div>
                                        @endif
                                        <br>
                                        @if ($items->count())
                                            <div class="shopping-cart-table table-responsive">
                                                <table class="table table-bordered text-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Products</th>
                                                            <th>Attributes</th>
                                                            <th>Ratings</th>
                                                            <th>Price</th>
                                                            <th>Cart</th>
                                                        </tr>
                                                    </thead>
                
                                                    <tbody>
                                                        @foreach ($items as $item)
                                                            @php
                                                                $image = $item->product->getTypeInstance()->getBaseImage($item);
                                                            @endphp
                                                            <tr>
                                                                <td class="product-list">
                                                                    <div class="cart-product-item d-flex align-items-center">
                                                                        <div class="remove-icon">
                                                                            <a href="{{ route('customer.wishlist.remove', $item->id) }}"><i class="fa fa-trash-o"></i></a>
                                                                        </div>
                                                                        <a href="{{ route('shop.productOrCategory.index', $item->product->url_key) }}" class="product-thumb">
                                                                            <img src="{{ $image['small_image_url'] }}" alt="" />
                                                                        </a>
                                                                        <a href="{{ route('shop.productOrCategory.index', $item->product->url_key) }}" class="product-name">{{ \Illuminate\Support\Str::limit($item->product->name, 15, '...') }}</a>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    @if (isset($item->additional['attributes']))
                                                                        <div class="item-options">
                            
                                                                            @foreach ($item->additional['attributes'] as $attribute)
                                                                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                                            @endforeach
                            
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="stars" style="display: inline">
                                                                        @for ($i = 1; $i <= $reviewHelper->getAverageRating($item->product); $i++)
                                                                            <span class="icon star-icon"></span>
                                                                        @endfor
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span class="price">${{ number_format($item->product->price, 2) }}</span>
                                                                </td>
                                                                <td class="add-cart">
                                                                    <a href="{{ route('customer.wishlist.move', $item->id) }}" class="btn btn-brand">{{ __('shop::app.customer.account.wishlist.move-to-cart') }}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="bottom-toolbar">
                                                {{ $items->links()  }}
                                            </div>
                                        @else
                                            <div class="empty">
                                                {{ __('customer::app.wishlist.empty') }}
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
