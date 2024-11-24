@extends('layouts.app')

@section('content')
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="d-flex mb-2">
                {{-- fiter by category --}}
                <div class="dropdown me-2">
                    <div role="button" class="dropdown-toggle btn btn-outline-dark" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span>Filter by Category</span>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item bg {{ !request()->has('category') ? 'active' : '' }}"
                                href="{{ route('product.index') }}">All</a></li>
                        @foreach ($categories as $category)
                            <li id="incomeItem"><a
                                    class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}"
                                    href="{{ route('product.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- filter by price range --}}
                <div class="dropdown mb-2">
                    <div role="button" class="dropdown-toggle btn btn-outline-dark" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Filter by Amount</span>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item bg {{ !request()->has('range') ? 'active' : '' }}"
                                href="{{ route('product.index') }}">All</a></li>
                        <li id="incomeItem">
                            <a class="dropdown-item {{request()->input('range.from') == '10' ? 'active' : ''}}" href="{{ route('product.index',['range'=> ['from'=> 10, 'to' => 500]]) }}">$10 - $500</a>
                        </li>
                        <li id="incomeItem">
                            <a class="dropdown-item {{request()->input('range.from') == '500' ? 'active' : ''}}" href="{{ route('product.index', ['range'=> ['from'=> 500, 'to' => 1500]]) }}">$500 - $1500</a>
                        </li>
                        <li id="incomeItem">
                            <a class="dropdown-item {{request()->input('range.from') == '1500' ? 'active' : ''}}" href="{{ route('product.index', ['range'=> ['from'=> 1500, 'to' => 2000]]) }}">$1500 - $2000</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- Show filtered category --}}
            @if(request('category'))
                @php $category = $categories->where('id', request('category'))->first(); @endphp
                <div>
                    <small class="text-muted">Filter by Category : {{ $category->name }}</small>
                </div>
            @endif
            @if(request('range'))
                <div>
                    <small class="text-muted">Price between $ {{request()->input('range.from')}} and $ {{request()->input('range.to')}}</small>
                </div>
            @endif
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center mt-1">
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->

                            @if (is_null($product->photo))
                            <img class="card-img-top"  src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                            alt="..." />
                            @else
                            <img class="card-img-top" height="200" src="{{asset("storage/{$product->photo}")}}"
                                alt="..." />
                            @endif

                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <p class="badge text-bg-dark text-white">{{ $product->category->name }}</p>
                                    <!-- Product price-->
                                    <p class="mb-0">$ {{ $product->price }}</p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="{{ route('product.detail', $product->id) }}">View options</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
@endsection
