<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSustainability extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustainability', function (Blueprint $table) {
            $table->id();
            $table->string('title',175)->unique();
            $table->string('language',3)->default('en');
            $table->integer('position')->default(1);
            $table->text('content')->nullable();
            $table->text('content_shoert')->nullable();
            $table->string('img_thumnail',250)->nullable();
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
        Schema::dropIfExists('sustainability');
    }
}
