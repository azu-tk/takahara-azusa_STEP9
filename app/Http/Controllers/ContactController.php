<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // お問い合わせフォーム
    public function create()
    {
        return view('contacts.create');
    }

    // 送信されたデータをデータベースに保存
    public function store(Request $request)
    {
        // 入力チェック
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string',
        ]);

        // データベースに保存
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);

        // 送信→商品一覧画面
        return redirect()->route('products.index');
    }
}