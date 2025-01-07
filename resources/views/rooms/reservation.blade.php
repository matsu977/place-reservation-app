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

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative border rounded overflow-auto">
        <div style="width: {{ $room->width * 40 }}px; height: {{ $room->height * 40 }}px;">
            <!-- グリッド線 -->
            <div class="absolute inset-0" style="
                display: grid;
                grid-template-columns: repeat({{ $room->width }}, 40px);
                grid-template-rows: repeat({{ $room->height }}, 40px);
            ">
                @for ($i = 0; $i < ($room->width * $room->height); $i++)
                    <div class="border border-gray-100"></div>
                @endfor
            </div>

            <!-- 荷物置き場 -->
            @foreach($storageSpaces as $space)
                <div class="absolute border-2 rounded 
                    @if($space['hasActiveReservation']) 
                        bg-red-200 border-red-500 
                    @else 
                        bg-blue-200 border-blue-500 
                    @endif"
                    style="
                        left: {{ $space['x'] * 40 }}px; 
                        top: {{ $space['y'] * 40 }}px;
                        width: {{ $space['width'] * 40 }}px;
                        height: {{ $space['height'] * 40 }}px;
                    "
                    >   
                    <div class="p-2">
                        <p class="text-sm">{{ $space['number'] }}</p>
                        <p class="text-xs">{{ $space['width'] }}m × {{ $space['height'] }}m</p>
                        @if($space['hasActiveReservation'])
                            <form action="{{ route('reservations.cancel', $space['id']) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-xs bg-red-500 text-white px-2 py-1 rounded"
                                        onclick="return confirm('予約をキャンセルしてもよろしいですか？')">
                                    予約キャンセル
                                </button>
                            </form>
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
</div>

<!-- 予約モーダル -->
<div id="reservationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h2 class="text-xl mb-4">荷物置き場の予約</h2>
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="storage_space_id" id="storage_space_id">
                
                <div class="mb-4">
                    <p class="text-gray-600 mb-2">スペース番号: <span id="space_number"></span></p>
                </div>

                <div class="mb-4">
                    <label class="block mb-2">利用開始日</label>
                    <input type="date" 
                           name="start_date" 
                           required 
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           class="w-full border rounded px-2 py-1">
                </div>

                <div class="mb-4">
                    <label class="block mb-2">備考</label>
                    <textarea name="notes" 
                              class="w-full border rounded px-2 py-1"
                              rows="3"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" 
                            onclick="closeModal()" 
                            class="px-4 py-2 bg-gray-500 text-white rounded">
                        キャンセル
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded">
                        予約する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openReservationModal(spaceId, spaceNumber) {
    document.getElementById('storage_space_id').value = spaceId;
    document.getElementById('space_number').textContent = spaceNumber;
    document.getElementById('reservationModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('reservationModal').classList.add('hidden');
}
</script>
@endsection