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
            $table->string('api_token', 50)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->string('reset_key', 10)->nullable();
            $table->string('provider_name')->nullable()->after('id');
            $table->string('provider_id')->nullable()->after('provider_name');
            $table->string('password')->nullable()->change();
            $table->string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('api_token');
            $table->dropColumn('is_admin');
            $table->dropColumn('reset_key');
            $table->dropColumn('provider_name');
            $table->dropColumn('provider_id');
            $table->dropColumn('avatar');
        });
    }
};
