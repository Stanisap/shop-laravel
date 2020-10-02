@extends('layouts.master')

@section('title', 'Продукт')
@section('content')
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>{{ $product->price }}</b></p>
    <img src="{{ Storage::url($product->image) }}" width="200" alt="{{ $product->name }}">
    <p>{{ $product->description }}</p>
    @if($product->isAvailable())
        <form action="{{ route('basket-add', $product) }}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
            @csrf
        </form>
    @else
        <span class="mb-3"><p class="h3 text-danger">Товар не доступен</p></span>
        <div class="row justify-content-center">
            <p>Сообщить мне, когда товар будет в наличии</p>
            @if($errors->get('email'))
                <div class="alert alert-danger">
                    {!! $errors->get('email')[0] !!}
                </div>
            @endif

            <form action="{{ route('subscription', $product) }}" method="POSt">
                @csrf
                <div class="col-mb-6 form-group">
                    <input type="text" name="email" placeholder="Enter your email">
                    <button type="submit" class="btn btn-sm btn-success">Подписаться</button>
                </div>

            </form>
        </div>
    @endif
@endsection
