@extends('auth.layouts.master')

@section('title', 'Товарное предложение для ' . $product->name)

@section('content')
    <div class="col-md-12">
        <h1>Товарное предложение для {{ $product->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $sku->id }}</td>
            </tr>
            <tr>
                <td>Товар</td>
                <td>{{ $sku->product->name }}</td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $sku->price }}</td>
            </tr>
            <tr>
                <td>Количество</td>
                <td>{{ $sku->count }}</td>
            </tr>
            @isset($sku->product->properties)
                @foreach($sku->propertyOptions as $propertyOption)

                    <tr>
                        <td>{{ $propertyOption->property->name }}</td>
                        <td>{{ $propertyOption->name }}</td>
                    </tr>

                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
@endsection
