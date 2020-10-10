<p>Привет {{ $name }}</p>
<p>Ваш заказ на сумму {{ $fullSum }} {{App\Services\CurrencyConversion::getCurrencySymbol()}} принят</p>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Название</th>
        <th>Кол-во</th>
        <th>Цена</th>
        <th>Стоимость</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                    <img height="56px" src="{{ Storage::url($product->image) }}">
                    {{ $product->__('name') }}
                </a>
            </td>
            <td><span class="badge">{{ $product->countInOrder }}</span>

            </td>
            <td>{{ $product->price }} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</td>
            <td>{{ $product->price * $product->countInOrder }} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
