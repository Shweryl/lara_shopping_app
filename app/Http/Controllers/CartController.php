<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //trigger when user click add to cart
    public function add(Request $request){
        $qty = $request->qty;
        $productId = $request->productId;

        $product = Product::find($productId);
        if($qty > $product->stock){
            return back()->with('message',"You surpassed product limited stock.");
        }

        $carts = session('carts',[]);
        //add item quantity to session 'carts'
        if(isset($carts['id'.$productId])){
            $carts['id'.$productId] += $qty;
        }else{
            $carts['id'.$productId] = $qty;
        }

        session(['carts' => $carts]);

        return redirect()->route('cart.all'); //redirect to checkout list

    }

    //retrieve all items from carts session for checkout
    public function allcarts(){
        $carts = session('carts');
        $cartItems = [];
        $itemsTotal = 0;

        if(!isset($carts)){
            return view('Cart.allCarts');
        }

        foreach($carts as $key=>$qty){
            $id = str_replace('id','',$key);
            $product = Product::find($id);
            $total = $product->price * $qty;

            $cartItem = [
                'productId' => $key,
                'productName' => $product->name,
                'price' => $product->price,
                'quantity' => $qty,
                'total' => $total,
            ];

            $itemsTotal += $total;
            $cartItems[] = $cartItem;
        }
        return view('Cart.allCarts', compact('itemsTotal', 'cartItems')); //redirect to checkout view
    }

    //trigger when clear specific item from cart session
    public function clear($id){
        $carts = session('carts');
        if(isset($carts[$id])){
            unset($carts[$id]);
        }

        session(['carts'=> $carts]);

        return redirect()->route('cart.all');
    }
}
