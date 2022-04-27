<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('name');
            $table->string('proficiency')->nullable();
            $table->timestamps();

            /*
             "langauge": [
                {
                    "name": "",
                    "proficiency": ""
                },
                {
                    "name": "",
                    "proficiency": ""
                },
                {
                    "name": "",
                    "proficiency": ""
                }
            ]
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
        Schema::dropIfExists('practioner_languages');
    }
}
