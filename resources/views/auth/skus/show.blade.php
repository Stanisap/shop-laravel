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
            @foreach($product->properties as $property)
                @foreach($property->propertyOptions as $propertyOption)
                    @if($sku->propertyOptions->contains($propertyOption->id))
                        <tr>
                            <td>{{ $property->name }}</td>
                            <td>{{ $propertyOption->name }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
