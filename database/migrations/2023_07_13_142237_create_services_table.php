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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('image')->nullable();
            $table->foreign('image')->references('id')->on('images')->onDelete('set null');
            $table->boolean('whatsapStatus')->default(0);
            $table->string('whatsapNumber')->nullable();
            $table->boolean('loginStatus')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('slug');
            $table->unsignedBigInteger('main_category_id')->nullable();
            $table->foreign('main_category_id')->references('id')->on('categories')->onDelete('set null');
            $table->unsignedBigInteger('child_category_id')->nullable();
            $table->foreign('child_category_id')->references('id')->on('categories')->onDelete('set null');
            $table->unsignedBigInteger('application_id')->nullable();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('set null');
            $table->enum('status',['active','unactive'])->default('active')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
