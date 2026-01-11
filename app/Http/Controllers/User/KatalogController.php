<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $items = Item::where('quantity', '>', 0)
            ->orderBy('name')
            ->get();

        return view('user.katalog', compact('items'));
    }

    public function addToCart(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $qty = max(1, (int) $request->qty);

        $cart = session()->get('cart', []);

        // qty yang sudah ada di cart
        $currentQty = isset($cart[$id]) ? $cart[$id]['qty'] : 0;

        // total yang akan dimiliki user
        $requestedQty = $currentQty + $qty;

        // CEK STOK
        if ($requestedQty > $item->quantity) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $requestedQty;
        } else {
            $cart[$id] = [
                'id'    => $item->id,
                'name'  => $item->name,
                'price' => $item->unit_price,
                'qty'   => $qty,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Item ditambahkan ke keranjang');
    }
}
