@extends('layout.master')

@section('title', 'Продукт')
@section('content')
    <div class="starter-template">
        <h1>{{ $product->name }}</h1>
        <h2>{{ $product->category->name }}</h2>
        <p>Цена: <b>71990 ₽</b></p>
        <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
        <p>{{ $product->description }}</p>

        <form action="{{ route('basket-add', $product) }}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

            @csrf
        </form>
    </div>
@endsection
