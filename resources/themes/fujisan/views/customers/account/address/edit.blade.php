@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.address.edit.page-title') }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
<link rel="stylesheet" href="{{ bagisto_asset('vendor/webkul/ui/assets/css/shop.css') }}">
@endpush

@section('content-wrapper')
<div class="page-content-wrapper sp-y">
    <div class="wishlist-page-content-wrap">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="product-config">
                                @include('shop::customers.account.partials.sidemenu')
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="product-config">
        
                                <div class="account-head mb-15">
                                    <span class="back-icon"><a href="{{ route('customer.address.index') }}"><i class="icon icon-menu-back"></i></a></span>
                                    <span class="account-heading">{{ __('shop::app.customer.account.address.edit.title') }}</span>
                                    <span></span>
                                </div>
                    
                                {!! view_render_event('bagisto.shop.customers.account.address.edit.before', ['address' => $address]) !!}
                    
                                <form method="post" action="{{ route('customer.address.update', $address->id) }}">
                    
                                    <div class="account-table-content">
                                        @method('PUT')
                                        @csrf
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.before', ['address' => $address]) !!}
                    
                                        <div class="form-group" :class="[errors.has('company_name') ? 'has-error' : '']">
                                            <label for="company_name">{{ __('shop::app.customer.account.address.edit.company_name') }}</label>
                                            <input type="text" value="{{ old('company_name') ?: $address->company_name }}"  class="form-control" name="company_name" data-vv-as="&quot;{{ __('shop::app.customer.account.address.edit.company_name') }}&quot;">
                                            <span class="control-error" v-if="errors.has('company_name')">@{{ errors.first('company_name') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.company_name.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                                            <label for="first_name" class="required">{{ __('shop::app.customer.account.address.create.first_name') }}</label>
                                            <input type="text" class="form-control" name="first_name" v-validate="'required'" value="{{ old('first_name') ?: $address->first_name }}" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.first_name') }}&quot;">
                                            <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.first_name.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                                            <label for="last_name" class="required">{{ __('shop::app.customer.account.address.create.last_name') }}</label>
                                            <input type="text" class="form-control" name="last_name" v-validate="'required'" value="{{ old('last_name') ?: $address->last_name }}" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.last_name') }}&quot;">
                                            <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.last_name.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('vat_id') ? 'has-error' : '']">
                                            <label for="vat_id">{{ __('shop::app.customer.account.address.create.vat_id') }}
                                                <span class="help-note">{{ __('shop::app.customer.account.address.create.vat_help_note') }}</span>
                                            </label>
                                            <input type="text" class="form-control" name="vat_id" value="{{ old('vat_id') ?: $address->vat_id }}"
                                            v-validate="''" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.vat_id') }}&quot;">
                                            <span class="control-error" v-if="errors.has('vat_id')">@{{ errors.first('vat_id') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.vat_id.after') !!}
                    
                                        <?php $addresses = explode(PHP_EOL, $address->address1); ?>
                    
                                        <div class="form-group" :class="[errors.has('address1[]') ? 'has-error' : '']">
                                            <label for="address_0" class="required">{{ __('shop::app.customer.account.address.edit.street-address') }}</label>
                                            <input type="text" class="form-control" name="address1[]" id="address_0" v-validate="'required'" value="{{ isset($addresses[0]) ? $addresses[0] : '' }}" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.street-address') }}&quot;">
                                            <span class="control-error" v-if="errors.has('address1[]')">@{{ errors.first('address1[]') }}</span>
                                        </div>
                    
                                        @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                                            <div class="form-group" style="margin-top: -25px;">
                                                @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                                                    <input type="text" class="form-control" name="address1[{{ $i }}]" id="address_{{ $i }}" value="{{ isset($addresses[$i]) ? $addresses[$i] : '' }}">
                                                @endfor
                                            </div>
                                        @endif
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.street-addres.after') !!}
                    
                                        @include ('shop::customers.account.address.country-state', ['countryCode' => old('country') ?? $address->country, 'stateCode' => old('state') ?? $address->state])
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.country-state.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('city') ? 'has-error' : '']">
                                            <label for="city" class="required">{{ __('shop::app.customer.account.address.create.city') }}</label>
                                            <input type="text" class="form-control" name="city" v-validate="'required|regex:^[a-zA-Z \-]*$'" value="{{ old('city') ?: $address->city }}" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.city') }}&quot;">
                                            <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.create.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('postcode') ? 'has-error' : '']">
                                            <label for="postcode" class="required">{{ __('shop::app.customer.account.address.create.postcode') }}</label>
                                            <input type="text" class="form-control" name="postcode" v-validate="'required'" value="{{ old('postcode') ?: $address->postcode }}" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.postcode') }}&quot;">
                                            <span class="control-error" v-if="errors.has('postcode')">@{{ errors.first('postcode') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.postcode.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('phone') ? 'has-error' : '']">
                                            <label for="phone" class="required">{{ __('shop::app.customer.account.address.create.phone') }}</label>
                                            <input type="text" class="form-control" name="phone" v-validate="'required'" value="{{ old('phone') ?: $address->phone }}" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.phone') }}&quot;">
                                            <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.after', ['address' => $address]) !!}
                    
                                        <div class="button-group">
                                            <button class="btn btn-primary btn-lg" type="submit">
                                                {{ __('shop::app.customer.account.address.create.submit') }}
                                            </button>
                                        </div>
                                    </div>
                    
                                </form>
                    
                                {!! view_render_event('bagisto.shop.customers.account.address.edit.after', ['address' => $address]) !!}
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
