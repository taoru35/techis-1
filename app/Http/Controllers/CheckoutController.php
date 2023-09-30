<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;

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
        // Stripeの初期設定
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // トータル料金を計算 (例：すべてのアイテムの価格の合計)
        $totalAmount = 0;
        foreach (Auth::user()->items as $item) {
            $totalAmount += $item->price;
        }

        try {
            // 支払い処理
            $charge = Charge::create([
                'amount' => $totalAmount * 100, // Stripeはセント単位で料金を扱います
                'currency' => 'jpy',
                'source' => $request->input('stripeToken'),
                'description' => 'Order from ' . Auth::user()->email,
            ]);

            // 支払いが成功したら、購入処理（在庫の減少、通知メールの送信など）を続ける

            return redirect()->route('checkout.thankyou');

        } catch (\Exception $e) {
            // 支払いが失敗したらエラーメッセージを表示
            return back()->with('error', '決済に失敗しました。' . $e->getMessage());
        }
    }
}
