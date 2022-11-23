@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="page-header-wrap bg-img" style="background: rgba(0,0,0,0.5);">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-header-content">
                        <div class="page-header-content-inner">
                            <h1>Login</h1>

                            {{ Breadcrumbs::render('login') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper sp-y">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-6">
                    <div class="auth-content login-form-style">
                        <div class="sign-up-text col-12">
                            {{ __('shop::app.customer.login-text.no_account') }} - <a href="{{ route('customer.register.index') }}">{{ __('shop::app.customer.login-text.title') }}</a>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.login.before') !!}

                        <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
                            {{ csrf_field() }}
                                <?php // <div class="login-text">{{ __('shop::app.customer.login-form.title') }}</div> ?>

                                {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}
                                <div class="col-12">
                                    <div class="input-item" :class="[errors.has('email') ? 'has-error' : '']">
                                        <label for="email" class="required sr-only">{{ __('shop::app.customer.login-form.email') }}</label>
                                        <input type="text" class="control" placeholder="Email" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;">
                                        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-item" :class="[errors.has('password') ? 'has-error' : '']">
                                        <label for="password" class="required sr-only">{{ __('shop::app.customer.login-form.password') }}</label>
                                        <input type="password" placeholder="Password" v-validate="'required|min:6'" class="control" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.sessions.password') }}&quot;" value=""/>
                                        <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                                    </div>
                                </div>
                                {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                                <div class="col-12">
                                    <div class="forgot-password-link">
                                        <a href="{{ route('customer.forgot-password.create') }}">{{ __('shop::app.customer.login-form.forgot_pass') }}</a>

                                        <div class="mt-10">
                                            @if (Cookie::has('enable-resend'))
                                                @if (Cookie::get('enable-resend') == true)
                                                    <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-item login-btn">
                                        <button type="submit" class="btn btn-brand btn-lg">
                                            {{ __('shop::app.customer.login-form.button_title') }}
                                        </button>
                                    </div>
                                </div>
                        </form>
                            {!! view_render_event('bagisto.shop.customers.login.after') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

