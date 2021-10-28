<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title',175)->unique();
            $table->string('language',3)->default('en');
            $table->integer('position')->default(1);
            $table->string('content_shoert',175)->nullable();
            $table->text('content')->nullable();
            $table->string('img_thumnail',250)->nullable();
            $table->string('img_banner',250)->nullable();
            $table->string('slug',175);
            $table->string('meta_keyword',175)->nullable();
            $table->string('flag_publish',1)->default('N');
            $table->string('created_by',175);
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
        Schema::dropIfExists('product');
    }
}
