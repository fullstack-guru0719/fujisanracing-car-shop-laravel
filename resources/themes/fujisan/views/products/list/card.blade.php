{!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}

<div class="product-item">

    <?php
        $images = productimage()->getGalleryImages($product);
    ?>

    <div class="product-item__thumb">
        <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
            @if (count($images) > 0)
                @if (count($images) > 1)
                    <img class="thumb-primary" src="{{ $images[0]['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'" alt="Product"/>
                    <img class="thumb-secondary" src="{{ $images[1]['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'" alt="Product"/>
                @else
                    <img class="thumb-primary" src="{{ $images[0]['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'" alt="Product"/>
                    <img class="thumb-secondary" src="{{ $images[0]['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'" alt="Product"/>
                @endif
            @else
                <img class="thumb-primary" src="{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}" alt="Product"/>
                <img class="thumb-secondary" src="{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}" alt="Product"/>
            @endif


        </a>
    </div>

    <div class="product-item__content">

        <div class="product-item__info">
            <h4 class="title">
                <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
                    <span>
                        {{ $product->name }}
                    </span>
                </a>
            </h4>
            @include ('shop::products.price', ['product' => $product])
        </div>


        <div class="product-item__action">
            @include('shop::products.add-buttons', ['product' => $product]) 
        </div>
        <div class="product-item__desc">
            <p>Pursue pleasure rationally encounter consequences that are extremely painful.
                Nor
                again is there anyone who loves or pursues or desires to obtain pain of
                itself,
                because it is pain, but because occasionally circles</p>
        </div>
    </div>
    
    @if ($product->new)
        <div class="product-item__new">
            <span>{{ __('shop::app.products.new') }}</span>
        </div>
    @endif

</div>

{!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}