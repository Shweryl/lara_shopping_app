<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request){
        $cat = $request->category;
        $range = $request->range;
        $search = $request->search;
        $products = Product::when($cat, function($q, $cat){ //filter with category
            $q->where('category_id', $cat);
        })
        ->when($search, function($q, $search){ //search
            $q->where('name','like',"%$search%");
        })
        ->when($range, function($q, $range){ //filter with range
            $q->whereBetween('price', [$range['from'], $range['to']]);
        })
        ->latest()
        ->get();
        $categories = Category::all();
        return view('Product.index', compact('products', 'categories'));
    }

    public function create(){
        if(!Gate::allows('create-product')){ //only admin can create product
            return redirect()->route('home');
        }
        $categories = Category::all();
        return view('Product.create',compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1',
            'photo' => 'nullable|file|mimes:png,jpeg,jpg|max:1024',
            'description' => 'required|string'
        ]);

        $product = new Product();
        // if photo is included, assign it new name and store it
        if($request->hasFile('photo')){
            $newName = uniqid()."product_image".$request->file('photo')->extension();
            $request->file('photo')->storeAs("public",$newName);
            $product->photo = $newName;
        }

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->user_id = Auth::id();

        $product->save();

        return redirect()->route('product.index');

    }

    public function show($id){
        $product = Product::find($id);
        return view('Product.detail', compact('product'));
    }
}
