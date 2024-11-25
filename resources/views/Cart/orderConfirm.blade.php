@extends('layouts.app')

@section('content')
<div class="bg-dark py-5">
    <h1 class="text-center text-white">Order has been placed</h1>
    <p class="text-center text-white">We sent you an email about order</p>
    <p class="text-center text-white">Shop for more products</p>
    <p class="text-center"><a class="btn text-primary btn-outline-light" href="{{route('product.index')}}">Browse</a></p>
</div>
@endsection
