<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お問い合わせ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
                <form method="POST" action="{{ route('contacts.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="name" value="お名前" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="メールアドレス" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="content" value="お問い合わせ内容" />
                        <textarea id="content" name="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="6" required></textarea>
                    </div>

                    <div class="flex items-center justify-center space-x-4 mt-8">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded shadow transition">
                            送信
                        </button>
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-10 rounded shadow transition">
                            戻る
                        </a>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>