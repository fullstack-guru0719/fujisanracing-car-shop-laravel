@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
    <link rel="stylesheet" href="{{ bagisto_asset('vendor/webkul/ui/assets/css/shop.css') }}">
@endpush

@section('content-wrapper')
    <!-- BEGIN: Top Menu -->
    <!-- END: Top Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
      <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"> Profile</h2>
      </div>
      <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div
          class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse"
        >
          <div class="intro-y box mt-5">
                @include('shop::customers.account.partials.sidemenu')
          </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
              <div
                class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400"
              >
                <h2 class="font-medium text-base mr-auto">{{ __('shop::app.customer.account.profile.index.title') }}</h2>
                <span class="account-action">
                    <a href="{{ route('customer.profile.edit') }}" class="text-primary">{{ __('shop::app.customer.account.profile.index.edit') }}</a>
                </span>
              </div>
              <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row flex-col">
                  <div class="flex-1 mt-6 xl:mt-0">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 2xl:col-span-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="update-profile-form-1" class="form-label"
                                  >{{ __('shop::app.customer.account.profile.fname') }}</label
                                >
                                <input
                                  id="update-profile-form-1"
                                  type="text"
                                  class="form-control"
                                  placeholder="Input text"
                                  value="{{ $customer->first_name }}"
                                  disabled
                                />
                            </div>
                            <div class="col-md-6">
                                  <label for="update-profile-form-1" class="form-label"
                                    >{{ __('shop::app.customer.account.profile.lname') }}</label
                                  >
                                  <input
                                    id="update-profile-form-1"
                                    type="text"
                                    class="form-control"
                                    placeholder="Input text"
                                    value="{{ $customer->last_name }}"
                                    disabled
                                  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="update-profile-form-1" class="form-label"
                                  >{{ __('shop::app.customer.account.profile.gender') }}</label
                                >
                                <input
                                  id="update-profile-form-1"
                                  type="text"
                                  class="form-control"
                                  
                                  value="{{ $customer->gender }}"
                                  disabled
                                />
                            </div>
                            <div class="col-md-6">
                                  <label for="update-profile-form-1" class="form-label"
                                    >{{ __('shop::app.customer.account.profile.dob') }}</label
                                  >
                                  <input
                                    id="update-profile-form-1"
                                    type="text"
                                    class="form-control"
                                    
                                    value="{{ $customer->date_of_birth }}"
                                    disabled
                                  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="update-profile-form-1" class="form-label"
                                  >{{ __('shop::app.customer.account.profile.email') }}</label
                                >
                                <input
                                  id="update-profile-form-1"
                                  type="text"
                                  class="form-control"
                                  
                                  value="{{ $customer->email }}"
                                  disabled
                                />
                            </div>
                        </div>
                        
                      </div>
                     
                    </div>
                    <div class="account-layout">
                        {!! view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]) !!}
                        <div class="account-table-content" style="width: 50%;">
                            <button type="submit" data-toggle="modal" data-target="#deleteProfile" class="btn btn-lg btn-danger mt-10">
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
            <!-- END: Display Information -->
          </div>
      </div>
    </div>
 
{{-- <div class="page-content-wrapper sp-y">
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
</div> --}}
@endsection
