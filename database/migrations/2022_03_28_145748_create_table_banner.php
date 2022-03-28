<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->integer('queues')->nullable();
            $table->string('text',50)->nullable();
            $table->string('title',50)->nullable();
            $table->string('description',150)->nullable();
            $table->string('link',250)->nullable();
            $table->string('img',250)->nullable();
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
        Schema::dropIfExists('banner');
    }
}
