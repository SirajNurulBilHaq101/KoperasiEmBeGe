<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $categories = Category::where('is_active', true)->get();

        return view('masterData.dataBarang', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string',
            'unit'        => 'required|string',
            'unit_price' => 'nullable|numeric',
            'quantity'   => 'nullable|numeric',
            'expired_at' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($request->category_id);

        // $prefix = strtoupper($category->code); // BPK, SAY, FRU
        $prefix = collect(explode('_', $category->code))
            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
            ->implode('');

        $date   = now()->format('ymd');

        $lastItem = Item::where('code', 'like', "$prefix-$date-%")
            ->orderByDesc('id')
            ->first();

        $number = $lastItem
            ? str_pad((int) substr($lastItem->code, -4) + 1, 4, '0', STR_PAD_LEFT)
            : '0001';

        Item::create([
            'category_id' => $category->id,
            'code'        => "$prefix-$date-$number",
            'name'        => $request->name,
            'unit'        => $request->unit,
            'unit_price' => $request->unit_price ?? 0,
            'quantity'   => $request->quantity ?? 0,
            'expired_at' => $request->expired_at,
            'description' => $request->description,
        ]);

        return redirect()->route('data-barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()
            ->route('data-barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
