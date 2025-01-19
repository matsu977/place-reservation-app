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
        Schema::table('users', function (Blueprint $table) {
            // チームIDはteamsテーブルが必要なので、一時的にnullableにしておきます
            $table->foreignId('team_id')->nullable()->after('id');
            $table->string('phone', 20)->nullable()->after('password');
            $table->enum('role', ['team_leader', 'member', 'unassigned'])->default('unassigned')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('team_id');
            $table->dropColumn('phone');
            $table->dropColumn('role');
        });
    }
};