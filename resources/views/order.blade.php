@extends('layouts.master')

@section('title', __('order.checkout'))

@section('content')
    <h1>@lang('order.confirm'):</h1>
    <div class="container">
        <div class="row justify-content-center">
            <p>@lang('order.total') <b>{{ $order->getFullSum() }} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</b></p>
            <form action="{{ route('order-confirm') }}" method="POST">
                <div>
                    <p>@lang('order.manager_can_contact')</p>

                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">@lang('order.name')</label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">@lang('order.phone') </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        @guest
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">Email: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        @endguest
                    </div>
                    <br>
                    @csrf
                    <input type="submit" class="btn btn-success" value="{{ __('order.confirm') }}">
                </div>
            </form>
        </div>
    </div>
@endsection
