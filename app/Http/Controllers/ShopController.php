<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        $selectedType = $request->input('type');
        if ($selectedType) {
            $query->where('type', $selectedType);
        }

        $searchTerm = $request->input('search');
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('detail', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $items = $query->paginate(12);

        // 型の取得
        $types = Item::distinct()->pluck('type')->all();

        return view('shop.index', compact('items', 'types', 'selectedType'));
    }

    public function show(Item $item)
    {
        return view('shop.show', compact('item'));
    }



}
