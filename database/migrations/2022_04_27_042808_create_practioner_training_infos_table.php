<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerTrainingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_training_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('training_provider',100)->nullable();
            $table->string('program',100)->nullable();
            $table->string('dateFrom',12)->nullable();
            $table->string('dateTo',12)->nullable();
            $table->string('trainer',100)->nullable();
            $table->string('sponsor',100)->nullable();
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
        Schema::dropIfExists('practioner_training_infos');
    }
}
