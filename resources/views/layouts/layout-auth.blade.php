<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('includes.head')
    <title>@yield('title')</title>
    @include('includes.styles')
    @stack('styles')

</head>

<body class="bg-gradient-primary">

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-md-4">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.scripts')
    @stack('scripts')

</body>

</html>