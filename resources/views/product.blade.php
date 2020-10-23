@extends('layouts.master')

@section('title', __('main.product') . $sku->product->__('name'))
@section('content')
    <h1>{{ $sku->product->__('name') }}</h1>
    <h2>{{ $sku->product->category->__('name') }}</h2>
    <p>@lang('main.property.price'): <b>{{ $sku->price }} {{$currencySymbol}}</b></p>
    @isset($sku->product->properties)
        @foreach($sku->propertyOptions as $propertyOption)
            <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
        @endforeach
    @endisset
    <img src="{{ Storage::url($sku->product->image) }}" width="200" alt="{{ $sku->product->__('name') }}">
    <p>{{ $sku->product->__('description') }}</p>
    @if($sku->isAvailable())
        <form action="{{ route('basket-add', $sku) }}" method="POST">
            <button type="submit" class="btn btn-success" role="button">@lang('main.add_to_cart')</button>
            @csrf
        </form>
    @else
        <span class="mb-3"><p class="h3 text-danger">@lang('main.product_not_available')</p></span>
        <div class="row justify-content-center">
            <p>@lang('main.tell_me_in_stock')</p>
            @if($errors->get('email'))
                <div class="alert alert-danger">
                    {!! $errors->get('email')[0] !!}
                </div>
            @endif

            <form action="{{ route('subscription', $sku) }}" method="POSt">
                @csrf
                <div class="col-mb-6 form-group">
                    <input type="text" name="email" placeholder="@lang('main.enter_y_email')">
                    <button type="submit" class="btn btn-sm btn-success">@lang('main.subscribe')</button>
                </div>

            </form>
        </div>
    @endif
@endsection
