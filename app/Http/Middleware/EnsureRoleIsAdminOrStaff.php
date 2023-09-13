<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureRoleIsAdminOrStaff
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // ユーザーがログインしていない場合、ログインページへリダイレクト
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role !== 'admin' && $user->role !== 'staff') {
            // ユーザーが管理者やスタッフでない場合、ホームページへリダイレクト
            return redirect()->route('salon.homepage');
        }

        return $next($request);
    }
}
