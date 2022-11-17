<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
      {{-- Navigation --}}
      @include('partials._nav')

      {{-- Hero --}}
      @include('partials._hero')

      {{-- Search --}}
      @include('partials._search')

      {{-- View content --}}
      {{-- @yield('content') --}}
      {{ $slot }}

      {{-- Footer --}}
      @include('partials._footer')

      <x-flash-message />

      <script src="//unpkg.com/alpinejs" defer></script>
    </body>
</html>