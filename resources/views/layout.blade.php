<!DOCTYPE html>

<html>
<head>
        <title>@yield('title', 'Sitio de firmado y validación') </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('css/bootstrap_4.1.1.min.css') }}" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/bootstrap_4.1.1.theme.css') }}" >
        <link rel="stylesheet" href="{{ asset('css/fontawesome_v5.0.13.css') }}" >
        <style>
        footer{
        	margin-top: 20px;
        }
        </style>
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        @yield('extra_head')
</head>

<body class="hold-transition skin-blue sidebar-mini @yield('body_class')">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">DFVA Sistema de firma y validación de documentos en PHP</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
        </nav>

        <div class="container">
                @yield('content')
        </div>
        <footer class="footer">
                <div class="card-footer text-muted text-center">
                         <span > &copy; DFVA 2019</span>
                </div>
        </footer>
        <script src="{{ asset('js/popper_1.14.3.min.js') }}" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bootstrap.4.1.1.min.js') }}" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        @yield('extra_foot')
        @yield('javascript_extra')
        
    </body>
</html>