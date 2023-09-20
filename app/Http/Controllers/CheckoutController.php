<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        // 現在のログインユーザーを取得
        $user = Auth::user();

        // ユーザーに関連するカートアイテムを取得
        $cartItems = $user->items;

        // ビューにカートアイテムを渡して表示
        return view('checkout.index', ['cartItems' => $cartItems]);
    }


    public function store(Request $request)
    {
        // 購入処理（支払い、在庫の減少、通知メールの送信など）

        return redirect()->route('checkout.thankyou');
    }


}
