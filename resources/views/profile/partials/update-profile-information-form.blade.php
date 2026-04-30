<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            プロフィール情報の更新
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="ユーザ名" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Eメール" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="name_kanji" value="名前" />
            <x-text-input id="name_kanji" name="name_kanji" type="text" class="mt-1 block w-full" :value="old('name_kanji', $user->name_kanji)" required autocomplete="name_kanji" />
            <x-input-error class="mt-2" :messages="$errors->get('name_kanji')" />
        </div>

        <div>
            <x-input-label for="name_kana" value="カナ" />
            <x-text-input id="name_kana" name="name_kana" type="text" class="mt-1 block w-full" :value="old('name_kana', $user->name_kana)" required autocomplete="name_kana" />
            <x-input-error class="mt-2" :messages="$errors->get('name_kana')" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-bold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 transition ease-in-out duration-150">
                戻る
            </a>
            
            <x-primary-button>{{ __('更新') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold">
                    {{ __('更新しました！') }}
                </p>
            @endif
        </div>
    </form>
</section>