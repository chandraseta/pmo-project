<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Databases | {{ config('app.name', 'PMO') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <header>
        @yield('header')
    </header>
    <section>
        @yield('content')
    </section>
    <footer>
        @yield('footer')
    </footer>
</body>
</html>
