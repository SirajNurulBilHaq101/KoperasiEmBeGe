<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

        return view('user.cart', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $item = Item::findOrFail($request->item_id);
        $qty  = max(1, (int) $request->qty);

        $cart = session()->get('cart', []);

        $currentQty = $cart[$item->id]['qty'] ?? 0;
        $requestedQty = $currentQty + $qty;

        if ($requestedQty > $item->quantity) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $cart[$item->id] = [
            'id'    => $item->id,
            'name'  => $item->name,
            'price' => $item->unit_price,
            'qty'   => $requestedQty,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Item ditambahkan ke keranjang');
    }

    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item dihapus dari keranjang');
    }
}
