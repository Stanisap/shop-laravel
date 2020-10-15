<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($product->isNew())<span class="badge badge-success">Новинка</span>@endif
            @if($product->isHit())<span class="badge badge-warning">Хит продаж</span>@endif
            @if($product->isRecommend())<span class="badge badge-danger">Рекомендуемые</span>@endif
        </div>

        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->__('name') }}" >
        <div class="caption">
            <h3>{{ $product->__('name') }}</h3>
            <p>{{ $product->price . ' ' . $currencySymbol }} </p>
            <p>
                {{ isset($category) ? $category->__('name') : $product->category->__('name') }}
                <form action="{{ route('basket-add', $product) }}" method="POST">
                    @if($product->isAvailable())
                    <button type="submit" class="btn btn-primary" role="button">@lang('main.to_cart')</button>
                    @else
                        @lang('main.product_not_available')
                    @endif
                    <a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code]) }}"
                       class="btn btn-default"
                       role="button">@lang('main.see_more')</a>
                    @csrf
                </form>
            </p>
        </div>
    </div>
</div>

