@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('vendor/webkul/ui/assets/css/shop.css') }}">
@endpush

@section('content-wrapper')
<div class="">
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
                        <div class="account-items-list">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="config-label">{{ __('shop::app.customer.account.profile.index.title') }}</th>
                                        <td class="config-option">
                                            <span class="account-action">
                                                <a href="{{ route('customer.profile.edit') }}" class="text-danger">{{ __('shop::app.customer.account.profile.index.edit') }}</a>
                                            </span>
                                            <div class="horizontal-rule"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="config-label">{{ __('shop::app.customer.account.profile.fname') }}</th>
                                        <td class="config-option">
                                            {{ $customer->first_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="config-label">{{ __('shop::app.customer.account.profile.lname') }}</th>
                                        <td class="config-option">
                                            {{ $customer->last_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="config-label">{{ __('shop::app.customer.account.profile.gender') }}</th>
                                        <td class="config-option">
                                            {{ $customer->gender }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="config-label">{{ __('shop::app.customer.account.profile.dob') }}</th>
                                        <td class="config-option">
                                            {{ $customer->date_of_birth }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="config-label">{{ __('shop::app.customer.account.profile.email') }}</th>
                                        <td class="config-option">
                                            {{ $customer->email }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
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
                                                    <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
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
@endsection
