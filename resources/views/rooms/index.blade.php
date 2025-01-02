<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            部屋一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($rooms as $room)
                            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                <h3 class="text-lg font-semibold mb-2">{{ $room->name }}</h3>
                                <div class="text-sm text-gray-600 mb-4">
                                    <p>広さ: {{ $room->width }}m × {{ $room->height }}m</p>
                                    <p>利用可能スペース: {{ $room->storageSpaces->where('is_available', true)->count() }}</p>
                                </div>
                                <a href="{{ route('rooms.show', $room) }}" 
                                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                                    詳細を見る
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>