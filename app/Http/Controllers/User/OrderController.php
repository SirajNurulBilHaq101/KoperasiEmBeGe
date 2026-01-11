<?php

namespace App\Http\Controllers\User;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.pesanan', compact('orders'));
    }

    public function checkout(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'payment_proof' => 'required|image|max:10240'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong');
        }

        DB::transaction(function () use ($cart, $request) {

            $file = $request->file('payment_proof');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('payment-proofs'), $filename);

            $order = Order::create([
                'user_id'       => auth()->id(),
                'total'         => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
                'status'        => 'pending',
                'payment_proof' => $filename,
            ]);

            foreach ($cart as $itemId => $data) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id'  => $itemId,
                    'price'    => $data['price'],
                    'qty'      => $data['qty'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()
            ->route('user.pesanan.index')
            ->with('success', 'Pesanan dikirim, menunggu konfirmasi admin');
    }


    public function store()
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return back()->with('error', 'Keranjang kosong');
        }

        DB::transaction(function () use ($cart) {

            $order = Order::create([
                'user_id' => auth()->id(),
                'status'  => 'pending',
                'total'   => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id'  => $item['id'],
                    'qty'      => $item['qty'],
                    'price'    => $item['price'],
                ]);

                Item::where('id', $item['id'])
                    ->decrement('quantity', $item['qty']);
            }
        });

        session()->forget('cart');

        return redirect()->route('user.katalog')
            ->with('success', 'Pesanan berhasil dibuat');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        DB::transaction(function () use ($order, $request) {

            // KONFIRMASI = BARANG RESMI TERBELI
            if ($order->status === 'pending' && $request->status === 'confirmed') {
                foreach ($order->items as $item) {
                    $item->item->decrement('quantity', $item->qty);
                }
            }

            // CANCEL = TIDAK DIBAYAR → STOK AMAN
            if ($order->status === 'confirmed' && $request->status === 'cancelled') {
                foreach ($order->items as $item) {
                    $item->item->increment('quantity', $item->qty);
                }
            }

            $order->update([
                'status' => $request->status
            ]);
        });

        return back()->with('success', 'Status pesanan diperbarui');
    }
}
