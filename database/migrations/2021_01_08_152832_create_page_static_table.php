<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageStaticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_static', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->char('title', 255);
            $table->char('slug', 255)->nullable();
            $table->char('image', 255)->nullable();
            $table->char('position_image', 10)->comment('1-banner image, 2-background')->nullable();
            $table->longText('content')->nullable();
            $table->char('status', 5)->comment('1-Hiển thị, 2-Ẩn');
            $table->dateTime('published_start')->nullable();
            $table->dateTime('published_end')->nullable();
            $table->text('seo_title', 255)->nullable();
            $table->text('seo_description', 255)->nullable();
            $table->text('seo_link', 255)->nullable();
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
        Schema::dropIfExists('page_static');
    }
}
