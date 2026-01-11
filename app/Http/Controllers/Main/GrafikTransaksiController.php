<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class GrafikTransaksiController extends Controller
{
    public function index()
    {
        $pengeluaran = Item::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('SUM(unit_price * quantity) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('main.grafikTransaksi', [
            'labels' => $pengeluaran->pluck('bulan'),
            'dataPengeluaran' => $pengeluaran->pluck('total'),
        ]);
    }
}
