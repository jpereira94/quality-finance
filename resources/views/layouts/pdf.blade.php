<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exportar relatorio</title>

    <!-- Styles -->
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        table, tr, td, th, tbody, thead, tfoot {
            page-break-inside: avoid !important;
        }
        table {
            table-layout:fixed;
        }
        html {
            font-size: 10px;
        }
    </style>

</head>
<body>

@yield('content')




</body>
</html>
