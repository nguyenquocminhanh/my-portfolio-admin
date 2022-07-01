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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('category_id');
            $table->string('tags')->nullable();
            $table->string('author_name');
            $table->string('author_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('thumbnail_caption')->nullable();
            $table->string('wallpaper_image')->nullable();
            $table->text('content');
            $table->text('description');
            $table->string('duration');
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
        Schema::dropIfExists('blogs');
    }
};
