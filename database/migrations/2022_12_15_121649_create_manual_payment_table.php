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
        Schema::create('manual_payment', function (Blueprint $table) {
            $table->id();

            $table->string('reference');
            $table->string('description');
            $table->string('customerEmail');
            $table->string('status');
            $table->string('imageUrl');

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
        Schema::dropIfExists('manual_payment');
    }
};
