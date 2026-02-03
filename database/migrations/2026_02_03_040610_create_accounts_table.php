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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index(); // No constrained() yet if users table might not be used/populated, or just use index for now. constrained() is safer if users table exists.
            $table->string('name');
            $table->string('type'); // checking, savings, credit_card, cash
            $table->decimal('balance', 15, 2)->default(0);
            $table->string('currency_code', 3)->default('USD');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
