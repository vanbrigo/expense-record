<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('category_id');
            $table->string('description',255);
            $table->date('date');
            $table->unsignedBigInteger('pay_method_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('pay_method_id')->references('id')->on('pay_method');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
