<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('blog_category_id');
            $table->char('title', 255);
            $table->char('title_short', 255);
            $table->text('description', 255)->nullable();
            $table->char('slug', 255)->nullable();
            $table->char('image', 255)->nullable();
            $table->text('content')->nullable();
            $table->char('status', 11);
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
        Schema::dropIfExists('blog');
    }
}
