<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::where('role', 'user')->count();
        $itemCount = Item::count();

        // それぞれの通知タイプに関する通知を取得
        $productNotifications = Notification::where('type', 'product_management')->latest()->take(5)->get();
        $userNotifications = Notification::where('type', 'user_management')->latest()->take(5)->get();
        $importantNotifications = Notification::where('type', 'important_notice')->latest()->take(5)->get();

        return view('home', compact('userCount', 'itemCount', 'productNotifications', 'userNotifications', 'importantNotifications'));
    }
}
