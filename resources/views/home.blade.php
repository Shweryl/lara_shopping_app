@extends('layouts.app')

@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Welcome to VE SHoP</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            <p class="text-center mt-4"><a class="text-priamry btn btn-light" href="{{route('product.index')}}">Shop Now</a></p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
    </div>
</section>

@endsection
