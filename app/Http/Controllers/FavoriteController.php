<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // お気に入り（赤）
    public function store($productId)
    {
        Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);
        return back(); 
    }

    // お気に入り解除（グレー）
    public function destroy($productId)
    {
        Favorite::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        return back(); 
    }
}