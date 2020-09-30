@extends('auth.layouts.master')

@section('title', 'Продукты')

@section('content')
    <div class="col-md-12">
        <h1>Продукты</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                <th>
                    Кол.
                </th>
                <th>
                    Товар
                </th>
                <th style="text-align: center">
                    Действия
                </th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->count }}</td>
                    <td>
                        @isset($product->image)
                            <img src="{{ Storage::url($product->image) }}" width="50">
                        @endisset
                    </td>
                    <td style="text-align: center">
                        <div class="btn-group" role="group">
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('products.show', $product) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('products.edit', $product) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
        <a class="btn btn-success" type="button"
           href="{{ route('products.create') }}">Добавить продукт</a>
    </div>
@endsection
