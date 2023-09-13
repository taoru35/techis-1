<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;  // カスタマーモデルを使用するために追加

class CustomerController extends Controller
{
    /**
     * カスタマー一覧画面を表示
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customers = Customer::all();  // すべてのカスタマーデータを取得

        return view('customers.index', ['customers' => $customers]);  // ビューにデータを渡して表示
    }
}
