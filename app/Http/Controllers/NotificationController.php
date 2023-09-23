<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;



class NotificationController extends Controller
{


    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:product_management,user_management,important_notice',
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        Notification::create([
            'type' => $request->type,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('home')->with('success', '通知が投稿されました');
    }

    public function index()
    {
        $notifications = Notification::all();
        return view('notifications.index', ['notifications' => $notifications]);
    }


}
