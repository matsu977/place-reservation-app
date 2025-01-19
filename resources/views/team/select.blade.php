@extends('layouts.app')

@section('title', '')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">チーム選択</h2>
                <div class="space-y-4">
                    <a href="{{ route('team.create') }}" 
                       class="block w-full py-2 px-4 text-center bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                        新しいチームを作成
                    </a>
                    <a href="{{ route('team.join') }}" 
                       class="block w-full py-2 px-4 text-center border border-gray-300 hover:bg-gray-50 rounded-md">
                        既存のチームに参加
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection