<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('primary',100)->nullable();
            $table->string('lower_secondary',100)->nullable();
            $table->string('upper_secondary',100)->nullable();
            $table->string('tertiary',100)->nullable();
            $table->string('other',100)->nullable();
            $table->string('speciality',100)->nullable();
            $table->timestamps();

            /*
             "education": {
                "primary": "",
                "secondary": {
                    "upper": "",
                    "ordinary": ""
                },
                "tertiary": "",
                "other": "",
                "speciality": ""
            },*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practioner_education');
    }
}
