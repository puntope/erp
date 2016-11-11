<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erp rIL</title>

{!! Html::style('assets/css/bootstrap.css') !!}
{!! Html::style('assets/css/styles.css') !!}

        <!-- Fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
    body {
        background: #1d1d1d !important;
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

    @yield('content')

            <!-- Scripts -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    {!! Html::script('assets/js/vendor.js') !!}
</body>
</html>
