<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('site.meta.default_title'))</title>
    <meta name="description" content="@yield('meta_description', __('site.meta.default_description'))">
    <link rel="icon" href="{{ url('/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/svg+xml" href="{{ url('/img/logo.svg') }}">
    <link rel="apple-touch-icon" href="{{ url('/img/logo-200.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Noto+Serif+SC:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              gold: {
                50: '#fbf7ed', 100: '#f5ecd3', 200: '#e8d49b',
                300: '#d6b566', 400: '#c69a44', 500: '#b78a3a',
                600: '#9b6f2b', 700: '#7a5520', 800: '#5c3f19', 900: '#3e2a10'
              },
              ink: {
                50: '#f7f6f3', 100: '#e8e5db', 200: '#cfc9b7',
                700: '#3a3528', 800: '#211e16', 900: '#100f0b'
              }
            },
            fontFamily: {
              sans: ['Inter', 'system-ui', 'sans-serif'],
              serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
              cn: ['"Noto Serif SC"', '"Songti SC"', 'serif']
            }
          }
        }
      }
    </script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; color: #211e16; background: #fbf9f3; }
        .font-display { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-cn { font-family: 'Noto Serif SC', serif; }
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.25rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; }
        .btn-primary { background: #b78a3a; color: white; }
        .btn-primary:hover { background: #9b6f2b; transform: translateY(-1px); box-shadow: 0 8px 16px -8px rgba(155,111,43,0.6); }
        .btn-outline { border: 1px solid #cfc9b7; color: #3a3528; background: white; }
        .btn-outline:hover { background: #f5ecd3; border-color: #b78a3a; }
        .btn-ghost { color: #3a3528; }
        .btn-ghost:hover { background: rgba(183,138,58,0.08); }
        .btn-danger { background: #b91c1c; color: white; }
        .badge { display: inline-flex; align-items: center; padding: 0.125rem 0.625rem; border-radius: 999px; font-size: 0.75rem; font-weight: 500; }
        .input { margin-top: 0.25rem; width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #cfc9b7; border-radius: 0.5rem; background: white; }
        .input:focus { outline: none; border-color: #b78a3a; box-shadow: 0 0 0 3px rgba(183,138,58,0.15); }
        .label { font-size: 0.875rem; font-weight: 500; color: #3a3528; }
        .card { background: white; border-radius: 0.75rem; border: 1px solid #e8e5db; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
        table th { text-align: left; padding: 0.75rem 1rem; background: #fbf7ed; color: #5c3f19; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        table td { padding: 0.75rem 1rem; font-size: 0.875rem; border-top: 1px solid #f1ede1; color: #3a3528; }
        .gold-divider { background: linear-gradient(to right, transparent, #b78a3a, transparent); height: 1px; }
        .prose-gold { color: #211e16; }
        .prose-gold p { margin-bottom: 1rem; line-height: 1.7; }
    </style>
</head>
<body class="min-h-screen">
    @include('partials.nav')

    @hasSection('hero')
        @yield('hero')
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @include('partials.flash')
            @yield('content')
        </main>
    @else
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @include('partials.flash')
            @yield('content')
        </main>
    @endif

    @include('partials.footer')
</body>
</html>
