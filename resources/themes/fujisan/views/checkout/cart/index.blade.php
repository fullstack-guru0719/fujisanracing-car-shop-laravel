@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.cart.title') }}
@stop

@section('content-wrapper')
    <div class="page-header-wrap bg-img" style="background: rgba(0,0,0,0.5);">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-header-content">
                        <div class="page-header-content-inner">
                            <h1>Cart</h1>

                            {{ Breadcrumbs::render('cart') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper sp-y">
        @if ($cart)
            <div class="cart-page-content-wrap">
                <div class="container container-wide">
                    <form action="{{ route('shop.checkout.cart.update') }}" method="POST" @submit.prevent="onSubmit">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="shopping-cart-list-area">
                                    <div class="shopping-cart-table table-responsive">
                                        <table class="table table-bordered text-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Products</th>
                                                    <th>Price</th>
                                                    @if (isset($item->additional['attributes']))
                                                        <th>Options</th>
                                                    @endif
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cart->items as $key => $item)
                                                    <tr>
                                                        @php
                                                            $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);

                                                            if (is_null ($item->product->url_key)) {
                                                                if (! is_null($item->product->parent)) {
                                                                    $url_key = $item->product->parent->url_key;
                                                                }
                                                            } else {
                                                                $url_key = $item->product->url_key;
                                                            }
                                                        @endphp

                                                        <td class="product-list">
                                                            <div class="cart-product-item d-flex align-items-center">
                                                                <div class="remove-icon">
                                                                    <a
                                                                        style="color: black"
                                                                        href="{{ route('shop.checkout.cart.remove', $item->id) }}"
                                                                        onclick="confirm('{{ __('shop::app.checkout.cart.cart-remove-action') }}')
                                                                    ">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </a>
                                                                    
                                                                </div>
                                                                <a href="{{ route('shop.productOrCategory.index', $url_key) }}" class="product-thumb">
                                                                    <img src="{{ $productBaseImage['medium_image_url'] }}" alt="Product">
                                                                </a>
                                                                {!! view_render_event('bagisto.shop.checkout.cart.item.name.before', ['item' => $item]) !!}
                                                                <div style="max-width: 250px; overflow-wrap: normal; white-space: normal">
                                                                    <a href="{{ route('shop.productOrCategory.index', $url_key) }}" class="product-name">
                                                                        {{ $item->product->name }}
                                                                    </a>
                                                                </div>
                                                                {!! view_render_event('bagisto.shop.checkout.cart.item.name.after', ['item' => $item]) !!}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {!! view_render_event('bagisto.shop.checkout.cart.item.price.before', ['item' => $item]) !!}
                                                            <span class="price">{{ core()->currency($item->base_price) }}</span>
                                                            {!! view_render_event('bagisto.shop.checkout.cart.item.price.after', ['item' => $item]) !!}
                                                        </td>
                                                        @if (isset($item->additional['attributes']))
                                                            <td>
                                                                {!! view_render_event('bagisto.shop.checkout.cart.item.options.before', ['item' => $item]) !!}

                                                                    <div class="item-options">

                                                                        @foreach ($item->additional['attributes'] as $attribute)
                                                                            <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                                        @endforeach

                                                                    </div>
                                                                {!! view_render_event('bagisto.shop.checkout.cart.item.options.after', ['item' => $item]) !!}
                                                            </td>
                                                        @endif
                                                        <td>
                                                            {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.before', ['item' => $item]) !!}
                                                            @if ($item->product->getTypeInstance()->showQuantityBox() === true)
                                                                <quantity-changer
                                                                    :control-name="'qty[{{$item->id}}]'"
                                                                    quantity="{{$item->quantity}}">
                                                                </quantity-changer>
                                                            @endif
                                                            {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.after', ['item' => $item]) !!}
                                                            @if (! cart()->isItemHaveQuantity($item))
                                                                <div class="error-message mt-15">
                                                                    * {{ __('shop::app.checkout.cart.quantity-error') }}
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="price">{{ core()->currency($item->base_price * $item->quantity) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}
                                    <div class="cart-coupon-update-area d-sm-flex justify-content-between align-items-center">
                                        <coupon-component></coupon-component>
                                        <div class="cart-update-buttons mt-15 mt-sm-0">
                                            @if ($cart->hasProductsWithQuantityBox())
                                            <button type="submit" class="btn-update-cart" id="update_cart_button">
                                                {{ __('shop::app.checkout.cart.update-cart') }}
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="cart-calculate-area mt-sm-40 mt-md-60">
                                    {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}
                                        @include('shop::checkout.cart.summary', ['cart' => $cart])
                                    {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}
                                    @if (! cart()->hasError())
                                        @php
                                            $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;
                                        @endphp
                                        <proceed-to-checkout
                                            href="{{ route('shop.checkout.onepage.index') }}"
                                            add-class="btn btn-brand d-block"
                                            text="{{ __('shop::app.checkout.cart.proceed-to-checkout') }}"
                                            is-minimum-order-completed="{{ $cart->checkMinimumOrder() }}"
                                            minimum-order-message="{{ __('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) }}">
                                        </proceed-to-checkout>
                                    @endif
                                </div>
                            </div>
                        </div>
                        

                        {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}
                    </form>
                </div>
            </div>

            @include ('shop::products.view.cross-sells')

        @else

        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-3">
                        <div class="title">
                            {{ __('shop::app.checkout.cart.title') }}
                        </div>

                        <div class="cart-content">
                            <p>
                                {{ __('shop::app.checkout.cart.empty') }}
                            </p>

                            <a style="display: inline-block;" href="{{ route('shop.home.index') }}" class="btn btn-brand btn-lg btn-primary">
                                {{ __('shop::app.checkout.cart.continue-shopping') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </section>

@endsection

@push('scripts')
    @include('shop::checkout.cart.coupon')

    <script type="text/x-template" id="quantity-changer-template">
        <div class="pro-qty">
            <div class="quantity control-group" :class="[errors.has(controlName) ? 'has-error' : '']">
                <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>

                <a href="#" @click.prevent="decreaseQty()" class="dec qty-btn" >-</a>

                <input :name="controlName" class="control" :value="qty" v-validate="'required|numeric|min_value:1'" data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;" readonly>

                <a href="#" @click.prevent="increaseQty()" class="inc qty-btn" >+</a>
            </div>
        </div>
    </script>

    <script>
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
                    if (this.qty > 1)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        function removeLink(message) {
            if (!confirm(message))
            event.preventDefault();
        }

        function updateCartQunatity(operation, index) {
            var quantity = document.getElementById('cart-quantity'+index).value;

            if (operation == 'add') {
                quantity = parseInt(quantity) + 1;
            } else if (operation == 'remove') {
                if (quantity > 1) {
                    quantity = parseInt(quantity) - 1;
                } else {
                    alert('{{ __('shop::app.products.less-quantity') }}');
                }
            }
            document.getElementById('cart-quantity'+index).value = quantity;
            event.preventDefault();
        }
    </script>
@endpush