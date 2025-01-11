<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 p-8 space-y-8">
                    <!-- Header Section -->
                    <div class="text-center">
                        <img src="/images/bunchi-logo.png" alt="Bunchi Logo" class="h-16 mx-auto">
                        <p class="mt-4 text-gray-600">
                            セキュリティ保護のため、続行する前にパスワードを確認してください
                        </p>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                パスワード
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" required
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                       autocomplete="current-password">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            確認
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>