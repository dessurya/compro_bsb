<!doctype html>
<html lang="en">
  <head>
    <title>{{ App\Http\Controllers\Main\HomeController::getWebName() }} @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
    <link rel="icon" type="image/png" href="{{ App\Http\Controllers\Main\HomeController::getWebIcon() }}" />
    @include('main._struct.css')
    @stack('link')
  </head>
  <body>
    {{ App\Http\Controllers\Main\HomeController::getHeader() }}
    @yield('content')
    {{ App\Http\Controllers\Main\HomeController::getFooter() }}
    @include('main._struct.js')
    @stack('script')
  </body>
</html>