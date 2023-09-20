<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->items()->withPivot('quantity')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Item $item)
    {
        $user = auth()->user();
        $cart = $user->carts()->firstOrCreate(['item_id' => $item->id], ['quantity' => 0]);

        $cart->increment('quantity');

        return redirect()->route('cart.index');
    }

    public function remove(Item $item)
    {
        $user = auth()->user();
        $user->carts()->where('item_id', $item->id)->delete();
        return redirect()->route('cart.index');
    }


    public function increaseQuantity(Item $item)
    {
        $user = auth()->user();
        $cartItem = $user->carts()->where('item_id', $item->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        }

        return redirect()->route('cart.index');
    }

    public function decreaseQuantity(Item $item)
    {
        $user = auth()->user();
        $cartItem = $user->carts()->where('item_id', $item->id)->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->route('cart.index');
    }



}
