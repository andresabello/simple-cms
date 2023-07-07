@inject('theme', 'Piboutique\SimpleCMS\Services\ThemeService')
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') &mdash; SimpleCMS by Piboutique</title>
    <link rel="stylesheet" type="text/css" href="{{ $theme->findBackendAsset('dist/backend.css') }}">
</head>
<body>
<div id="app" class="flex-column min-vh-100 d-flex">
    <nav class="navbar navbar-expand-md bg-dark">
        <div class="container">
            <div class="navbar-brand">
                <div class="logo-wrapper">
                    <a href="{{ route('dashboard') }}" class="text-white">SimpleCMS</a>
                </div>
            </div>
            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav ml-auto text-right">
                    @foreach($menu->toArray()['admin'] as $item)
                        <li class="nav-item {{ isset($item['active']) ? $item['active'] : false }}">
                            <a class="nav-link text-white text-capitalize"
                               href="{{ isset($item['url']) ? url($item['url']) : '/'}}">
                                {{ isset($item['name']) ?  $item['name'] : ''}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                    @csrf
                    <button class="btn btn-outline-light border-0" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="content flex-grow-1">
        @yield('content')
    </div>

    <footer class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        &copy; Copyright {{ date('Y') }}
                        <a href="http://piboutique.com" class="text-white">
                            Piboutique Coding LLC
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ $theme->findBackendAsset('dist/vendors.js') }}"></script>
<script src="{{ $theme->findBackendAsset('dist/runtime.js') }}"></script>
<script src="{{ $theme->findBackendAsset('dist/backend.js') }}"></script>
@stack('footer-scripts')
</body>
</html>