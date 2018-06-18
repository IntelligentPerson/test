<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blog</title>
        @include('layout.assets')
    </head>
    <body>
        @include('layout.header')
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    @include('layout.menu')
                </div>
                <div class="col-md-10">
                    <div class="row">
                        @yield('title')
                    </div>
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
