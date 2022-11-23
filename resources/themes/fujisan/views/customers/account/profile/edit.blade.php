@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.profile.edit-profile.page-title') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('vendor/webkul/ui/assets/css/shop.css') }}">
@endpush

@section('content-wrapper')
<style>
    .edit-form {
        width: 55px;
        max-width: 78px;
    }

    #sidebax {
        margin-bottom: 720px;
    }
</style>
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
                                <form method="post" action="{{ route('customer.profile.store') }}">
                                    <div class="edit-form">
                                        @csrf
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]) !!}
                    
                                        <div class="form-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                                            <label for="first_name" class="required">{{ __('shop::app.customer.account.profile.fname') }}</label>
                    
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') ?? $customer->first_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.fname') }}&quot;">
                                            <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.first_name.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                                            <label for="last_name" class="required">{{ __('shop::app.customer.account.profile.lname') }}</label>
                    
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') ?? $customer->last_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.lname') }}&quot;">
                                            <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.last_name.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('gender') ? 'has-error' : '']">
                                            <label for="email" class="required">{{ __('shop::app.customer.account.profile.gender') }}</label>
                    
                                            <select name="gender" class="form-control" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.gender') }}&quot;">
                                                <option value=""  @if ($customer->gender == "") selected @endif></option>
                                                <option value="Other"  @if ($customer->gender == "Other") selected @endif>{{ __('shop::app.customer.account.profile.other') }}</option>
                                                <option value="Male"  @if ($customer->gender == "Male") selected @endif>{{ __('shop::app.customer.account.profile.male') }}</option>
                                                <option value="Female" @if ($customer->gender == "Female") selected @endif>{{ __('shop::app.customer.account.profile.female') }}</option>
                                            </select>
                                            <span class="control-error" v-if="errors.has('gender')">@{{ errors.first('gender') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.gender.after') !!}
                    
                                        <div class="form-group"  :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                                            <label for="date_of_birth">{{ __('shop::app.customer.account.profile.dob') }}</label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') ?? $customer->date_of_birth }}" v-validate="" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.dob') }}&quot;">
                                            <span class="control-error" v-if="errors.has('date_of_birth')">@{{ errors.first('date_of_birth') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.date_of_birth.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('email') ? 'has-error' : '']">
                                            <label for="email" class="required">{{ __('shop::app.customer.account.profile.email') }}</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') ?? $customer->email }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.email') }}&quot;">
                                            <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.email.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('phone') ? 'has-error' : '']">
                                            <label for="phone">{{ __('shop::app.customer.account.profile.phone') }}</label>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? $customer->phone }}" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.phone') }}&quot;">
                                            <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.phone.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('oldpassword') ? 'has-error' : '']">
                                            <label for="password">{{ __('shop::app.customer.account.profile.opassword') }}</label>
                                            <input type="password" class="form-control" name="oldpassword" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.opassword') }}&quot;" v-validate="'min:6'">
                                            <span class="control-error" v-if="errors.has('oldpassword')">@{{ errors.first('oldpassword') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.oldpassword.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('password') ? 'has-error' : '']">
                                            <label for="password">{{ __('shop::app.customer.account.profile.password') }}</label>
                    
                                            <input type="password" id="password" class="form-control" name="password" ref="password" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.password') }}&quot;" v-validate="'min:6'">
                                            <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                                        </div>
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit.password.after') !!}
                    
                                        <div class="form-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                            <label for="password">{{ __('shop::app.customer.account.profile.cpassword') }}</label>
                    
                                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.cpassword') }}&quot;" v-validate="'min:6|confirmed:password'">
                                            <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                                        </div>
                    
                                        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                                            <div class="form-group">
                                                <input type="checkbox" id="checkbox2" name="subscribed_to_news_letter"@if (isset($customer->subscription)) value="{{ $customer->subscription->is_subscribed }}" {{ $customer->subscription->is_subscribed ? 'checked' : ''}} @endif>
                                                <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                                            </div>
                                        @endif
                    
                                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.after', ['customer' => $customer]) !!}
                    
                                        <div class="button-group">
                                            <input class="btn btn-primary btn-lg" type="submit" value="{{ __('shop::app.customer.account.profile.submit') }}">
                                        </div>
                                    </div>
                    
                                </form>
                            </div>
                            <div class="account-layout">
                                {!! view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]) !!}
                                <div class="account-table-content" style="width: 50%;">
                                    <button type="submit" data-toggle="modal" data-target="#deleteProfile" class="btn btn-lg btn-primary mt-10">
                                        {{ __('shop::app.customer.account.address.index.delete') }}
                                    </button>
                                    <form method="POST" action="{{ route('customer.profile.destroy') }}" @submit.prevent="onSubmit">
                                        @csrf
                                        <!-- The Modal -->
                                        <div class="modal" id="deleteProfile">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 slot="header">{{ __('shop::app.customer.account.address.index.enter-password') }}</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group" :class="[errors.has('password') ? 'has-error' : '']">
                                                            <label for="password" class="required">{{ __('admin::app.users.users.password') }}</label>
                                                            <input type="password" v-validate="'required|min:6|max:18'" class="form-control" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>
                                                            <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                                                        </div>
                        
                                                        <div class="page-action">
                                                            <button type="submit"  class="btn btn-lg btn-primary mt-10">
                                                            {{ __('shop::app.customer.account.address.index.delete') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
