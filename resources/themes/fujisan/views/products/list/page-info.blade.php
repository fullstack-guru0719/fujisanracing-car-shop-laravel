<div class="action-bar-inner mt-30">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <nav class="pagination-wrap mb-10 mb-sm-0">
                <ul class="pagination">
                    <?php // {{ $products->appends(request()->input())->links() }} ?>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="ion-ios-arrow-thin-right"></i></a></li>
                </ul>
            </nav>
        </div>

        <div class="col-sm-6 text-center text-sm-right">
            <p>{{ __('shop::app.products.pager-info', ['showing' => $products->firstItem() . '-' . $products->lastItem(), 'total' => $products->total()]) }}</p>
        </div>
    </div>
</div>