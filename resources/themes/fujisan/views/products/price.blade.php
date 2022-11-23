{!! view_render_event('bagisto.shop.products.price.before', ['product' => $product]) !!}

<span class="price">
    @php
        $type = $product->getTypeInstance();
    @endphp

    @if ($type->haveSpecialPrice())
        <span class="regular-price">{{ core()->currency($product->price) }}</span>
        <span class="special-price">{{ core()->currency($type->getSpecialPrice()) }}</span>
    @else
        <span class="only-price">{{ core()->currency($product->price) }}</span>
    @endif
</span>

{!! view_render_event('bagisto.shop.products.price.after', ['product' => $product]) !!}