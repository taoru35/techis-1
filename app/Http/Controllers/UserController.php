<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer; // Customerモデルを使用する場合、これも追加する必要があります
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // バリデーションルールの設定
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,staff,user',
            'full_name' => 'required_if:role,user', // roleがuserの場合のみ必須
            'address' => 'required',
            'phone_number' => 'required'

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // roleがuserの場合、顧客情報も保存
        if ($request->role === 'user') {
            $user->customer()->create([
                'full_name' => $request->full_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'ユーザーが正常に作成されました。');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'ユーザーが削除されました');
    }


}
