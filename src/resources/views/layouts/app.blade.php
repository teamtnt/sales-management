<!DOCTYPE html>
<html lang="{{ app()-> currentLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="TNT Studio">

    <title>@yield('title') | Sales Management</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS styles -->
    {{
        Illuminate\Support\Facades\Vite::useHotFile(public_path('sales-management/hot'))
        ->useBuildDirectory('sales-management')
        ->withEntryPoints(['src/resources/scss/light.scss'])

    }}

    <style>
        .btn.loading {
            position: relative;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .btn.loading::before {
            position: relative;
            content: "";
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 2px solid white;
            border-right-color: transparent;
            margin-right: 10px;
            animation: loading-animation 1s ease infinite;
        }

        @keyframes loading-animation {
            from {
                transform: rotate(0);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .required:after {
            content: " *";
            color: red;
        }

    </style>

    @stack('styles')
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">

<div class="wrapper" id="app">

    @include('sales-management::layouts.partials.left-navigation')

    <div class="main">
        @include('sales-management::layouts.partials.header-navigation')

        <main class="content @yield('add-css-class')">
            @hasSection('breadcrumb')
                <div class="container-fluid p-0">
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                        @yield('title_extra')
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        @include('sales-management::layouts.partials.footer')
    </div>
</div>

<!-- Scripts -->
{{
        Illuminate\Support\Facades\Vite::useHotFile(public_path('sales-management/hot'))
        ->useBuildDirectory('sales-management')
        ->withEntryPoints(['src/resources/js/app.js'])

}}

@stack('scripts')
<x-sales-management::notification/>
</body>
</html>
