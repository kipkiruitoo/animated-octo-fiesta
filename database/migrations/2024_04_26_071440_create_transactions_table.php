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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->tinyInteger('status');
            $table->foreignUuid('investment_id')->references('uuid')->on('investments');
            $table->foreignId('payer_id')->references('id')->on('users');
            $table->foreignId('payee_id')->references('id')->on('users');
            $table->integer('amount');
            $table->boolean('payer_confirmed');
            $table->boolean('payee_confirmed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
