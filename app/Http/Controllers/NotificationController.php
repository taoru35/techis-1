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
            'title' => 'required|max:30', // タイトルの文字数を30文字に制限
            'content' => 'required|max:255' // 内容の文字数を255文字に制限
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

    public function edit(Notification $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'type' => 'required|in:product_management,user_management,important_notice',
            'title' => 'required|max:30',
            'content' => 'required|max:255'
        ]);

        $notification->update([
            'type' => $request->type,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('notifications.index')->with('success', '通知が更新されました');
    }
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', '通知が削除されました');
    }



}
