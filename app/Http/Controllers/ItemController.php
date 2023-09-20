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


public function edit($id)
{
    $item = Item::find($id);
    return view('item.edit', compact('item'));
}

public function update(Request $request, $id)
{
    // バリデーション
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'detail' => 'required|string|max:500',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'price' => 'required|numeric|min:0',
    ]);

    $item = Item::find($id);

    // 画像がアップロードされた場合
    if ($request->hasFile('image')) {
        // 既存の画像を削除
        Storage::disk('s3')->delete($item->image);

        $filename = $this->storeImage($request->file('image'));
        $data['image'] = $filename;  // S3のファイル名を保存
    }

    // 商品情報更新
    $item->update($data);

    return redirect('/items')->with('success', '商品情報を更新しました。');
}

public function destroy($id)
{
    $item = Item::findOrFail($id);

    // S3から画像を削除する場合
    Storage::disk('s3')->delete($item->image);

    $item->delete();
    return redirect('/items')->with('success', '商品が削除されました');
}


}
