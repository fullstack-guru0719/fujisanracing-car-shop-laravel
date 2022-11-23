@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

{!! view_render_event('bagisto.shop.products.list.toolbar.before') !!}

<div class="action-bar-inner mb-30">

    <div class="row align-items-center">

        <div class="col-sm-5">
            <div class="shop-layout-switcher mb-15 mb-sm-0">
                <ul class="layout-switcher nav">
                    @if ($toolbarHelper->isModeActive('grid'))
                        <li data-layout="grid" class="active">
                            <i class="fa fa-th"></i>
                        </li>
                    @else
                        <li data-layout="grid">
                            <a href="{{ $toolbarHelper->getModeUrl('grid') }}" class="grid-view" aria-label="Grid">
                                <i class="fa fa-th"></i>
                            </a>
                        </li>
                    @endif

                    @if ($toolbarHelper->isModeActive('list'))
                        <li data-layout="list" class="active">
                            <i class="fa fa-th-list"></i>
                        </li>
                    @else
                        <li data-layout="list">
                            <a href="{{ $toolbarHelper->getModeUrl('list') }}" class="list-view" aria-label="list">
                                <i class="fa fa-th-list"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="col-sm-7 text-right">
            <div class="sort-by-wrapper">
                <label for="show-toolbar">{{ __('shop::app.products.show') }}</label>

                <select onchange="window.location.href = this.value" id="show-toolbar">

                    @foreach ($toolbarHelper->getAvailableLimits() as $limit)

                        <option value="{{ $toolbarHelper->getLimitUrl($limit) }}" {{ $toolbarHelper->isLimitCurrent($limit) ? 'selected' : '' }}>
                            {{ $limit }}
                        </option>

                    @endforeach

                </select>

                <span class="sort">
                    <label for="sort" class="sr-only">{{ __('shop::app.products.sort-by') }}</label>

                    <select onchange="window.location.href = this.value" name="sort" id="sort">

                        @foreach ($toolbarHelper->getAvailableOrders() as $key => $order)

                            <option value="{{ $toolbarHelper->getOrderUrl($key) }}" {{ $toolbarHelper->isOrderCurrent($key) ? 'selected' : '' }}>
                                {{ __('shop::app.products.' . $order) }}
                            </option>

                        @endforeach

                    </select>
                </span>
            </div>
        </div>


    </div>

</div>

{!! view_render_event('bagisto.shop.products.list.toolbar.after') !!}


<div class="responsive-layred-filter mb-20">
    <layered-navigation></layered-navigation>
</div>