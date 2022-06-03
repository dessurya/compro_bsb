<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNewsInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_info', function (Blueprint $table) {
            $table->id();
            $table->string('title',175)->unique();
            $table->date('publish_date')->comment('publish date or estimate publish date')->nullable();
            $table->string('language',3)->default('en');
            $table->text('content')->nullable();
            $table->string('meta_title',250)->nullable();
            $table->string('meta_keyword',250)->nullable();
            $table->string('meta_description',250)->nullable();
            $table->string('img_banner',250)->nullable();
            $table->string('img_thumbnail',250)->nullable();
            $table->string('slug',175);
            $table->string('flag_img_banner',1)->default('N');
            $table->string('flag_img_thumbnail',1)->default('N');
            $table->string('flag_publish',1)->default('N');
            $table->string('created_by',175)->nullable();
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
        Schema::dropIfExists('news_info');
    }
}
