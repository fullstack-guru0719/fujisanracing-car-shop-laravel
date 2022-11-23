{!! view_render_event('bagisto.shop.layout.header.category.before') !!}

<?php

$categories = app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);

?>
<div class="site-navigation">
    <ul class="main-menu nav">
        <li>
            <a href="{{ url()->to('/') }}">Home</a>
        </li>
        @foreach($categories as $category)
            @include('shop::partials.navlink', $category)
        @endforeach
    </ul>
</div>

{!! view_render_event('bagisto.shop.layout.header.category.after') !!}