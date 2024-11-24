<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request){
        $qty = $request->qty;
        $productId = $request->productId;

        $carts = session('carts',[]);
        $product = Product::find($productId);
        if($qty > $product->stock){
            return back()->with('message',"Your order have surpassed product's limited stock");
        }
        if(isset($carts['id'.$productId])){
            $carts['id'.$productId] += $qty;
        }else{
            $carts['id'.$productId] = $qty;
        }

        session(['carts' => $carts]);

        return redirect()->route('cart.all');

    }

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
        return view('Cart.allCarts', compact('itemsTotal', 'cartItems'));
    }

    public function clear($id){
        $carts = session('carts');
        if(isset($carts[$id])){
            unset($carts[$id]);
        }

        session(['carts'=> $carts]);

        return redirect()->route('cart.all');
    }
}
