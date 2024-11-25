<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //trigger when user submite order
    public function submit(){
        $carts = session('carts');

        if(!isset($carts)){
            return redirect()->route('product.index')->with('message', 'There is no items. Add items');
        }

        $itemsTotal = 0;

        foreach($carts as $key=>$qty){
            $id = str_replace('id','',$key);
            $product = Product::find($id);
            $total = $product->price * $qty;
            $itemsTotal += $total;
            $updateQty = $product->stock - $qty; //subtract the current order qty from product's stock

            Order::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'quantity' => $qty,
                'total_price' => $itemsTotal
            ]);

            $product->stock = $updateQty; //update the product stock with new stock number
            $product->save();
        }

        session()->forget('carts');

        $user = Auth::user();
        $user->notify(new OrderNotify()); //notify user about order
        return redirect()->route('order.confirm');

    }

    public function confirm(){
        return view('Cart.orderConfirm');
    }
}
