<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" id="token" value="{{ csrf_token() }}" />
    <title>Erp rIL - @yield('title')</title>
    <link rel="shortcut icon" href="/favicon.ico" />

    {!! Html::style('assets/css/vendor.css') !!}
    {!! Html::style('assets/css/styles.css') !!}
    @yield('extra-styles')
            <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
        .inactive {
            opacity: 0.5;
        }

    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('layout.menu')
<main id="main_content">
    @yield('content')
</main>

<div class="controls">
    <a class="mbtn yellow" id="sendTarea" href="/api/enviarTareas"><span class="glyphicon-envelope glyphicon white"></span></a>
    @yield('controls')
</div>

@if (session()->has('message'))
    <div class="alerts">
        <div class="alert alert-dismissable alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{session()->pull('message')}}
        </div>
    </div>
@endif
        <!-- Scripts -->
{!! Html::script('assets/js/vendor.js') !!}
@yield('extra-scripts')
{!! Toastr::render() !!}
</body>
</html>