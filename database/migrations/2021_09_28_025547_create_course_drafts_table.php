<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_drafts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('type')->nullable();
            $table->string('language')->nullable();
            $table->string('level')->nullable();
            $table->string('category')->nullable();
            $table->string('subcategory')->nullable();
            $table->longText('description')->nullable();
            $table->longText('requirement')->nullable();
            $table->longText('target')->nullable();
            $table->longText('outcome')->nullable();
            $table->longText('course_image')->nullable();
            $table->longText('promotional_video')->nullable();
            $table->integer('price')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('course_drafts');
    }
}
