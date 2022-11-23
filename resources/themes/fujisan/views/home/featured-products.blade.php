@php
$featured = app('Webkul\Product\Repositories\ProductRepository')->getFeaturedProducts();
@endphp

@if (count($featured))
    <div class="best-seller-products-area sm-top">
        <div class="container container-wide">
            <div class="row">
                <div class="col-lg-5 m-auto text-center">
                    <div class="section-title">
                        <h2 class="h3">{{ __('shop::app.home.featured-products') }}</h2>
                        <?php /*
                        <p>All best seller product are now available for you and your can buy
                            this product from here any time any where so sop now</p>
                            */?>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-12">
                <div class="product-wrapper">
                    <div class="product-carousel">
                        @foreach ($featured as $productFlat)

                            @if (core()->getConfigData('catalog.products.homepage.out_of_stock_items'))
                                @include ('shop::products.list.card', ['product' => $productFlat])
                            @else
                                @if ($productFlat->isSaleable())
                                    @include ('shop::products.list.card', ['product' => $productFlat])
                                @endif
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif