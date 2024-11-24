@extends('layouts.app')

@section('content')
<div class="bg-dark py-5">
    <h1 class="text-center text-white">Checkout List</h1>
    <p class="text-center text-white">All Cart items are listed below.</p>
</div>
<div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Item Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @isset($cartItems)
            @foreach ($cartItems as $cartItem)
            <tr>
                <td>{{$i}}</td>
                <td>{{$cartItem['productName']}}</td>
                <td>{{$cartItem['quantity']}}</td>
                <td>$ {{$cartItem['price']}}</td>
                <td>$ {{$cartItem['total']}}</td>
                <td>
                    <a href="{{route('cart.clear', $cartItem['productId'])}}" class="btn btn-outline-dark">Clear</a>
                </td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach
            @endisset
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="fw-bold">Total</td>
                <td class="fw-bold">$ {{$itemsTotal ?? 0}}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class=" text-center mt-2">
        <a href="{{route('order.submit')}}" class="btn btn-dark text-white">Order Submit</a>
    </div>
</div>
@endsection
