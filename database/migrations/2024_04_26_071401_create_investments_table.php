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
        Schema::create('investments', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->foreignId('investor')->references('id')->on('users');
            $table->tinyInteger('status');
            $table->timestamp('invested_on');
            $table->timestamp('matures_on');
            $table->integer('amount');
            $table->integer('return_percentage');
            $table->integer('return_amount');
            $table->integer('payout_balance');
            $table->integer('paying_balance');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
