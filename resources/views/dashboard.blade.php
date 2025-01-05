@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            @if(auth()->user()->role === 'team_leader')
                <a href="{{ route('rooms.create') }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    新しい部屋を登録
                </a>
            @endif
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl mb-4">部屋一覧</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($rooms as $room)
                        <a href="{{ route('rooms.reservation', $room) }}" 
                           class="block p-6 border rounded-lg hover:bg-gray-50 transition-colors">
                            <h3 class="text-xl font-semibold mb-2">{{ $room->name }}</h3>
                            <div class="text-gray-600">
                                <p>サイズ: {{ $room->width }}m × {{ $room->height }}m</p>
                                <p>荷物置き場: {{ $room->storageSpaces->count() }}個</p>
                            </div>
                            <div class="mt-4 text-blue-500 flex items-center">
                                予約画面を開く
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection