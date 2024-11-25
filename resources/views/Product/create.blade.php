@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-4 px-md-0 px-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white fs-5 text-center ">

                    Add New Product
                </div>

                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="mb-2">Name</label>
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price" class="mb-2">Price</label>
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{ old('price') }}" autocomplete="price"
                                    autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Category" class="mb-2">Category</label>
                                <select class="form-select" name="category_id" id="">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="mb-2">Stock</label>
                                <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror"
                                    name="stock" value="{{ old('stock') }}" autocomplete="stock"
                                    autofocus>

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description" class="mb-2">Description</label>
                                <textarea id="description" cols="3" type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="" autocomplete="description"
                                    autofocus>
                                    {{ old('description') }}
                                </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="photo" class="mb-2">Product Photo</label>
                                <input type="file" class="form-control" name="photo" id="">
                            </div>
                        </div>




                        <div class="text-center">
                            <button type="submit " class="btn btn-dark text-white">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

