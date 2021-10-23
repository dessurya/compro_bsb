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
            $table->string('img',250)->nullable();
            $table->string('created_by',175);
            $table->string('slug',175);
            $table->string('meta_keyword',175)->nullable();
            $table->string('flag_img',1)->default('N');
            $table->string('flag_publish',1)->default('N');
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
