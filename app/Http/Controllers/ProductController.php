<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //  商品一覧
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $query = Product::query();

        if (\Illuminate\Support\Facades\Auth::check()) {
            $query->where('user_id', '!=', \Illuminate\Support\Facades\Auth::id());
        }

        if (!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        if (!empty($min_price)) {
            $query->where('price', '>=', $min_price);
        }

        if (!empty($max_price)) {
            $query->where('price', '<=', $max_price);
        }

        $products = $query->orderBy('id', 'asc')->get();

        return view('products.index', compact('products', 'keyword', 'min_price', 'max_price'));
    }

    // 商品詳細
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 商品登録
    public function create()
    {
        return view('products.create');
    }

    // 送られてきたデータを保存
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'stock' => 'required|integer', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->user_id = \Illuminate\Support\Facades\Auth::id(); 
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock; 

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    // 商品編集画面
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    // 編集データ上書き保存
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'stock' => 'required|integer', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock; 

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', '商品を更新しました！');
    }

    // 商品の削除
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}