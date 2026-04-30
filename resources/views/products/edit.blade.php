<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品の編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
                
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="product_name" value="商品名" />
                        <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" value="価格" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ old('price', $product->price) }}" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="商品説明" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="stock" value="在庫数" />
                        <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required />
                    </div>

                    <div class="mb-8">
                        <x-input-label for="image" value="商品画像" />
                        
                        @if ($product->image)
                            <div class="my-2">
                                <span class="text-sm text-gray-500 block mb-1">現在の画像：</span>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="現在の画像" class="w-32 h-32 object-cover rounded shadow-sm">
                            </div>
                        @endif
                        
                        <input id="image" class="block mt-1 w-full text-gray-700 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2" type="file" name="image" accept="image/*" />
                        <p class="text-sm text-gray-500 mt-1">※画像を変更しない場合は、そのままにしておいてください。</p>
                    </div>

                    <div class="flex items-center justify-between mt-6 border-t border-gray-200 pt-6">
                        
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-8 rounded shadow transition">
                            戻る
                        </a>
                        
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition">
                            更新する
                        </button>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>