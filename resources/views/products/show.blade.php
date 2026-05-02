@extends('layouts.app')

@section('content')

<h2>Product Details</h2>

<div class="card p-3">
    <h4>{{ $product->name }}</h4>
    <p>{{ $product->description }}</p>
    <h5>₱{{ $product->price }}</h5>

    <hr>

    <h6>QR Code:</h6>
    {!! $qr !!}
</div>

<a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a>

@endsection