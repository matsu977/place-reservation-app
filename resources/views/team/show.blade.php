@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">チーム情報</h1>
            <a href="{{ route('mypage') }}" 
                class="text-blue-500 hover:text-blue-600 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                戻る
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="space-y-6">
                <!-- チーム名 -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500">チーム名</h3>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $team->name }}</p>
                </div>

                <!-- チームコード -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500">チームコード</h3>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $team->team_code }}</p>
                </div>

                <!-- チームパスワード (チームリーダーのみ表示) -->
                @if($isTeamLeader)
                <div>
                    <h3 class="text-sm font-medium text-gray-500">チーム参加用パスワード</h3>
                    <div class="mt-1 flex items-center">
                        <p class="text-lg font-semibold text-gray-900">{{ $team->password }}</p>
                        <button type="button" class="ml-2 text-sm text-blue-500 hover:text-blue-600"
                            onclick="copyToClipboard('{{ $team->password }}')">
                            コピー
                        </button>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">※このパスワードは新しいメンバーがチームに参加する際に必要です</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($isTeamLeader)
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('パスワードをコピーしました');
    }).catch(err => {
        console.error('コピーに失敗しました:', err);
    });
}
</script>
@endif
@endsection