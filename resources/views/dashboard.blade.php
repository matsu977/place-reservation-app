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
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-semibold mb-2">{{ $room->name }}</h3>
                                @if(auth()->user()->role === 'team_leader')
                                    <form action="{{ route('rooms.destroy', $room) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('この部屋を削除してもよろしいですか？\n※予約情報も全て削除されます')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" 
                                                      stroke-linejoin="round" 
                                                      stroke-width="2" 
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="text-gray-600">
                                <p>サイズ: {{ $room->width }}m × {{ $room->height }}m</p>
                                <p>荷物置き場: {{ $room->storageSpaces->count() }}個</p>
                            </div>
                            <a href="{{ route('rooms.reservation', $room) }}" 
                               class="mt-4 text-blue-500 flex items-center hover:text-blue-700 transition-colors">
                                予約画面を開く
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection