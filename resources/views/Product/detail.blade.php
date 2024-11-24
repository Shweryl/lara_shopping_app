@extends('layouts.app')
@section('content')
<div class="container p-4 mt-4">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            @if(is_null($product->photo))
            <img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." />
            @else
            <img class="card-img-top mb-5 mb-md-0" src="{{asset("storage/{$product->photo}")}}" alt="..." />
            @endif
        </div>
        <div class="col-md-6">
            <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
            <div class="mb-1 ">Category : <span class="badge text-bg-dark text-white px-2">{{$product->category->name}}</span></div>
            <div class="fs-5 mb-4">
                <span class="text-danger">$ {{$product->price}}</span>
            </div>
            <span>Stock : {{$product->stock}}</span>
            <p class="lead">{{$product->description}}</p>
            <form action="{{route('cart.add')}}" method="post">
                @csrf
                <div class="d-flex">
                    <input type="hidden" value="{{$product->id}}" name="productId">
                    <div class="input-group w-auto me-2">
                        <button type="button" id="addBtn" class="input-group-text btn btn-light">
                            <i class="bi bi-plus"></i>
                        </button>
                        <input name="qty" class="form-control bg-dark text-white text-center" id="inputQuantity" type="num" value="" style="max-width: 3rem" />
                        <button type="button" id="looseBtn" class="input-group-text btn btn-light">
                            <i class="bi bi-dash text-dark"></i>
                        </button>
                    </div>
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div>
            </form>
            <a href="{{route('product.index')}}" class="btn btn-dark px-4 mt-3">Back</a>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        let inputqty = document.getElementById('inputQuantity');
        inputqty.value = 1
        let addBtn = document.getElementById('addBtn');
        let looseBtn = document.getElementById('looseBtn');
        addBtn.addEventListener('click',function(){
            inputqty.value++;
        })
        looseBtn.addEventListener('click',function(){
            if(inputqty.value <= 1){
                inputqty.value = 1;
            }else{
                inputqty.value--;
            }
        })
    </script>
@endpush
