<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Team;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    // ログインしていないユーザーがダッシュボードにアクセスできないことを確認するテスト
    public function test_guest_cannot_access_dashboard_page()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    // ログインしているユーザーがダッシュボードにアクセスできることを確認するテスト
    public function test_user_can_access_dashboard_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    // roleがunassignedのユーザーがチーム選択画面にアクセスできることを確認するテスト
    public function test_unassigned_user_can_access_team_select_page()
    {
        $user = User::factory()->create(['role' => 'unassigned']);
        $response = $this->actingAs($user)->get('/team/select');
        $response->assertStatus(200);
    }

    // roleがunassignedのユーザーがダッシュボードにアクセスできないことを確認するテスト
    public function test_unassigned_user_cannot_access_dashboard_page()
    {
        $user = User::factory()->create(['role' => 'unassigned']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect('/team/select');
    }

    // roleがteam_leaderのユーザーがチーム選択画面にアクセスできないことを確認するテスト
    public function test_team_leader_user_cannot_access_team_select_page()
    {
        $user = User::factory()->create(['role' => 'team_leader']);
        $response = $this->actingAs($user)->get('/team/select');
        $response->assertRedirect('/dashboard');
    }

    // roleがmemberのユーザーがチーム選択画面にアクセスできないことを確認するテスト
    public function test_member_user_cannot_access_team_select_page()
    {
        $user = User::factory()->create(['role' => 'member']);
        $response = $this->actingAs($user)->get('/team/select');
        $response->assertRedirect('/dashboard');
    }

    //roleがteam_leaderのユーザーがダッシュボードにアクセスできることを確認するテスト
    public function test_team_leader_user_can_access_dashboard_page()
    {
        $user = User::factory()->create(['role' => 'team_leader']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }


    // roleがmemberのユーザーがダッシュボードにアクセスできることを確認するテスト
    public function test_member_user_can_access_dashboard_page()
    {
        $user = User::factory()->create(['role' => 'member']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    // チーム選択画面でチームを選択した後、ダッシュボードにアクセスできることを確認するテスト
    public function test_user_can_access_dashboard_page_after_selecting_team()
    {
        // 無所属ユーザーを作成
        $user = User::factory()->create(['role' => 'unassigned']);
        
        // 参加先のチームを作成（パスワードとチームコードを明示的に設定）
        $team = Team::factory()->create([
            'password' => 'test-password', // ハッシュ化せずに平文で設定
            'team_code' => 'TEAM123'
        ]);

        // チーム参加フォームにアクセス
        $response = $this->actingAs($user)->get(route('team.join'));
        $response->assertStatus(200);

        // チーム参加リクエストを送信
        $response = $this->actingAs($user)->post(route('team.join.process'), [
            'team_code' => 'TEAM123',
            'password' => 'test-password'
        ]);

        // リダイレクト先とセッションの確認
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        // ユーザーの状態が更新されていることを確認
        $user->refresh();
        $this->assertEquals($team->id, $user->team_id);
        $this->assertEquals('member', $user->role);
    }

    // チーム選択画面でチームを作成した後、ダッシュボードにアクセスできることを確認するテスト
    public function test_user_can_access_dashboard_page_after_creating_team()
    {
        // 無所属ユーザーを作成
        $user = User::factory()->create(['role' => 'unassigned']);

        // チーム作成フォームにアクセス
        $response = $this->actingAs($user)->get(route('team.create'));
        $response->assertStatus(200);

        // チーム作成リクエストを送信
        $response = $this->actingAs($user)->post(route('team.store'), [
            'name' => 'テストチーム',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        // リダイレクト先とセッションの確認
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        // ユーザーの状態が更新されていることを確認
        $user->refresh();
        $this->assertNotNull($user->team_id);
        $this->assertEquals('team_leader', $user->role);

        // 作成されたチームの確認
        $team = $user->team;
        $this->assertEquals('テストチーム', $team->name);

        // ダッシュボードにアクセスできることを確認
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    }



