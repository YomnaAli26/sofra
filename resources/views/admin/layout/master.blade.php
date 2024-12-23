<!DOCTYPE html>
<html lang="{{ session('lang','en') }}" dir="{{ session('lang','en') == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>@yield("title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include("admin.layout.partials.links")

    <!-- Include RTL or LTR CSS based on locale -->
    @if(session('lang','en') == 'ar')
        <link rel="stylesheet" href="{{ asset('admin/css/adminlte.rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('admin/css/adminlte.ltr.css') }}"> <!-- Use LTR CSS if language is English -->
    @endif
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    @include("admin.layout.partials.navbar")
    @include("admin.layout.partials.sidebar")

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">@yield("breadcrumb_header")</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            @section('breadcrumb')
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Home</a></li>
                            @show
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @yield("content")
    </main>

    @include("admin.layout.partials.footer")
</div>

@include("admin.layout.partials.scripts")
</body>
</html>
