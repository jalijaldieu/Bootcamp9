<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout dengan ringkasan keranjang.
     */
    public function index()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda masih kosong.');
        }

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

        return view('checkout.index', compact('items', 'total'));
    }

    /**
     * Proses pesanan dan simpan ke database.
     */
    public function store(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda masih kosong.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',
            'customer_address' => 'required|string|max:1000',
        ]);

        $order = DB::transaction(function () use ($cart, $validated) {
            $total = 0;
            $lineItems = [];

            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);

                if (! $product) {
                    continue;
                }

                $subtotal = $product->price * $quantity;
                $total += $subtotal;

                $lineItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
            }

            $order = Order::create(array_merge($validated, [
                'total' => $total,
                'status' => 'pending',
            ]));

            foreach ($lineItems as $line) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $line['product']->id,
                    'product_name' => $line['product']->name,
                    'price' => $line['product']->price,
                    'quantity' => $line['quantity'],
                    'subtotal' => $line['subtotal'],
                ]);
            }

            return $order;
        });

        Session::forget('cart');

        return redirect()->route('checkout.success', $order)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Halaman konfirmasi setelah checkout berhasil.
     */
    public function success(Order $order)
    {
        $order->load('items');

        return view('checkout.success', compact('order'));
    }
}
