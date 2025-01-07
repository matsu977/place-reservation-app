<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('password');  // チーム参加用パスワード（ハッシュ化されて保存）
            $table->string('team_code', 10)->unique();  // チーム固有のコード（例：TEAM001）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('team_code');
        });
    }
};