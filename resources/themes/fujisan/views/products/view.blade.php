@extends('shop::layouts.master')

@section('page_title')
    {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
@stop

@section('seo')
    <meta name="description" content="{{ trim($product->meta_description) != "" ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '') }}"/>

    <meta name="keywords" content="{{ $product->meta_keywords }}"/>

    @if (core()->getConfigData('catalog.rich_snippets.products.enable'))
        <script type="application/ld+json">
            {{ app('Webkul\Product\Helpers\SEO')->getProductJsonLd($product) }}
        </script>
    @endif

    <?php $productBaseImage = productimage()->getProductBaseImage($product); ?>

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:title" content="{{ $product->name }}" />

    <meta name="twitter:description" content="{!! htmlspecialchars(trim(strip_tags($product->description))) !!}" />

    <meta name="twitter:image:alt" content="" />

    <meta name="twitter:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:type" content="og:product" />

    <meta property="og:title" content="{{ $product->name }}" />

    <meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:description" content="{!! htmlspecialchars(trim(strip_tags($product->description))) !!}" />

    <meta property="og:url" content="{{ route('shop.productOrCategory.index', $product->url_key) }}" />
@stop

<?php
    $images = productimage()->getGalleryImages($product);
?>

@section('content-wrapper')
    {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}

    <div class="page-header-wrap bg-img" style="
            @if(!empty($images))
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), {{ "url(" . $images[0]['original_image_url'] . ")" }};
            @else
                background: rgba(0,0,0,0.5);
            @endif
            ">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-header-content">
                        <div class="page-header-content-inner">
                            <h1>Product Details</h1>

                            {{ Breadcrumbs::render('product', $product) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper sp-y">
        <div class="product-details-page-content">
            <div class="container container-wide">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <!-- Start Product Thumbnail Area -->
                                @include ('shop::products.view.gallery')
                            <!-- End Product Thumbnail Area -->

                            <!-- Start Product Info Area -->
                            <div class="col-md-7">
                                <product-view>
                                    <div class="form-container">
                                        @csrf()

                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <div class="product-details-info-content-wrap">
                                            <div class="prod-details-info-content">
                                                <h2>{{ $product->name }}</h2>

                                                @include ('shop::products.view.stock', ['product' => $product])
                                                @include ('shop::products.price', ['product' => $product])

                                                {!! view_render_event('bagisto.shop.products.view.short_description.before', ['product' => $product]) !!}

                                                {!! $product->short_description !!}

                                                {!! view_render_event('bagisto.shop.products.view.short_description.after', ['product' => $product]) !!}

                                                @include ('shop::products.view.configurable-options')

                                                {!! view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]) !!}

                                                <div class="product-action">
                                                    <div class="action-top d-sm-flex">
                                                        @if ($product->getTypeInstance()->showQuantityBox())
                                                            <quantity-changer></quantity-changer>
                                                        @else
                                                            <input type="hidden" name="quantity" value="1">
                                                        @endif

                                                        <input class="btn btn-bordered" type="submit" value="Add to Cart" />
                                                    </div>
                                                </div>

                                                {!! view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]) !!}
                                                @include ('shop::products.view.downloadable')

                                                @include ('shop::products.view.grouped-products')

                                                @include ('shop::products.view.bundle-options')

                                            </div>
                                        </div>
                                    </div>
                                <product-view>
                            </div>
                            <!-- End Product Info Area -->
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="product-description-review">
                                    <!-- Product Description Tab Menu -->
                                    <ul class="nav nav-tabs desc-review-tab-menu" id="desc-review-tab" role="tablist">
                                        <li>
                                            <a class="active" id="desc-tab" data-toggle="tab" href="#descriptionContent" role="tab">Description</a>
                                        </li>
                                        <li>
                                            <a id="profile-tab" data-toggle="tab" href="#reviewContent">{{ __('shop::app.products.reviews-title') }}</a>
                                        </li>
                                    </ul>

                                    <!-- Product Description Tab Content -->
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="descriptionContent">
                                            <div class="description-content">
                                                {!! $product->description !!}
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="reviewContent">
                                            @include ('shop::products.view.reviews')
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

    {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}
@endsection

@push('scripts')

    <script type="text/x-template" id="product-view-template">
        <form method="POST" id="product-form" action="{{ route('cart.add', $product->product_id) }}" @click="onSubmit($event)">

            <input type="hidden" name="is_buy_now" v-model="is_buy_now">

            <slot></slot>

        </form>
    </script>

    <script type="text/x-template" id="quantity-changer-template">
        <div class="pro-qty mr-3 mb-4 mb-sm-0">
            <div class="quantity control-group" :class="[errors.has(controlName) ? 'has-error' : '']">
                <a href="#" @click.prevent="decreaseQty()" class="dec qty-btn" >-</a>
                <input :name="controlName" class="control" :value="qty" :v-validate="validations" data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;" readonly>
                <a href="#" @click.prevent="increaseQty()" class="inc qty-btn" >+</a>
                <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
            </div>
        </div>
    </script>

    <script>

        Vue.component('product-view', {

            template: '#product-view-template',

            inject: ['$validator'],

            data: function() {
                return {
                    is_buy_now: 0,
                }
            },

            methods: {
                onSubmit: function(e) {
                    if (e.target.getAttribute('type') != 'submit')
                        return;

                    e.preventDefault();

                    var this_this = this;

                    this.$validator.validateAll().then(function (result) {
                        if (result) {
                            this_this.is_buy_now = e.target.classList.contains('buynow') ? 1 : 0;

                            setTimeout(function() {
                                document.getElementById('product-form').submit();
                            }, 0);
                        }
                    });
                }
            }
        });

        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',

            inject: ['$validator'],

            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                },

                minQuantity: {
                    type: [Number, String],
                    default: 1
                },

                validations: {
                    type: String,
                    default: 'required|numeric|min_value:1'
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            watch: {
                quantity: function (val) {
                    this.qty = val;

                    this.$emit('onQtyUpdated', this.qty)
                }
            },

            methods: {
                decreaseQty: function() {
                    if (this.qty > this.minQuantity)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        $(document).ready(function() {
            var addTOButton = document.getElementsByClassName('add-to-buttons')[0];
            //document.getElementById('loader').style.display="none";
            //addTOButton.style.display="flex";
        });

        window.onload = function() {
            var thumbList = document.getElementsByClassName('thumb-list')[0];
            var thumbFrame = document.getElementsByClassName('thumb-frame');
            var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

            if (thumbList && productHeroImage) {

                for(let i=0; i < thumbFrame.length ; i++) {
                    thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                    thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                }

                if (screen.width > 720) {
                    thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                    thumbList.style.height = productHeroImage.offsetHeight + "px";
                }
            }

            window.onresize = function() {
                if (thumbList && productHeroImage) {

                    for(let i=0; i < thumbFrame.length; i++) {
                        thumbFrame[i].style.height = (productHeroImage.offsetHeight/4) + "px";
                        thumbFrame[i].style.width = (productHeroImage.offsetHeight/4)+ "px";
                    }

                    if (screen.width > 720) {
                        thumbList.style.width = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.minWidth = (productHeroImage.offsetHeight/4) + "px";
                        thumbList.style.height = productHeroImage.offsetHeight + "px";
                    }
                }
            }
        };
    </script>
@endpush
