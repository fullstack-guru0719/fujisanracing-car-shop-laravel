@push('css')
    @if(Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4) == 'customer/account/addresses/create' || Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4) == 'customer/account/addresses/edit')
        <style>
            .sidebar{
                margin-bottom: 770px;
            }

            @media only screen and (max-width: 600px) {
                .sidebar{
                    margin-bottom: 0px;
                }
            }
        </style>
    @elseif(Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3) == 'customer/account/profile' && Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4) != 'customer/account/profile/edit')
        <style>
            .sidebar{
                margin-bottom: 230px;
            }

            @media only screen and (max-width: 600px) {
                .sidebar{
                    margin-bottom: 0px;
                }
            }
        </style>
    @elseif(Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4) == 'customer/account/profile/edit')
        <style>
            .sidebar{
                margin-bottom: 770px;
            }

            @media only screen and (max-width: 600px) {
                .sidebar{
                    margin-bottom: 0px;
                }
            }
        </style>
    @elseif(Request::segment(1).'/'.Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4) == 'customer/account/orders/view')
        <style>
            .sidebar{
                margin-bottom: 870px;
            }

            @media only screen and (max-width: 600px) {
                .sidebar{
                    margin-bottom: 0px;
                }
            }
        </style>
    @endif
@endpush

<div class="sidebar">
    @foreach ($menu->items as $menuItem)
        <div class="menu-block" style="margin-top:20px">
            <a class="flex items-center text-primary font-medium" href="">
                <h2>{{ trans($menuItem['name']) }}</h2>
            </a>
            {{-- <div class="menu-block-title">
                {{ trans($menuItem['name']) }}

                <i class="icon icon-arrow-down right" id="down-icon"></i>
            </div> --}}

            <div class="menu-block-content">
                <ul class="menubar">
                    @php
                        $showCompare = core()->getConfigData('general.content.shop.compare_option') == "1" ? true : false;

                        $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                    @endphp

                    @if (! $showCompare)
                        @php
                            unset($menuItem['children']['compare']);
                        @endphp
                    @endif

                    @if (! $showWishlist)
                        @php
                            unset($menuItem['children']['wishlist']);
                        @endphp
                    @endif

                    @foreach ($menuItem['children'] as $subMenuItem)
                        <li class="menu-item {{ $menu->getActive($subMenuItem) }}" style="margin-top:20px">
                            <a class="text-primary" href="{{ $subMenuItem['url'] }}">
                                <h3 class="text-primary">{{ trans($subMenuItem['name']) }}</h3>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(".icon.icon-arrow-down.right").on('click', function(e){
            var currentElement = $(e.currentTarget);
            if (currentElement.hasClass('icon-arrow-down')) {
                $(this).parents('.menu-block').find('.menubar').show();
                currentElement.removeClass('icon-arrow-down');
                currentElement.addClass('icon-arrow-up');
            } else {
                $(this).parents('.menu-block').find('.menubar').hide();
                currentElement.removeClass('icon-arrow-up');
                currentElement.addClass('icon-arrow-down');
            }
        });
    });
</script>
@endpush