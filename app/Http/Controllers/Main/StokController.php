<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokController extends Controller
{
    public function index()
    {
        // DATA STOK DIGABUNG
        $items = Item::select(
            'name',
            'unit',
            'category_id',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('MIN(expired_at) as nearest_expired'),
            DB::raw('AVG(unit_price) as avg_price')
        )
            ->with('category')
            ->groupBy('name', 'unit', 'category_id')
            ->get();

        $stokHabis   = $items->where('total_quantity', '<=', 0);
        $stokMenipis = $items->whereBetween('total_quantity', [1, 5]);

        // ITEM EXPIRED (DETAIL)
        $expiredItems = Item::whereDate('expired_at', '<', now())
            ->orderBy('expired_at')
            ->get();

        return view('main.stok-barang', compact(
            'items',
            'stokHabis',
            'stokMenipis',
            'expiredItems'
        ));
    }
}
