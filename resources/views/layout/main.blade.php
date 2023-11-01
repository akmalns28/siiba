<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <!-- css  -->
    @stack('css')
    @include('partials.css')

    <title>{{$tittle}}</title>
</head>
<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('partials.navbar')
        @include('partials.sidebar')
        <div class="main-content">
            <section class="section">
                @include('partials.header')           
                    @yield('container')
            </section>
        </div>
        @include('partials.footer')
    </div>
  </div>
    @include('partials.js')
    @stack('js')
</body>
</html>