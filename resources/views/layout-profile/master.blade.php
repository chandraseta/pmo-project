<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Page</title>

    
    {{-- icon --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous"> --}}


    <link href="/css/fontawesome-all.css" rel="stylesheet">
    <link href="/css/profile.css" rel="stylesheet">

</head>

<body>

    @include('layout-profile.nav')


    <div class="container" id="profile-page">
        @yield('content')
        
    </div>


    @include('layout-profile.footer')
    
</body>
<script src="/js/profile.js"></script>
</html>
