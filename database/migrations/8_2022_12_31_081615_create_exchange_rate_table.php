<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('exchange_rate', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('added_by');

            $table->string('name');
            $table->string('first');
            $table->string('second');

            $table->unsignedDecimal('rate_first_to_second', 10, 2);
            $table->unsignedDecimal('rate_second_to_first', 10, 2);

            $table->foreign('added_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rate');
    }
};
