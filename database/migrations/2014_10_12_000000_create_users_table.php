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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('name')->unique();
            $table->text('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('password');
            $table->text('location', 16)->nullable();
            $table->text('about_me', 4096)->nullable();
            $table->date('birthday')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 4096)->default('img/BitCritic-Profile-Picture-Default-View-Game-Review-Community.png')->nullable();
            $table->string('banner_photo_path', 4096)->default('img/BitCritic-Banner-Default-View-Game-Review-Community.png')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
