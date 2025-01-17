<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    // チーム選択画面の表示
    public function selectForm()
    {
        return view('team.select');
    }

    // チーム作成フォームの表示
    public function createForm()
    {
        return view('team.create');
    }

    // チーム参加フォームの表示
    public function joinForm()
    {
        return view('team.join');
    }

    // チーム作成処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $team = Team::create([
            'name' => $validated['name'],
            'password' => $validated['password'],
            'team_code' => $this->generateTeamCode(),
        ]);

        // 作成者をチームに所属させる
        auth()->user()->update(['team_id' => $team->id]);

        return redirect()
            ->route('dashboard')
            ->with('success', "チーム「{$team->name}」を作成しました。チームコードは「{$team->team_code}」です。");
    }

    // チーム参加処理
    public function join(Request $request)
    {
        $validated = $request->validate([
            'team_code' => 'required|string|exists:teams,team_code',
            'password' => 'required|string',
        ]);

        $team = Team::where('team_code', $validated['team_code'])->first();

        if (!$team || $validated['password'] !== $team->password) {
            return back()
                ->withErrors(['team_code' => 'チームコードまたはパスワードが正しくありません'])
                ->withInput();
        }

        auth()->user()->update(['team_id' => $team->id]);

        return redirect()
            ->route('dashboard')
            ->with('success', "チーム「{$team->name}」に参加しました");
    }

    // ユニークなチームコードの生成
    private function generateTeamCode()
    {
        $maxAttempts = 10;
        $attempt = 0;

        do {
            $code = 'TEAM' . str_pad(random_int(1, 999), 3, '0', STR_PAD_LEFT);
            $attempt++;

            if ($attempt >= $maxAttempts) {
                throw new \RuntimeException('利用可能なチームコードを生成できませんでした');
            }
        } while (Team::where('team_code', $code)->exists());

        return $code;
    }

    // チーム情報の表示（オプション）
    public function show()
    {
        $team = auth()->user()->team;
        $isTeamLeader = auth()->user()->role === 'team_leader';
        
        return view('team.show', compact('team', 'isTeamLeader'));
    }

    // チームからの離脱処理（オプション）
    public function leave()
    {
        $user = auth()->user();
        $teamName = $user->team->name;

        $user->update(['team_id' => null]);

        return redirect()
            ->route('team.select')
            ->with('success', "チーム「{$teamName}」から離脱しました");
    }
}
