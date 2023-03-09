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
    public function up()
    {
        Schema::create('commission_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('affiliate_id');
            $table->integer('user_id');
            $table->double('recharge_amount');
            $table->double('commission_amount');
            $table->double('recharge_id');
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
        Schema::dropIfExists('commission_histories');
    }
};
