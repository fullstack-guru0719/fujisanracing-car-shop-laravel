<?php $cart = cart()->getCart(); ?>

@if ($cart)
    <?php $items = $cart->items; ?>
    <a href="{{ route('shop.checkout.cart.index') }}" class="btn-mini-cart">
        <i class="ion-bag"></i>
        <span class="cart-total">{{ $cart->items->count() }}</span>
    </a>

    <div class="mini-cart-content">
        <div class="mini-cart-product">
            @foreach ($items as $item)
                <div class="mini-product">
                    <div class="mini-product__thumb">
                        <a href="{{ route('shop.productOrCategory.index', $item->product->url_key) }}">
                            @php
                                $images = $item->product->getTypeInstance()->getBaseImage($item);
                            @endphp
                            <img src="{{ $images['small_image_url'] }}" alt="product" />
                        </a>
                    </div>
                    <div class="mini-product__info">
                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.before', ['item' => $item]) !!}

                        <h2 class="title"><a href="{{ route('shop.productOrCategory.index', $item->product->url_key) }}">{{ $item->name }}</a></h2>
                        
                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.after', ['item' => $item]) !!}

                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.before', ['item' => $item]) !!}

                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.after', ['item' => $item]) !!}


                        <div class="mini-calculation">

                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.before', ['item' => $item]) !!}
                            <p class="price">
                                
                            {{ $item->quantity }}
                                x
                                
                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.after', ['item' => $item]) !!}

                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.before', ['item' => $item]) !!}

                                <span>{{ core()->currency($item->base_total) }}</span>

                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.after', ['item' => $item]) !!}
                            
                            </p>
                            
                            <a href="{{ route('shop.checkout.cart.remove', $item->id) }}" onclick="confirm('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">
                                <button class="remove-pro">
                                    <i class="ion-trash-b"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <hr />

            <div style="display:flex; flex-direction: row; justify-content:space-between">
                <a class="btn btn-bordered" href="{{ route('shop.checkout.cart.index') }}">View Cart</a>

                @php
                    $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;
                @endphp

                <proceed-to-checkout
                    href="{{ route('shop.checkout.onepage.index') }}"
                    add-class="btn btn-brand"
                    text="{{ __('shop::app.minicart.checkout') }}"
                    is-minimum-order-completed="{{ $cart->checkMinimumOrder() }}"
                    minimum-order-message="{{ __('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) }}"
                    >
                </proceed-to-checkout>
            </div>
        </div>
    </div>

@else

    <a href="{{ route('shop.checkout.cart.index') }}" class="btn-mini-cart">
        <i class="ion-bag"></i>
        <span class="cart-total">0</span>
    </a>
@endif