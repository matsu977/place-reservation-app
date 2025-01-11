<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\StorageSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'team_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'width' => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
            'storage_spaces' => 'required|array',
            'storage_spaces.*.number' => 'required|string|max:50',
            'storage_spaces.*.x' => 'required|integer|min:0',
            'storage_spaces.*.y' => 'required|integer|min:0',
            'storage_spaces.*.width' => 'required|integer|min:1',
            'storage_spaces.*.height' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        // リクエストデータをログに出力
        \Log::info('Room creation request:', $request->all());

        $room = Room::create([
            'team_id' => $validated['team_id'],
            'name' => $validated['name'],
            'width' => $validated['width'],
            'height' => $validated['height'],
        ]);

        \Log::info('Room created:', $room->toArray());

        foreach ($validated['storage_spaces'] as $space) {
            $storageSpace = StorageSpace::create([
                'room_id' => $room->id,
                'number' => $space['number'],
                'x' => $space['x'],
                'y' => $space['y'],
                'width' => $space['width'],
                'height' => $space['height'],
            ]);
            \Log::info('Storage space created:', $storageSpace->toArray());
        }

        DB::commit();
        return response()->json(['message' => '保存が完了しました', 'room' => $room], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        \Log::error('Validation error:', [
            'errors' => $e->errors(),
            'request' => $request->all()
        ]);
        return response()->json(['message' => '入力内容に誤りがあります', 'errors' => $e->errors()], 422);

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error in room creation:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->all()
        ]);
        return response()->json(['message' => 'エラーが発生しました：' . $e->getMessage()], 500);
    }
}

    public function destroy(Room $room)
    {
        try {
            $room->delete();
            return redirect()->route('dashboard')->with('success', '部屋を削除しました');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', '部屋の削除に失敗しました');
        }
    }
        
}