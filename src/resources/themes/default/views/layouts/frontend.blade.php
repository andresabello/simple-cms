@inject('theme', 'Piboutique\SimpleCMS\Services\ThemeService')
        <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}

    <link rel="stylesheet" type="text/css" href="{{ $theme->findAsset('dist/frontend.css') }}">
    @stack('header-scripts')
    {!! $theme->getOption('Google Analytics Script') !!}
</head>
<body>
@stack('opening-body')
{!! $theme->getOption('Google Analytics HTML') !!}
<div id="app">
    <nav class="navbar navbar-expand-md bg-dark">
        <div class="container">
            <div class="navbar-brand">
                <div class="logo-wrapper">
                    @php
                        $logo  = $theme->getOption('logo');
                    @endphp
                    @if (!$logo)
                        <a href="{{ url(config('app.url')) }}" class="text-white">{{ config('app.name') }}</a>
                    @else
                        <a href="{{ url(config('app.url')) }}" class="text-white">
                            <img src="{{ $logo }}"
                                 alt="{{ config('app.name') }}" width="250">
                        </a>
                    @endif
                </div>
            </div>
            <burger @toggle-menu="toggleMenu"></burger>
            <transition v-on:before-enter="beforeEnter"
                        v-on:enter="enter"
                        v-on:leave="leave"
                        v-on:after-leave="afterLeave"
                        v-bind:css="false"
                        appear
                        v-cloak>
                <ul class="navbar-nav text-xl-right text-left" v-show="menu.active">
                    @foreach($menu as $item)
                        <li class="nav-item {{ isset($item['active']) ? $item['active'] : false }}">
                            <a class="nav-link text-capitalize"
                               href="{{ isset($item['url']) ? url($item['url']) : '/'}}">
                                {{ isset($item['name']) ?  $item['name'] : ''}}
                            </a>
                        </li>
                    @endforeach
                    @if (!empty(config('cms.phone')))
                        <li class="nav-item phone-nav-item">
                            <h3 class="py-0 my-0">
                                <a href="tel:{{config('cms.phone')}}"
                                   class="nav-link py-0">{{ config('cms.phone') }}</a>
                            </h3>
                        </li>
                    @endif
                </ul>
            </transition>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <footer class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        &copy; Copyright {{ date('Y') }}
                        <a href="{{ url(config('app.url')) }}" class="text-white">
                            {{ config('app.name') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="overlay" v-if="overlay.active" v-cloak></div>
</div>
<script src="{{ $theme->findAsset('dist/vendors.js') }}"></script>
<script src="{{ $theme->findAsset('dist/runtime.js') }}"></script>
<script src="{{ $theme->findAsset('dist/frontend.js') }}"></script>
{!! $theme->getOption('Footer Scripts') !!}
@stack('footer-scripts')
</body>
</html>