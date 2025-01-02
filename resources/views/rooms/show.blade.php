<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $room->name }} - 予約
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- 部屋のレイアウト図 -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">レイアウト</h3>
                        <div class="border p-4" style="width: {{ $room->width * 50 }}px; height: {{ $room->height * 50 }}px; position: relative;">
                            @foreach ($room->storageSpaces as $space)
                                <div class="absolute border {{ $space->is_available ? 'bg-green-100' : 'bg-red-100' }}"
                                     style="left: {{ $space->x * 50 }}px; top: {{ $space->y * 50 }}px; width: {{ $space->width * 50 }}px; height: {{ $space->height * 50 }}px;">
                                    <span class="text-xs">{{ $space->number }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 予約フォーム -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">予約</h3>
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">スペース</label>
                                    <select name="storage_space_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                        @foreach ($room->storageSpaces->where('is_available', true) as $space)
                                            <option value="{{ $space->id }}">{{ $space->number }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">利用開始日</label>
                                    <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">利用終了日</label>
                                    <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">備考</label>
                                    <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"></textarea>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition-colors">
                                    予約する
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>