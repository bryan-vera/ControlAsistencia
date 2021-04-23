<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    </link>
    <style>
        .page {
            background-color: #fff;
            margin: 0 auto;
            padding: 2em 3em;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 2px 10px rgb(0 0 0 / 20%);
        }

        ;

        input {
            padding: 8px 10px;
            font-size: 16px;
            border: solid 1px #ddd;
            color: #444;
        }
    </style>
</head>

<body class="antialiased" style="padding: 1em;">
    <div id="app" class="page">
        <div class="col-md-12">
            <h1 style="text-align: center;">Prueba desarrollador</h1>
        </div>
        <example-component></example-component>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://unpkg.com/vue-swal"></script>
</body>

</html>