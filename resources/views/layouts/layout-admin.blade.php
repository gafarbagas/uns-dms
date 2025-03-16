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

<body id="page-top">
    <div id="wrapper">
        {{-- Sidebar --}}
        @include('components.layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {{-- Navbar --}}
                @include('components.layouts.navbar')

                {{-- Content --}}
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            {{-- Footer --}}
            @include('components.layouts.footer')
        </div>
    </div>

    {{-- Scroll to Top Button --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Logout Modal --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan Keluar untuk untuk mengakhiri sesi.</div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.scripts')
    @stack('scripts')
</body>

</html>