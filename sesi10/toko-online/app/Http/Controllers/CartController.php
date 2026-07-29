<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Tampilkan isi keranjang belanja.
     */
    public function index()
    {
        $cart = Session::get('cart', []);

        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);

            if (! $product) {
                continue;
            }

            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return view('cart.index', compact('items', 'total'));
    }

    /**
     * Tambahkan produk ke keranjang.
     */
    public function add(Request $request, Product $product)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        $cart = Session::get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $quantity;
        Session::put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', "\"{$product->name}\" ditambahkan ke keranjang.");
    }

    /**
     * Perbarui jumlah item di keranjang.
     */
    public function update(Request $request, Product $product)
    {
        $quantity = (int) $request->input('quantity', 1);
        $cart = Session::get('cart', []);

        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = $quantity;
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    /**
     * Hapus produk dari keranjang.
     */
    public function remove(Product $product)
    {
        $cart = Session::get('cart', []);
        unset($cart[$product->id]);
        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
