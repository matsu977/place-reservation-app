<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 p-8 space-y-8">
                    <!-- Header Section -->
                    <div class="text-center">
                        <img src="/images/bunchi-logo.png" alt="Bunchi Logo" class="h-16 mx-auto">
                        <p class="mt-4 text-gray-600">
                            ご登録ありがとうございます。始める前に、メールアドレスの確認をお願いします。確認メールに記載されているリンクをクリックしてください。メールが届いていない場合は、再送信が可能です。
                        </p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="bg-green-50 text-green-600 p-4 rounded-lg text-sm">
                            ご登録時のメールアドレスに新しい確認リンクを送信しました。
                        </div>
                    @endif

                    <div class="space-y-4">
                        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                確認メールを再送信
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                ログアウト
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>