<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerGazettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_gazettes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('registrationNo');
            $table->string('startDate')->nullable();;
            $table->string('endDate')->nullable();
            $table->timestamps();

            /*
            "professionalGazzette": {
                "registrationNo": "14270",
                "startDate": "",
                "endDate": ""
            },
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
        Schema::dropIfExists('practioner_gazettes');
    }
}
