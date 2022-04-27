<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerCitizenshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_citizenships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('country');
            $table->timestamps();

            /*
            "citizenship": [
                {
                    "country": "Uganda"
                }
            ],
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
        Schema::dropIfExists('practioner_citizenships');
    }
}
