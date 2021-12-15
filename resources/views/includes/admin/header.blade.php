<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="shortcut icon"
        href="{{asset('/assets/ownassets/logo_juarasilat.png')}}"
        type="image/x-icon"
    />
    <title>@yield('title')</title>
    @include('includes.admin.style')
    @stack('addon-style')
</head>