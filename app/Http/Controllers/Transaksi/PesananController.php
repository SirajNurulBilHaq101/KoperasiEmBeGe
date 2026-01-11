<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.item'])
            ->latest()
            ->get();

        return view('transaksi.pesanan', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user',
            'items.item'
        ]);

        return view('transaksi.pesanan-show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        DB::transaction(function () use ($order, $request) {

            if ($order->status === 'pending' && $request->status === 'confirmed') {
                foreach ($order->items as $orderItem) {
                    $orderItem->item->decrement('quantity', $orderItem->qty);
                }
            }

            if ($order->status === 'confirmed' && $request->status === 'cancelled') {
                foreach ($order->items as $orderItem) {
                    $orderItem->item->increment('quantity', $orderItem->qty);
                }
            }

            $order->update([
                'status' => $request->status
            ]);
        });

        return back()->with('success', 'Status pesanan diperbarui');
    }
}
