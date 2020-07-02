<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
        </div>
        <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg" alt="iPhone X 64GB">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }}</p>
            <p>
            {{ $product->category->name }}
            <form action="{{ route('basket') }}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}"
                   class="btn btn-default"
                   role="button">Подробнее</a>
{{--                <a href="/mobiles/iphone_x_64"--}}
{{--                   class="btn btn-default"--}}
{{--                   role="button">Подробнее</a>--}}
                <input type="hidden" name="_token" value="vP5klWuAvq25PY3PwasN8XCqUvd1aNErQEocGRDB">
            </form>
            </p>
        </div>
    </div>
</div>

