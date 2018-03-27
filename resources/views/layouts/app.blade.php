<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Databases | {{ config('app.name', 'PMO') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Style -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Icons -->
    <link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">


</head>
<body>
    @yield('content');
</body>

<script src="/js/app.js"></script>
</html>
