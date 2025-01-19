<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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

    
}



