@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

<?php
    $images = productimage()->getGalleryImages($product);

    $videos = productvideo()->getVideos($product);

    $images = array_merge($images, $videos);
?>


{!! view_render_event('bagisto.shop.products.view.gallery.before', ['product' => $product]) !!}
<div class="col-md-5">
    <div class="product-thumb-area">
        <div class="product-details-thumbnail">
            <div class="product-thumbnail-slider" id="thumb-gallery">
                @foreach($images as $image)
                    <figure class="pro-thumb-item" data-mfp-src="{{ $image['large_image_url'] }}">
                        <img src="{{ $image['large_image_url'] }}" alt="Product Details" />
                    </figure>
                @endforeach
            </div>

            <a href="#thumb-gallery" class="btn-large-view btn-gallery-popup">View Larger <i
                class="fa fa-search-plus"></i></a>
        </div>

        <div class="product-details-thumbnail-nav">
            @foreach($images as $image)
                <figure class="pro-thumb-item" data-mfp-src="{{ $image['medium_image_url'] }}">
                    <img src="{{ $image['medium_image_url'] }}" alt="Product Details" />
                </figure>
            @endforeach
        </div>
    </div>
</div>

{!! view_render_event('bagisto.shop.products.view.gallery.after', ['product' => $product]) !!}
