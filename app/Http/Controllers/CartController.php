<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order; // Assuming you have an Order model
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        return view('cart.index', compact('cart'));
    }


    public function update(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            foreach ($request->input('quantities') as $orderId => $quantity) {
                $order = $cart->orders()->find($orderId);
                if ($order) {
                    $order->quantity = $quantity;
                    $order->save();
                }
            }
        }

        return response()->json(['success' => true]);
    }
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($validatedData['product_id']);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $order = $cart->orders()->where('product_id', $validatedData['product_id'])->first();

        if ($order) {
            $order->quantity += 1;
            $order->total = $order->price * $order->quantity;
            $order->total_points = $product->gift_points * $order->quantity;
            $order->save();
        } else {
            $order = new Order();
            $order->product_id = $validatedData['product_id'];
            $order->cart_id = $cart->id;
            $order->quantity = 1;
            $order->price = $product->price;
            $order->total = $order->price * $order->quantity;
            $order->total_points = $product->gift_points;
            $cart->orders()->save($order);
        }

        $this->updateCartTotals($cart);

        session()->flash('success', 'Item added to cart.');
        return redirect()->route('cart.index');
    }



    protected function updateCartTotals($cart)
    {
        $total = 0;
        $totalPoints = 0;

        foreach ($cart->orders as $order) {
            $total += $order->total;
            $totalPoints += $order->total_points;
        }

        $cart->total_price = $total;
        $cart->points = $totalPoints;
        $cart->save();

        return response()->json(['success' => true]);
    }





    public function remove($orderId)
    {
        // Logic to remove an order from the cart
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->orders()->where('id', $orderId)->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
