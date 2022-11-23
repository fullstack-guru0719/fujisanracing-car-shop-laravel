<h5 class="cal-title">Cart Totals</h5>
<div class="cart-ca-table table-responsive">
    <table class="table table-borderless">
        <tbody>
            <tr class="cart-sub-total">
                <th>Subtotal</th>
                <td>{{ core()->currency($cart->base_sub_total) }}</td>
            </tr>
            @if ($cart->selected_shipping_rate)
            <tr class="shipping">
                <th>Shipping</th>
                <td>
                    <ul class="shipping-method">
                        <li>
                            <div class="">
                                <input type="radio" id="flat_shipping" name="shipping_method" class="custom-control-input" checked="checked">
                                <label class="custom-control-label" for="flat_shipping">
                                    {{ __('shop::app.checkout.total.delivery-charges') }} : {{ core()->currency($cart->selected_shipping_rate->base_price) }}
                                </label>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            @endif
            @if ($cart->base_tax_total)
            <tr class="tax">
                <th>Tax</th>
                @foreach (Webkul\Tax\Helpers\Tax::getTaxRatesWithAmount($cart, true) as $taxRate => $baseTaxAmount )
                <td>
                    <label class="right" id="basetaxamount-{{ core()->taxRateAsIdentifier($taxRate) }}">{{ core()->currency($baseTaxAmount) }}</label>
                    <label id="taxrate-{{ core()->taxRateAsIdentifier($taxRate) }}">@ {{ $taxRate }}% {{ __('shop::app.checkout.total.tax') }}</label>
                </td>
                @endforeach
            </tr>
            @endif
            <tr class="order-total">
                <th>{{ __('shop::app.checkout.total.grand-total') }}</th>
                <td>
                    <b>{{ core()->currency($cart->base_grand_total) }}</b>
                </td>
                @if ($cart->base_discount_amount && $cart->base_discount_amount > 0)
                    <td>
                        {{ __('shop::app.checkout.total.disc-amount') }}
                        -{{ core()->currency($cart->base_discount_amount) }}
                    </td>
                @endif
            </tr>
            </tbody>
    </table>


</div>