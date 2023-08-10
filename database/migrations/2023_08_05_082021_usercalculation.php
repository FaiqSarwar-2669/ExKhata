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
            $table->foreignId('login_user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('PhoneNumber');
            $table->string('Email')->nullable();
            $table->string('Name')->nullable();
            $table->string('UserTake')->nullable();
            $table->string('UserGive')->nullable();
            $table->string('profile_img')->nullable();
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
