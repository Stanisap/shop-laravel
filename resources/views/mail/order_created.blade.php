<p>Привет {{ $name }}</p>
<p>Ваш заказ на сумму {{ $fullSum }} принят</p>
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
                    {{ $product->name }}
                </a>
            </td>
            <td><span class="badge">{{ $product->pivot->count }}</span>

            </td>
            <td>{{ $product->price }} руб.</td>
            <td>{{ $product->getPriceForCount() }} руб.</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">Общая стоимость:</td>
        <td>{{ $order->calculateFullSum() }} руб.</td>
    </tr>
    </tbody>
</table>
