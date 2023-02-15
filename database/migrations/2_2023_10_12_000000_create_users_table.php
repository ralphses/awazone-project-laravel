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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_ability_id')->default(1);

            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->nullable(true)->unique();
            $table->date('date_of_birth')->nullable(true);
            $table->string('referral_code')->nullable(true);
            $table->string('referer_user')->nullable(true);
            $table->string('password');
            $table->string('image_path')->default('/assets/dashboard/assets/media/avatars/avatar15.jpg');
            $table->string('main_currency')->default(Utility::AIBOPAY_ACCOUNT_CURRENCY['ngn']);

            $table->boolean('is_locked')->default(true);

            $table->foreign('user_ability_id')->references('id')->on('user_abilities')->onDelete('cascade');

            $table->rememberToken();

            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
