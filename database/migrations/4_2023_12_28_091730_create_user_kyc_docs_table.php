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
    public function up()
    {
        Schema::create('user_kyc_docs', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id')->nullable(true);

            $table->integer('status')->default(Utility::KYC_STATUS['in-active']);
            $table->string('document_type');
            $table->string('image_path')->default('/assets/dashboard/assets/media/avatars/avatar15.jpg');
            $table->unsignedBigInteger('size');
            $table->date('verified_at')->nullable(true);

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('user_kyc_docs');
    }
};
