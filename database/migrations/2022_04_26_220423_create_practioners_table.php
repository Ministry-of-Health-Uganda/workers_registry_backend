<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioners', function (Blueprint $table) {
            $table->id();
            $table->string("surname")->nullable();
            $table->string("firstname")->nullable();
            $table->string("othername")->nullable();
            $table->string("gender")->nullable();
            $table->string("maritalStatus")->nullable();
            $table->string("photo",200)->nullable();
            $table->string("birthDate")->nullable();
            $table->string("countryOfOrigin")->nullable();
            $table->string("district")->nullable();
            $table->string("subCounty")->nullable();
            $table->string("parish")->nullable();
            $table->timestamps();

            /*
            "surname": "Wamulima",
            "firstname": "Titus",
            "othername": null,
            "gender": "MALE",
            "maritalStatus": "Married",
            "photo": "",
            "birthDate": "1985-12-24",
            "countryOfOrigin": "Uganda",
            "district": "MANAFWA",
            "subCounty": "",
            "parish": "",
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practioners');
    }
}
