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
    if ($request->isMethod('post')) {

        // バリデーション
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'detail' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        // 画像の保存
        if ($request->hasFile('image')) {
            $filename = $this->storeImage($request->file('image'));
            $data['image'] = $filename;  // S3のファイル名を保存
        }

        // 商品登録
        $data['user_id'] = Auth::user()->id;
        Item::create($data);

        return redirect('/items');
    }

    return view('item.add');
}

private function storeImage($file)
{
    $filename = 'items/images/' . time() . '.' . $file->getClientOriginalExtension();
    Storage::disk('s3')->put($filename, file_get_contents($file));
    return $filename;
}


}
