@extends('layouts.master')

@section('title', __('main.product') . $product->__('name'))
@section('content')
    <h1>{{ $product->__('name') }}</h1>
    <h2>{{ $product->category->__('name') }}</h2>
    <p>@lang('main.property.price'): <b>{{ $product->price }} {{$currencySymbol}}</b></p>
    <img src="{{ Storage::url($product->image) }}" width="200" alt="{{ $product->__('name') }}">
    <p>{{ $product->__('description') }}</p>
    @if($product->isAvailable())
        <form action="{{ route('basket-add', $product) }}" method="POST">
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

            <form action="{{ route('subscription', $product) }}" method="POSt">
                @csrf
                <div class="col-mb-6 form-group">
                    <input type="text" name="email" placeholder="@lang('main.enter_y_email')">
                    <button type="submit" class="btn btn-sm btn-success">@lang('main.subscribe')</button>
                </div>

            </form>
        </div>
    @endif
@endsection
