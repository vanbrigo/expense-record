<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname',100);
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->text('avatar_url',500)->nullable();
            $table->enum('role', ['user', 'admin', 'super_admin'])->default('user');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });                                                                                                                                                                                                                                                                                 
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
