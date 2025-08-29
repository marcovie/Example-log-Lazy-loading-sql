<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: #f8fafc;
                color: #1a202c;
                margin: 0;
                padding: 2rem;
                min-height: 100vh;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                padding: 2rem;
            }
            .navigation {
                display: flex;
                gap: 1rem;
                margin-bottom: 2rem;
                justify-content: center;
                flex-wrap: wrap;
            }
            .button {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                font-size: 1rem;
                transition: all 0.2s ease;
                border: 2px solid transparent;
            }
            .button:hover {
                transform: translateY(-2px);
            }
            .button-home {
                background-color: #4f46e5;
                color: white;
            }
            .button-home:hover {
                background-color: #4338ca;
            }
            .button-lazy {
                background-color: #e53e3e;
                color: white;
            }
            .button-lazy:hover {
                background-color: #c53030;
            }
            .button-eager {
                background-color: #38a169;
                color: white;
            }
            .button-eager:hover {
                background-color: #2f855a;
            }
            .button-secondary {
                background-color: #e2e8f0;
                color: #4a5568;
                border: 2px solid #cbd5e0;
            }
            .button-secondary:hover {
                background-color: #cbd5e0;
                color: #2d3748;
            }
            h1 {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 1rem;
                color: #2d3748;
                text-align: center;
            }
            h2 {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
                color: #2d3748;
            }
            p {
                font-size: 1rem;
                color: #4a5568;
                margin-bottom: 1rem;
                line-height: 1.6;
            }
            .alert {
                padding: 1rem;
                border-radius: 6px;
                margin-bottom: 2rem;
                font-weight: 500;
            }
            .alert-info {
                background-color: #ebf8ff;
                color: #2b6cb0;
                border-left: 4px solid #3182ce;
            }
            .alert-warning {
                background-color: #fffbeb;
                color: #92400e;
                border-left: 4px solid #f59e0b;
            }
            .alert-success {
                background-color: #f0fff4;
                color: #276749;
                border-left: 4px solid #38a169;
            }
            .content {
                background-color: #f7fafc;
                border: 1px solid #e2e8f0;
                border-radius: 6px;
                padding: 1.5rem;
                margin-top: 1rem;
                overflow-x: auto;
            }
            .product-item {
                border-bottom: 1px solid #e2e8f0;
                padding: 1rem 0;
            }
            .product-item:last-child {
                border-bottom: none;
            }
        </style>
    @endif
</head>
<body>
    <div class="container">
        <div class="navigation">
            <a href="/" class="button button-home">🏠 Home</a>
            <a href="/products-lazy" class="button button-lazy">🐌 Lazy Loading (N+1)</a>
            <a href="/products-eager" class="button button-eager">⚡ Eager Loading</a>
        </div>
        
        @yield('content')
    </div>
</body>
</html>