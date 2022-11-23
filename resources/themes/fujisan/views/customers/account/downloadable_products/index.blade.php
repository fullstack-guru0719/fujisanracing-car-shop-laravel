@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.downloadable_products.title') }}
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
                            {!! view_render_event('bagisto.shop.customers.account.downloadable_products.list.before') !!}
        
                            <div class="account-items-list">
                                <div class="account-table-content">
                
                                    {!! app('Webkul\Shop\DataGrids\DownloadableProductDataGrid')->render() !!}
                
                                </div>
                            </div>
                
                            {!! view_render_event('bagisto.shop.customers.account.downloadable_products.list.after') !!}
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
