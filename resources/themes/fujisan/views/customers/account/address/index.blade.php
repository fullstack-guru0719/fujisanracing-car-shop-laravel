@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
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
                            @if ($addresses->isEmpty())
                                <div>{{ __('shop::app.customer.account.address.index.empty') }}</div>
                                <br/>
                                <a href="{{ route('customer.address.create') }}">{{ __('shop::app.customer.account.address.index.add') }}</a>
                            @else
                                <div class="product-config">
                                    <div class="account-head">
                                        <span class="back-icon"><a href="{{ route('customer.profile.index') }}"><i class="icon icon-menu-back"></i></a></span>
                                        <span class="account-heading">{{ __('shop::app.customer.account.address.index.title') }}</span>
                                    
                                        @if (! $addresses->isEmpty())
                                            <span class="account-action">
                                                <a href="{{ route('customer.address.create') }}">{{ __('shop::app.customer.account.address.index.add') }}</a>
                                            </span>
                                        @else
                                            <span></span>
                                        @endif
                                        <div class="horizontal-rule"></div>
                                    </div>
                                    <br>
                                    <div class="shopping-cart-table table-responsive">
                                        <table class="table table-bordered text-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Company Name</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Address 1</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Country Name</th>
                                                    <th>Phone</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
                                                @foreach ($addresses as $address)
                                                    <tr>
                                                        <td>{{ auth()->guard('customer')->user()->name }}</td>
                                                        <td>{{ $address->company_name }}</td>
                                                        <td>{{ $address->first_name }}</td>
                                                        <td>{{ $address->last_name }}</td>
                                                        <td>{{ $address->address1 }},</td>
                                                        <td>{{ $address->city }}</td>
                                                        <td>{{ $address->state }}</td>
                                                        <td>{{ core()->country_name($address->country) }} {{ $address->postcode }}</td>
                                                        <td>
                                                            {{ __('shop::app.customer.account.address.index.contact') }}
                                                            : {{ $address->phone }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('customer.address.edit', $address->id) }}">
                                                                {{ __('shop::app.customer.account.address.index.edit') }}
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('address.delete', $address->id) }}"
                                                                onclick="deleteAddress('{{ __('shop::app.customer.account.address.index.confirm-delete') }}')">
                                                                {{ __('shop::app.customer.account.address.index.delete') }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function deleteAddress(message) {
            if (!confirm(message))
                event.preventDefault();
        }
    </script>
@endpush
