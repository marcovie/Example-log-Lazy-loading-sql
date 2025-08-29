@extends('layouts.app')

@section('title', 'Laravel Lazy Loading Demo')

@section('content')
<div style="text-align: center; padding: 2rem 0;">
    <h1>🚀 Laravel Lazy Loading Demo</h1>
    <p style="font-size: 1.125rem; margin-bottom: 2rem;">
        Compare the performance difference between lazy loading (N+1 problem) and eager loading.<br>
        Check the <strong>Laravel Debugbar</strong> at the bottom of each page to see the database queries.
    </p>
    
    <div class="alert alert-info" style="text-align: left; max-width: 600px; margin: 0 auto 2rem;">
        <strong>📊 What you'll see:</strong>
        <br>• <strong>Lazy Loading:</strong> 6 database queries (1 + 5 individual queries)
        <br>• <strong>Eager Loading:</strong> 2 database queries (optimized)
        <br>• <strong>Lazy Loading Detection:</strong> Check <code>storage/logs/laravel.log</code> for violations
    </div>
    
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="/products-lazy" class="button button-lazy">
            🐌 Lazy Loading (N+1 Problem)
        </a>
        <a href="/products-eager" class="button button-eager">
            ⚡ Eager Loading (Optimized)
        </a>
    </div>
    
    <div class="alert alert-warning" style="text-align: left; max-width: 600px; margin: 2rem auto 0;">
        <strong>💡 Learning Goal:</strong>
        <br>Understand how the innocent-looking code <code>$product->prices->count()</code> can cause major performance issues when not properly optimized with eager loading.
    </div>
</div>
@endsection