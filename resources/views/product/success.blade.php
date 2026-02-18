@extends('layouts.app')
@section('title', $viewData['title'] ?? 'Product created')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="alert alert-success text-center" role="alert">
        {{ $viewData['message'] ?? 'Product created successfully!' }}
      </div>
      <div class="text-center">
        <a class="btn btn-primary" href="{{ route('product.index') }}">Back to Products</a>
      </div>
    </div>
  </div>
</div>
@endsection
