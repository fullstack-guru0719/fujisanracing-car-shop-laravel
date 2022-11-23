@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

@php
    $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;

    $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
@endphp


<button onclick="document.getElementById('add-to-cart-{{$product->product_id}}').submit()" class="btn-add-to-cart" {{ $product->isSaleable() ? '' : 'disabled' }}><i class="ion-bag"></i></button>

@if ($showCompare)
    @include('shop::products.compare', [
        'productId' => $product->id
    ])
@endif

@if ($showWishlist)
    @include('shop::products.wishlist')
@endif

<a class="btn-add-to-cart" href="{{ route('shop.productOrCategory.index', $product->url_key) }}"><i class="ion-eye"></i></a>

<form id="add-to-cart-{{$product->product_id}}" action="{{ route('cart.add', $product->product_id) }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
    <input type="hidden" name="quantity" value="1">
</form>

