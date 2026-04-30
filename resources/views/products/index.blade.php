<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-center mb-8 border-b border-gray-200 pb-4">
                    <form action="{{ route('products.index') }}" method="GET" class="flex flex-wrap items-center justify-center gap-2 w-full">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名を入力" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full sm:w-64">
                        
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="最低価格" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-24 sm:w-32">
                        
                        <span class="text-gray-500 font-bold px-1">〜</span>
                        
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="最高価格" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-24 sm:w-32">
                        
                        <button type="submit" class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-6 rounded shadow transition whitespace-nowrap">
                            検索
                        </button>
                        
                        @if(request('keyword') || request('min_price') || request('max_price'))
                            <a href="{{ route('products.index') }}" class="text-sm text-blue-500 hover:text-blue-700 hover:underline whitespace-nowrap ml-2">
                                クリア
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-500 whitespace-nowrap">商品番号</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-500 whitespace-nowrap">商品名</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-500 whitespace-nowrap">商品説明</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-500 whitespace-nowrap">画像</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-500 whitespace-nowrap">料金(¥)</th>
                                <th class="px-6 py-3"></th> </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $product->id }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">{{ $product->product_name }}</td>
                                    
                                    <td class="px-6 py-4 text-gray-700 max-w-xs truncate">{{ $product->description }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="w-16 h-16 object-cover rounded shadow-sm">
                                        @else
                                            <span class="text-gray-400 text-sm">画像なし</span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">￥{{ number_format($product->price) }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <a href="{{ route('products.show', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow transition">
                                            詳細
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-lg">
                                        商品が見つかりませんでした。
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                </div>
        </div>
    </div>
</x-app-layout>