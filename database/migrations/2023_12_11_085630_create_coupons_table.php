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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->enum('discount_type',['precent','value'])->default('precent');
            $table->double('value',8,3);
            $table->enum('status',['active','un-active'])->default('active');
            $table->integer('count_used')->nullable();
            $table->longText('products')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
