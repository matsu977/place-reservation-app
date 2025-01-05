@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl">{{ $room->name }} - 荷物置き場予約</h1>
        <a href="{{ route('dashboard') }}" 
           class="text-blue-500 hover:text-blue-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            部屋一覧に戻る
        </a>
    </div>
    
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="relative border rounded" style="width: {{ $room->width * 40 }}px; height: {{ $room->height * 40 }}px;">
        <!-- グリッドと荷物置き場の表示部分は前回のコードと同じ -->
        @foreach($storageSpaces as $space)
            <div class="absolute border-2 rounded 
                     @if($space['hasActiveReservation']) 
                         bg-red-200 border-red-500 
                     @else 
                         bg-blue-200 border-blue-500 
                     @endif"
                 style="left: {{ $space['x'] * 40 }}px; 
                        top: {{ $space['y'] * 40 }}px;
                        width: {{ $space['width'] * 40 }}px;
                        height: {{ $space['height'] * 40 }}px;">
                <div class="p-2">
                    <p class="text-sm">{{ $space['number'] }}</p>
                    <p class="text-xs">{{ $space['width'] }}m × {{ $space['height'] }}m</p>
                    @if($space['hasActiveReservation'])
                        <p class="text-xs text-red-700">予約済み</p>
                    @else
                        <button onclick="openReservationModal({{ $space['id'] }}, '{{ $space['number'] }}')" 
                                class="text-xs bg-blue-500 text-white px-2 py-1 rounded">
                            予約する
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- 凡例 -->
    <div class="flex gap-4 mt-4">
        <div class="flex items-center">
            <div class="w-4 h-4 bg-blue-200 border-2 border-blue-500 mr-2"></div>
            <span class="text-sm">予約可能</span>
        </div>
        <div class="flex items-center">
            <div class="w-4 h-4 bg-red-200 border-2 border-red-500 mr-2"></div>
            <span class="text-sm">予約済み</span>
        </div>
    </div>

    <!-- 予約モーダルは前回のコードと同じ -->
</div>

<!-- モーダルのスクリプトは前回のコードと同じ -->
@endsection