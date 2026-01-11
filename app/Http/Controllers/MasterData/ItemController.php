<?php

namespace App\Http\Controllers\MasterData;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ItemTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $categories = Category::where('is_active', true)->get();

        return view('masterData.dataBarang', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'unit'        => 'required|string|max:20',
            'unit_price'  => 'nullable|numeric|min:0',
            'quantity'    => 'nullable|numeric|min:0',
            'expired_at'  => 'nullable|date',
            'description' => 'nullable|string',
        ]);
    
        $category = Category::findOrFail($request->category_id);
    
        // Ambil inisial kategori
        // BAHAN_POKOK -> BP, SAYUR -> S
        $prefix = collect(explode('_', $category->code))
            ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
            ->implode('');
    
        $date = now()->format('ymd');
    
        $lastItem = Item::where('code', 'like', "$prefix-$date-%")
            ->orderByDesc('id')
            ->first();
    
        $number = $lastItem
            ? str_pad((int) substr($lastItem->code, -4) + 1, 4, '0', STR_PAD_LEFT)
            : '0001';
    
        // =====================
        // SIMPAN ITEM
        // =====================
        $item = Item::create([
            'category_id' => $category->id,
            'user_id'     => Auth::id(),
            'code'        => "$prefix-$date-$number",
            'name'        => $request->name,
            'unit'        => $request->unit,
            'unit_price' => $request->unit_price ?? 0,
            'quantity'   => $request->quantity ?? 0,
            'expired_at' => $request->expired_at,
            'description'=> $request->description,
        ]);
    
        // =====================
        // SIMPAN HISTORI TRANSAKSI (MASUK = PENGELUARAN)
        // =====================
        ItemTransaction::create([
            'item_id'    => $item->id,
            'user_id'    => Auth::id(),
            'type'       => 'masuk',
            'quantity'   => $item->quantity,
            'unit_price' => $item->unit_price,
        ]);
    
        return redirect()
            ->route('data-barang.index')
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
