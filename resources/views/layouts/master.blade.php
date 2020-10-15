<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('main.online_shop'): @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">@lang('main.online_shop')</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive('index')><a href="{{ route('index') }}">@lang('main.all_products')</a></li>
                <li @routeactive('categor*')><a href="{{ route('categories') }}">@lang('main.all_categories')</a>
                </li>
                <li @routeactive('basket*')><a href="{{ route('basket') }}">@lang('main.cart')</a></li>
                @admin
                <li><a href="{{ route('reset') }}">@lang('main.rest')</a></li>
                @endadmin
                <li><a href="{{ route('locale', __('main.set_lang')) }}">@lang('main.set_lang')</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{ $currencySymbol }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($currencies as $currency)
                            <li><a href="{{ route('currency', $currency->code) }}">{{ $currency->symbol }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}">@lang('main.sign_in')</a></li>
                    <li><a href="{{ route('register') }}">@lang('main.register')</a></li>
                @endguest
                @auth
                    @admin
                    <li><a href="{{ route('home') }}">@lang('main.admin_panel')</a></li>
                @else
                    <li><a href="{{ route('person.orders.index') }}">@lang('main.orders')</a></li>
                    @endadmin
                    <li><a href="{{ route('get-logout') }}">@lang('main.sign_out')</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @elseif(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        @yield('content')
    </div>
</div>
</div>
<!-- Footer -->
<footer class="page-footer footer-inverse blue pt-4">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-6">
                <!-- Content -->
                <p class="h3 text-danger pl-3">@lang('main.important')</p>

            </div>

            <!-- Grid column -->
            <div class="col-md-3">
                <!-- Links -->
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('category', $category->code) }}">{{ $category->__('name') }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-3">
                <!-- Links -->
                <ul class="list-unstyled">
                    @foreach($bestProducts as $bestProduct)
                    <li>
                        <a href="{{ route('product', [$bestProduct->category->code, $bestProduct->code]) }}">{{ $bestProduct->__('name') }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://github.com/Stanisap"> GitHub/Stanisap</a>
    </div>
</footer>
</body>
</html>

