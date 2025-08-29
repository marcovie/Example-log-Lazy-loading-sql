@extends('layouts.app')

@section('title', 'Products with Lazy Loading (N+1 Problem)')

@section('content')
<h1>🐌 Products with Lazy Loading</h1>

<div class="alert alert-warning">
    <strong>⚠️ N+1 Query Problem!</strong> This page demonstrates the lazy loading issue. Check the debugbar below to see multiple database queries being executed (1 for products + 1 for each product's prices).
</div>

<div class="alert alert-info">
    <strong>💡 What's happening:</strong> Each time we access <code>$product->prices->count()</code>, Laravel executes a separate database query because the prices weren't pre-loaded.
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
    <strong>🔍 Check the Laravel Debugbar below!</strong> You should see <strong>6 database queries</strong>:
    <br>• 1 query to fetch all products
    <br>• 5 additional queries (one for each product's prices)
    <br><br>
    <strong>💡 Solution:</strong> Click the "Eager Loading" button above to see the optimized version!
</div>
@endsection