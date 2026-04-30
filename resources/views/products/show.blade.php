<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-3xl mx-auto">
                
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
                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">金額</th>
                            <td class="px-4 py-3 text-gray-900">￥{{ number_format($product->price) }}</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <th class="bg-gray-100 px-4 py-3 text-left font-bold text-gray-700">会社</th>
                            <td class="px-4 py-3 text-gray-900">TNG</td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    @if(Auth::id() === $product->user_id)
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow transition">
                                編集する
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded shadow transition">
                                    削除する
                                </button>
                            </form>
                            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded shadow transition">
                                戻る
                            </a>
                        </div>
                    @else
                        @php
                            $isFavorite = \App\Models\Favorite::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
                        @endphp

                        <div class="flex items-center space-x-6">
                            
                            <div>
                                @if($isFavorite)
                                    <form action="{{ route('favorites.destroy', $product->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-4xl text-red-500 hover:text-gray-300 transition leading-none">
                                            ♥
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorites.store', $product->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="text-4xl text-gray-300 hover:text-red-500 transition leading-none">
                                            ♥
                                        </button>
                                    </form>
                                @endif
                            </div>
                            
                            <form action="{{ route('cart.store') }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                                    カートに追加する
                                </button>
                            </form>

                            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded shadow transition">
                                戻る
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>