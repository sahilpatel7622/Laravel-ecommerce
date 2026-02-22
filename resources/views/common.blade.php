<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce Project')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="data:image/webp;base64,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">
</head>
<body class="d-flex flex-column min-vh-100 {{ $bodyClass ?? '' }}">
    {{ View::make('header') }}
    <main class="flex-grow-1">
        @yield('content')
    </main>
    @if (!View::hasSection('hide_footer'))
        {{ View::make('footer') }}
    @endif
</body>
</html>