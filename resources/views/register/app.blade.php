<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Kids Meal Registration Form">
        <meta name="keywords" content="kid,kids,kid meal,meal,food,kid food">

        <link rel="shortcut icon" href="/img/common/favicon.ico"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <link rel="stylesheet" href="{{asset('css/register.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Jquery UI -->
        
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        @stack('custom_link')
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>

    <body>
    <header>
        <nav class="navbar navbar-expand-lg pb-3">
            <a class="navbar-brand" href="#">
            <img class="img-fluid" src="/img/logo_pro.png" alt="Kid Meal Pro">
            </a>
        </nav>
    </header>
    <div class="container">
        @yield('content')
    </div>
    <!-- LIST SECTIN END -->

    <!-- FOOTER START -->
    <footer class="mt-5">
        <p class="text-center py-4 mb-0">
            Copyright &copy;{{ date('Y') }} Meal Care Co., LTD. All Rights Reserved.
        </p>
    </footer>
    <!-- FOOTER END -->

    

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

        @stack('custom_js')
    </body>
</html>
