@extends('shop::layouts.master')
@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection
@section('content-wrapper')
    <div class="page-header-wrap bg-img" style="background: rgba(0,0,0,0.5);">
        <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="page-header-content">
                            <div class="page-header-content-inner">
                                <h1>Signup</h1>

                                {{ Breadcrumbs::render('signup') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper sp-y">
            <div class="login-page-content-wrap">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6">
                            <div class="login-form-style">
                                    <div class="sign-up-text col-12">
                                        {{ __('shop::app.customer.signup-text.account_exists') }} - <a href="{{ route('customer.session.index') }}">{{ __('shop::app.customer.signup-text.title') }}</a>
                                    </div>

                                    {!! view_render_event('bagisto.shop.customers.signup.before') !!}

                                    <form method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit">

                                        {{ csrf_field() }}

                                        <div class="login-form">
                                            <?php //<div class="login-text">{{ __('shop::app.customer.signup-form.title') }}</div> ?>

                                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                                            <div class="col-12">
                                                <div class="input-item" :class="[errors.has('first_name') ? 'has-error' : '']">
                                                    <label for="first_name" class="required sr-only">{{ __('shop::app.customer.signup-form.firstname') }}</label>
                                                    <input type="text" class="control" placeholder="First Name" name="first_name" v-validate="'required'" value="{{ old('first_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;">
                                                    <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                                                </div>
                                            </div>
                                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.firstname.after') !!}

                                            <div class="col-12">
                                                <div class="input-item" :class="[errors.has('last_name') ? 'has-error' : '']">
                                                    <label for="last_name" class="required sr-only">{{ __('shop::app.customer.signup-form.lastname') }}</label>
                                                    <input type="text" class="control" placeholder="Last Name" name="last_name" v-validate="'required'" value="{{ old('last_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;">
                                                    <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                                                </div>
                                            </div>
                                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.lastname.after') !!}

                                            <div class="col-12">
                                                <div class="input-item" :class="[errors.has('email') ? 'has-error' : '']">
                                                    <label for="email" class="required sr-only">{{ __('shop::app.customer.signup-form.email') }}</label>
                                                    <input type="email" class="control" placeholder="Email" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                                                    <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                                                </div>
                                            </div>
                                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.email.after') !!}

                                            <div class="col-12">
                                                <div class="input-item" :class="[errors.has('password') ? 'has-error' : '']">
                                                    <label for="password" class="required sr-only">{{ __('shop::app.customer.signup-form.password') }}</label>
                                                    <input type="password" class="control" placeholder="Password" name="password" v-validate="'required|min:6'" ref="password" value="{{ old('password') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;">
                                                    <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                                                </div>
                                            </div>
                                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.password.after') !!}

                                            <div class="col-12">
                                                <div class="input-item" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                                    <label for="password_confirmation" class="required sr-only">{{ __('shop::app.customer.signup-form.confirm_pass') }}</label>
                                                    <input type="password" class="control" placeholder="Password Confirm " name="password_confirmation"  v-validate="'required|min:6|confirmed:password'" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;">
                                                    <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                                                </div>
                                            </div>
                                            {{-- <div class="signup-confirm" :class="[errors.has('agreement') ? 'has-error' : '']">
                                                <span class="checkbox">
                                                    <input type="checkbox" id="checkbox2" name="agreement" v-validate="'required'">
                                                    <label class="checkbox-view" for="checkbox2"></label>
                                                    <span>{{ __('shop::app.customer.signup-form.agree') }}
                                                        <a href="">{{ __('shop::app.customer.signup-form.terms') }}</a> & <a href="">{{ __('shop::app.customer.signup-form.conditions') }}</a> {{ __('shop::app.customer.signup-form.using') }}.
                                                    </span>
                                                </span>
                                                <span class="control-error" v-if="errors.has('agreement')">@{{ errors.first('agreement') }}</span>
                                            </div> --}}

                                            {{-- <span class="checkbox">
                                                <input type="checkbox" id="checkbox1" name="checkbox[]">
                                                <label class="checkbox-view" for="checkbox1"></label>
                                                Checkbox Value 1
                                            </span> --}}

                                            @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                                                <div class="col-12">
                                                    <div class="input-item">
                                                        <input type="checkbox" id="checkbox2" name="is_subscribed">
                                                        <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

                                            <div class="col-12">
                                                <div class="input-item login-btn">
                                                    <button class="btn btn-brand btn-lg" type="submit">
                                                        {{ __('shop::app.customer.signup-form.button_title') }}
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    {!! view_render_event('bagisto.shop.customers.signup.after') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
