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
            $table->string('identification')->unique()->after('name');
            $table->string('phone')->after('identification');
            $table->string('role')->default('user')->after('phone');
            $table->boolean('status')->default(true)->after('role');
            $table->string('username')->unique()->after('status');
            // El campo password ya existe por defecto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'identification',
                'phone',
                'role',
                'status',
                'username'
            ]);
        });
    }
};
