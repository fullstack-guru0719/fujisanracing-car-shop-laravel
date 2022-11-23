@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.review.index.page-title') }}
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
                                        @if (count($reviews))
                                            <div class="account-action">
                                                <a class="btn btn-blue" href="{{ route('customer.review.deleteall') }}">{{ __('shop::app.customer.account.review.index.title') }}</a>
                                            </div>
                                            <br>
                                            <table class="table table-bordered text-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Products</th>
                                                        <th>Comment</th>
                                                        <th>Ratings</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($reviews as $review)
                                                        <?php $image = productimage()->getProductBaseImage($review->product); ?>
                                                        <tr>
                                                            <td class="product-list">
                                                                <div class="cart-product-item d-flex align-items-center">
                                                                    <div class="remove-icon">
                                                                        <a href="{{ route('customer.review.delete', $review->id) }}"><i class="fa fa-trash-o"></i></a>
                                                                    </div>
                                                                    <a href="{{ route('shop.productOrCategory.index', $review->product->url_key) }}" class="product-thumb">
                                                                        <img src="{{ $image['small_image_url'] }}" alt="" />
                                                                    </a>
                                                                    <a href="{{ route('shop.productOrCategory.index', $review->product->url_key) }}" class="product-name">{{ \Illuminate\Support\Str::limit($review->product->name, 15, '...') }}</a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ $review->comment }}
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="stars mt-10">
                                                                    @for($i=0 ; $i < $review->rating ; $i++)
                                                                        <span class="ion-star"></span>
                                                                    @endfor
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="empty mt-15">
                                                {{ __('customer::app.reviews.empty') }}
                                            </div>
                                        @endif
                                        <div class="bottom-toolbar">
                                            {{ $reviews->links()  }}
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
</div>
@endsection
