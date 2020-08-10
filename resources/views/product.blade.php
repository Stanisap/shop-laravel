@extends('layouts.master')

@section('title', 'Продукт')
@section('content')
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>71990 ₽</b></p>
    <img src="{{ Storage::url($product->image) }}" width="200" alt="{{ $product->name }}">
    <p>{{ $product->description }}</p>

    <form action="{{ route('basket-add', $product) }}" method="POST">
        <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

        @csrf
    </form>
@endsection
