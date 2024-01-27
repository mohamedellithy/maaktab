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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('short_description');
            $table->longText('description');
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->foreign('thumbnail_id')->references('id')->on('images')->onDelete('set null');
            $table->string('status')->default('active');
            $table->text('slug');
            $table->double('price',2)->default(0);
            $table->string('attachments_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('main_category_id')->nullable();
            $table->foreign('main_category_id')->references('id')->on('categories')->onDelete('set null');
            $table->unsignedBigInteger('child_category_id')->nullable();
            $table->foreign('child_category_id')->references('id')->on('categories')->onDelete('set null');
            $table->unsignedBigInteger('application_id')->nullable();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('set null');
            $table->date('from');
            $table->date('to');
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
        Schema::dropIfExists('products');
    }
};
