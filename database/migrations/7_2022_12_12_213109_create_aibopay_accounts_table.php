<?php

use App\Models\Utility;
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
        Schema::create('aibopay_accounts', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('accountName');
            $table->string('accountNumber')->unique();
            $table->string('accountType');
            $table->string('currency')->default(Utility::AIBOPAY_ACCOUNT_CURRENCY['ngn']);
            $table->string('status')->default(Utility::AIBOPAY_ACCOUNT_STATUS['active']);

            $table->unsignedDecimal('balance', 14, 2)->default(0.0);

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aibopay_accounts');
    }
};
