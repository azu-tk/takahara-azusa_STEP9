<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
                
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="product_name" value="商品名" />
                        <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" value="価格" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="商品説明" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required></textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="stock" value="在庫数" />
                        <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" required />
                    </div>

                    <div class="mb-8">
                        <x-input-label for="image" value="商品画像" />
                        <input id="image" class="block mt-1 w-full text-gray-700 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2" type="file" name="image" accept="image/*" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-8 rounded shadow transition">
                            戻る
                        </a>
                        
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition">
                            登録する
                        </button>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>