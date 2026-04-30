<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('products.index') }}" class="font-bold text-2xl text-blue-600 hover:text-blue-800">
                    Cytech EC
                </a>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-bold transition">
                    Home
                </a>

                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-bold transition">
                     マイページ
                 </a>
                
                <span class="text-gray-700 font-medium">
                    ログインユーザー：{{ Auth::user()->name }}
                </span>
                
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                  @csrf
                     <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow transition">
                        ログアウト
                     </button>
                 </form>
            </div>
        </div>
    </div>
</nav>