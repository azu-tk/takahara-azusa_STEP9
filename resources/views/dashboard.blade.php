<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マイページ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-8">
                    <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        アカウント編集
                    </a>
                </div>

                <div class="mb-10">
                    <h3 class="text-xl font-bold mb-4 border-b-2 border-gray-200 pb-2">ユーザ情報</h3>
                    
                    <div class="grid grid-cols-2 gap-y-4 bg-gray-50 p-6 rounded-md">
                        <div><span class="text-gray-500 font-bold w-24 inline-block">ユーザ名:</span> <span class="font-medium">{{ Auth::user()->name }}</span></div>
                        <div><span class="text-gray-500 font-bold w-16 inline-block">名前:</span> <span class="font-medium">{{ Auth::user()->name_kanji }}</span></div>
                        
                        <div><span class="text-gray-500 font-bold w-24 inline-block">Eメール:</span> <span class="font-medium">{{ Auth::user()->email }}</span></div>
                        <div><span class="text-gray-500 font-bold w-16 inline-block">カナ:</span> <span class="font-medium">{{ Auth::user()->name_kana }}</span></div>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex justify-between items-center mb-4 border-b-2 border-gray-200 pb-2">
                        <h3 class="text-xl font-bold">出品商品</h3>
                        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded shadow text-sm">
                            新規登録
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">商品番号</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">商品名</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">商品説明</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">料金(¥)</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($myProducts as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->id }}</td>
                                <td class="px-4 py-2">{{ $product->product_name }}</td>
                                <td class="px-4 py-2">{{ Str::limit($product->description, 20) }}</td>
                                <td class="px-4 py-2">{{ $product->price }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow transition">詳細</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-gray-500 text-center">出品している商品はありません。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4 border-b-2 border-gray-200 pb-2">購入商品</h3>
                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">商品名</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">商品説明</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">料金(¥)</th>
                                <th class="px-4 py-2 text-left text-sm text-gray-500 font-bold">個数</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($myPurchases as $sale)
                            <tr>
                                <td class="px-4 py-2">{{ $sale->product->product_name }}</td>
                                <td class="px-4 py-2">{{ Str::limit($sale->product->description, 20) }}</td>
                                <td class="px-4 py-2">{{ $sale->product->price }}</td>
                                <td class="px-4 py-2">{{ $sale->quantity }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-gray-500 text-center">購入した商品はありません。</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>