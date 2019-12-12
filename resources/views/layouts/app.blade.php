<!DOCTYPE html>
<html>
<head>
    <title>@section('title')Web Notes @show</title>
    <meta name="viewport" content="width=device-width;intial-scale=1.0" />
    <link rel="stylesheet" href="{{ url('bootstrap-4.3.1-dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('css/animate.min.css') }}" />
</head>
<body>
    
    <div class="container my-5">
        <div class="row">

            {{-- Page header --}}
            <header class="col-sm-12">
                <h1 class="text-center"><a href="{{ route('notes.index') }}" class="text text-warning">Web Notes</a></h1>
            </header>

            {{-- Page content --}}
            <section class="col-sm-8 offset-sm-2 my-5">

                {{-- Main page content --}}
                @yield('content')

            </section>

            {{-- Page footer --}}
            <footer class="col-sm-12 box no-shadow text-center">
                <p class="text-small">&copy; Iyiola_am, 2019</p>
            </footer>

        </div>
    </div>

    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('bootstrap-4.3.1-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ url('js/iyiola-forms.js') }}"></script>
    <script src="{{ url('js/scripts.js') }}"></script>
</body>
</html>