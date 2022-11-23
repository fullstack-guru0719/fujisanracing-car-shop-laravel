@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.compare.compare_similar_items') }}
@endsection

@push('stylesheets')
    
@endpush

@section('content-wrapper')
<div class="page-content-wrapper sp-y">
    <div class="wishlist-page-content-wrap">
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
                                        <a class="btn btn-blue" href="{{ route('customer.wishlist.removeall') }}">{{ __('shop::app.customer.account.wishlist.deleteall') }}</a>
                                    </div>
                                @endif
                                <br>
                                @if (count($cproduct))
                                <div class="shopping-cart-table table-responsive">
                                    <table class="table table-bordered text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Product Image</th>
                                                <th>Price</th>
                                                <th>Actions</th>
                                                <th>Brand</th>
                                            </tr>
                                        </thead>
    
                                        <tbody>
                                            @foreach ($cproduct as $key => $item)
                                                <tr>
                                                    <td class="product-list">
                                                        <div class="cart-product-item d-flex align-items-center">
                                                            <div class="remove-icon">
                                                                <a href="{{ route('customer.wishlist.remove', $item['product']['id']) }}"><i class="fa fa-trash-o"></i></a>
                                                            </div>
                                                            <a href="{{ route('shop.productOrCategory.index', $item['product']['url_key']) }}" class="product-name">{{ \Illuminate\Support\Str::limit($item['product']['name'], 23, '...') }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="product-list item-center">
                                                        <div class="cart-product-item d-flex align-items-center">
                                                            <a href="{{ route('shop.productOrCategory.index', $item['product']['url_key']) }}" class="product-thumb">
                                                                <img src="{{ $item['product_image'] }}" alt="" />
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{!! $item['priceHTML'] !!}</td>
                                                    <td class="product-list item-center">
                                                        <div class="cart-product-item d-flex align-items-center">
                                                            {!! $item['addToCartHtml'] !!}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item['brand'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="bottom-toolbar">
                                    {{ $cproduct->links()  }}
                                </div> --}}
                                @endif
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
