<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInvestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor', function (Blueprint $table) {
            $table->id();
            $table->string('name',175);
            $table->string('img',250)->nullable();
            $table->text('content_id')->nullable();
            $table->text('content_en')->nullable();
            $table->string('flag_publish',1)->default('N');
            $table->string('created_by',250)->nullable();
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
        Schema::dropIfExists('investor');
    }
}
