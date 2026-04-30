<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            購入画面
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-3xl mx-auto">
                
                @if(count($cart) > 0)
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf

                        @foreach($cart as $item)
                            @php
                                // データベースから最新の商品情報を取得（画像や在庫などを表示するため）
                                $product = \App\Models\Product::find($item['id']);
                            @endphp

                            @if($product)
                                <table class="min-w-full border-collapse border border-gray-200 mb-8">
                                    <tbody>
                                        <tr class="border-b border-gray-200">
                                            <th class="w-1/4 bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">商品名</th>
                                            <td class="px-4 py-3 text-gray-900">{{ $product->product_name }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">説明</th>
                                            <td class="px-4 py-3 text-gray-900 whitespace-pre-wrap">{{ $product->description }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">画像</th>
                                            <td class="px-4 py-3">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="max-w-xs h-auto rounded shadow-sm">
                                                @else
                                                    <span class="text-gray-400">画像なし</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">数量</th>
                                            <td class="px-4 py-3 text-gray-900">
                                                <input type="number" name="quantities[{{ $product->id }}]" value="{{ $item['quantity'] }}" min="1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-24">
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">金額</th>
                                            <td class="px-4 py-3 text-gray-900">￥{{ number_format($product->price) }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">残り</th>
                                            <td class="px-4 py-3 text-gray-900">{{ $product->stock ?? 0 }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">会社</th>
                                            <td class="px-4 py-3 text-gray-900">TNG</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        @endforeach

                        <div class="flex items-center space-x-6 mt-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition">
                                購入する
                            </button>
                            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-8 rounded shadow transition">
                                戻る
                            </a>
                        </div>
                    </form>
                @else
                    <div class="text-center py-10">
                        <p class="text-gray-500 text-lg mb-6">購入する商品がありません。</p>
                        <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                            商品一覧へ戻る
                        </a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>