<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management', function (Blueprint $table) {
            $table->id();
            $table->string('name',175)->unique();
            $table->string('job_title_en',175)->nullable();
            $table->string('job_title_id',175)->nullable();
            $table->integer('queues')->nullable();
            $table->string('quotes_en',250)->nullable();
            $table->string('quotes_id',250)->nullable();
            $table->text('text_en')->nullable();
            $table->text('text_id')->nullable();
            $table->string('img',250)->nullable();
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
        Schema::dropIfExists('management');
    }
}
