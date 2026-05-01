<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 購入画面
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // カートに追加
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
        
        session()->put('cart', $cart); 
        return redirect()->route('cart.index'); 
    }

    // 購入確定
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        $quantities = $request->input('quantities', []);

        // 購入履歴と在庫の処理
        foreach($cart as $item) {
            $buyQty = isset($quantities[$item['id']]) ? $quantities[$item['id']] : $item['quantity'];

            //購入履歴
            Sale::create([
                'user_id' => Auth::id(),
                'product_id' => $item['id'],
                'quantity' => $buyQty, 
            ]);

            //追加：購入した分、商品の在庫を減らす
            $product = Product::find($item['id']);
            if ($product) {
                // 今の在庫から買った個数を引き算
                $product->stock = $product->stock - $buyQty;
                if ($product->stock < 0) { $product->stock = 0; }
                $product->save();
            }
        }

        // 購入が終わったら箱を空っぽにする
        session()->forget('cart');

        return redirect()->route('dashboard')->with('success', '購入が完了しました！');
    }
}