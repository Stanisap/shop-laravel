<p>Привет!</p>
<p>{{$product->name}} есть в наличае, спеши заказать</p>
<a href="{{ route('product', [$product->category->code, $product->code]) }}"></a>

