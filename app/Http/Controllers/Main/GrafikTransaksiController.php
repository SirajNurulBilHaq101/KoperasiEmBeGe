<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class GrafikTransaksiController extends Controller
{
    public function index()
    {
        // ===== PENGELUARAN =====
        $pengeluaran = DB::table('item_transactions')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('SUM(quantity * unit_price) as total')
            )
            ->where('type', 'masuk')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();


        // ===== PEMASUKAN (ORDER CONFIRMED) =====
        $pemasukan = Order::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
            DB::raw('SUM(total) as total')
        )
            ->where('status', 'confirmed')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulan = $pengeluaran->pluck('bulan')
            ->merge($pemasukan->pluck('bulan'))
            ->unique()
            ->sort()
            ->values();

        $mapPengeluaran = $pengeluaran->pluck('total', 'bulan');
        $mapPemasukan   = $pemasukan->pluck('total', 'bulan');

        $dataPengeluaranFix = $bulan->map(fn($b) => $mapPengeluaran[$b] ?? 0);
        $dataPemasukanFix   = $bulan->map(fn($b) => $mapPemasukan[$b] ?? 0);

        return view('main.grafikTransaksi', [
            'labelsPengeluaran' => $pengeluaran->pluck('bulan'),
            'dataPengeluaran'   => $pengeluaran->pluck('total'),

            'labelsPemasukan'   => $pemasukan->pluck('bulan'),
            'dataPemasukan'     => $pemasukan->pluck('total'),

            'labels'            => $bulan,
            'pengeluaranFix'    => $dataPengeluaranFix,
            'pemasukanFix'      => $dataPemasukanFix,
        ]);
    }
}
