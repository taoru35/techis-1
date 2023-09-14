<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
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
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
 /**
 * 商品登録
 */
public function add(Request $request)
{
    // POSTリクエストのとき
    if ($request->isMethod('post')) {

        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:100',
            'type' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        $filename = null;  // デフォルトをnullにしておく

        // 画像の保存
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'items/images/' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put($filename, file_get_contents($file));

        }

        // 商品登録
        Item::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'type' => $request->type,
            'detail' => $request->detail,
            'image' => $filename,  // S3のファイル名を保存
            'price' => $request->price,
        ]);

        return redirect('/items');
    }

    return view('item.add');
}

}
