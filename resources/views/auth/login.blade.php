<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 p-8 space-y-8">
                    <!-- Header Section -->
                    <div class="text-center">
                        <img src="/images/bunchi-logo.png" alt="Bunchi Logo" class="h-16 mx-auto">
                        <p class="mt-4 text-gray-600">
                            アカウントにログインしてください
                        </p>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                メールアドレス
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required 
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                       value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                パスワード
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" required
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                                    ログイン状態を保持する
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <a class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200" 
                               href="{{ route('register') }}">
                                会員登録
                            </a>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                   class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    パスワードを忘れた方
                                </a>
                            @endif
                        </div>

                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            ログイン
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>