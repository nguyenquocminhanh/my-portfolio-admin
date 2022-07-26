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
            $table->string('title');
            $table->string('sub_title');
            $table->integer('category_id');
            $table->string('technologies')->nullable();
            $table->string('client')->nullable();
            $table->string('date')->nullable();
            $table->string('location')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('thumbnail_caption')->nullable();
            $table->string('wallpaper_image')->nullable();
            $table->string('design_image')->nullable();
            $table->string('db_image')->nullable();
            $table->string('demo_video')->nullable();
            $table->text('content');
            $table->string('project_link')->nullable();
            $table->string('frontend_link')->nullable();
            $table->string('backend_link')->nullable();
            $table->string('share_count')->default('0');
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
        Schema::dropIfExists('projects');
    }
};
