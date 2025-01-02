<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ダッシュボード
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 自分の予約 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">現在の予約</h3>
                    @if($activeReservations->count() > 0)
                        <div class="space-y-4">
                            @foreach($activeReservations as $reservation)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900">
                                                {{ $reservation->storageSpace->room->name }}
                                            </h4>
                                            <p class="text-sm text-gray-500">
                                                スペース: {{ $reservation->storageSpace->number }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                期間: {{ $reservation->start_date }} 〜 {{ $reservation->end_date }}
                                            </p>
                                        </div>
                                        <form action="{{ route('reservations.cancel', $reservation) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                予約をキャンセル
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">現在の予約はありません。</p>
                    @endif
                </div>
            </div>

            <!-- 利用可能な部屋 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">利用可能な部屋</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($availableRooms as $room)
                            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                <h4 class="text-lg font-medium text-gray-900">{{ $room->name }}</h4>
                                <p class="text-sm text-gray-500 mb-4">
                                    利用可能スペース: {{ $room->available_spaces_count }}
                                </p>
                                <a href="{{ route('rooms.show', $room) }}" 
                                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded text-sm hover:bg-blue-600 transition-colors">
                                    予約する
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>