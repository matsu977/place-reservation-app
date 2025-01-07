@extends('layouts.app')

@section('title', 'チーム参加')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">既存チームに参加</h2>
                
                <form action="{{ route('team.join.process') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">チームコード</label>
                            <input type="text" 
                                   name="team_code" 
                                   value="{{ old('team_code') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="例：TEAM001"
                                   required>
                            @error('team_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">パスワード</label>
                            <input type="password" 
                                   name="password"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('team.select') }}" 
                               class="text-sm text-gray-600 hover:text-gray-900">
                                選択画面に戻る
                            </a>
                            <button type="submit" 
                                    class="py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                                チームに参加
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection