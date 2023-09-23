<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;  // カスタマーモデルを使用するために追加
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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


    public function create()
    {
        return view('customers.create');  // 'customers.create'はカスタマー登録フォームのビューファイル名を指定します。
    }




    public function store(Request $request)
    {
        // バリデーションの定義
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'full_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        // ユーザーの保存
        $user = new User();
        $user->name = $request->nickname;  // この行を更新
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';  // ここでroleを'user'に設定
        $user->save();

        // カスタマー情報の保存
        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->full_name = $request->full_name;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'カスタマーを登録しました。');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'カスタマーが削除されました');
    }




}
