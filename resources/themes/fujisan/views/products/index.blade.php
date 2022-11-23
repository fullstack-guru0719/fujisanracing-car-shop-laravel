@extends('shop::layouts.master')

@section('page_title')
    {{ trim($category->meta_title) != "" ? $category->meta_title : $category->name }}
@stop

@section('seo')
    <meta name="description" content="{{ trim($category->meta_description) != "" ? $category->meta_description : \Illuminate\Support\Str::limit(strip_tags($category->description), 120, '') }}"/>

    <meta name="keywords" content="{{ $category->meta_keywords }}"/>

    @if (core()->getConfigData('catalog.rich_snippets.categories.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getCategoryJsonLd($category) !!}
        </script>
    @endif
@stop

@section('content-wrapper')
    @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

    <div class="page-header-wrap bg-img" style="
            @if($category->image_url != '')
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), {{ "url(" . $category->image_url . ")" }};
            @else
                background: rgba(0,0,0,0.5);
            @endif
            ">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-header-content">
                        <div class="page-header-content-inner">
                            <h1>{{ $category->name }}</h1>

                            {{ Breadcrumbs::render('category', $category) }}
                            <!-- <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="current"><a href="#">Shop</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper sp-y">
        {!! view_render_event('bagisto.shop.products.index.before', ['category' => $category]) !!}

        <div class="container container-wide">
            <div class="category-block" @if ($category->display_mode == 'description_only') style="width: 100%" @endif>

                @if (in_array($category->display_mode, [null, 'description_only', 'products_and_description']))
                    @if ($category->description)
                        <div class="category-description">
                            {!! DbView::make($category)->field('description')->with(['category' => $category])->render() !!}
                        </div>
                    @endif
                @endif

                @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))                
                    <div class="row">
                        
                        <div class="col-lg-3 order-1 order-lg-0">
                            @include ('shop::products.list.layered-navigation')
                        </div>

                        <div class="col-lg-9 order-0 order-lg-1">
                            <?php $products = $productRepository->getAll($category->id); ?>

                            @include ('shop::products.list.toolbar')

                            @if ($products->count())

                                @inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')
                                <div class="product-wrapper product-layout layout-{{ $toolbarHelper->getCurrentMode() }}">
                                    <div class="row mtn-30">
                                        @foreach ($products as $productFlat)
                                            <div class="col-sm-6 col-lg-4">
                                                @include ('shop::products.list.card', ['product' => $productFlat])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {!! view_render_event('bagisto.shop.products.index.pagination.before', ['category' => $category]) !!}
                               
                                @include ('shop::products.list.page-info')

                                {!! view_render_event('bagisto.shop.products.index.pagination.after', ['category' => $category]) !!}
                            </div>
                        </div>
                    @else

                        <div class="product-list empty">
                            <h2>{{ __('shop::app.products.whoops') }}</h2>

                            <p>
                                {{ __('shop::app.products.empty') }}
                            </p>
                        </div>

                    @endif
                @endif
            </div>
        </div>

        {!! view_render_event('bagisto.shop.products.index.after', ['category' => $category]) !!}
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.responsive-layred-filter').css('display','none');
            $(".sort-icon, .filter-icon").on('click', function(e){
                var currentElement = $(e.currentTarget);
                if (currentElement.hasClass('sort-icon')) {
                    currentElement.removeClass('sort-icon');
                    currentElement.addClass('icon-menu-close-adj');
                    currentElement.next().removeClass();
                    currentElement.next().addClass('icon filter-icon');
                    $('.responsive-layred-filter').css('display','none');
                    $('.pager').css('display','flex');
                    $('.pager').css('justify-content','space-between');
                } else if (currentElement.hasClass('filter-icon')) {
                    currentElement.removeClass('filter-icon');
                    currentElement.addClass('icon-menu-close-adj');
                    currentElement.prev().removeClass();
                    currentElement.prev().addClass('icon sort-icon');
                    $('.pager').css('display','none');
                    $('.responsive-layred-filter').css('display','block');
                    $('.responsive-layred-filter').css('margin-top','10px');
                } else {
                    currentElement.removeClass('icon-menu-close-adj');
                    $('.responsive-layred-filter').css('display','none');
                    $('.pager').css('display','none');
                    if ($(this).index() == 0) {
                        currentElement.addClass('sort-icon');
                    } else {
                        currentElement.addClass('filter-icon');
                    }
                }
            });
        });
    </script>
@endpush