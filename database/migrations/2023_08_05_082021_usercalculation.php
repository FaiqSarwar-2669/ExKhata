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
        Schema::create('usercalculation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('login-user-id')->constrained('users');
            $table->string('users-id');
            $table->string('user-got')->nullable();
            $table->string('user-give')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usercalculation');
    }
};
