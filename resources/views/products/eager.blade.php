@extends('layouts.app')

@section('title', 'Products with Eager Loading (Optimized)')

@section('content')
<h1>⚡ Products with Eager Loading</h1>

<div class="alert alert-success">
    <strong>✅ Optimized!</strong> This page uses eager loading to prevent the N+1 query problem. Check the debugbar below to see only 2 database queries total.
</div>

<div class="alert alert-info">
    <strong>💡 What's happening:</strong> Using <code>Product::with('prices')->get()</code> pre-loads all the price relationships in just 2 queries, so accessing <code>$product->prices->count()</code> doesn't trigger additional database calls.
</div>

<div class="content">
    @foreach($products as $product)
        <div class="product-item">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p><strong>Number of prices: {{ $product->prices->count() }}</strong></p>
        </div>
    @endforeach
</div>

<div class="alert alert-success">
    <strong>🎉 Check the Laravel Debugbar below!</strong> You should see only <strong>2 database queries</strong>:
    <br>• 1 query to fetch all products
    <br>• 1 query to fetch all prices for these products
    <br><br>
    <strong>⚡ Performance:</strong> This is 3x more efficient than the lazy loading approach!
</div>
@endsection