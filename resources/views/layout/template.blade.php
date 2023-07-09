<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kota</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/datatable.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body class="bg-light">
    <main class="container">
      @if (Session::has('success'))
      <div class="pt-3">
        <div class="alert alert-success">
          {{Session::get('success')}}
        </div>
      </div>
      @endif
      @yield('content')
    </main>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
  </body>
</html>