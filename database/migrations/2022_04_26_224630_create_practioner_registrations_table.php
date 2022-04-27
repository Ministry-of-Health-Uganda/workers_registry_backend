<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePractionerRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('professionalCouncil');
            $table->string('dateOfRegistration')->nullable();
            $table->string('registrationNo')->nullable();
            $table->timestamps();
            /*
             "professionalRegistration": {
                "professionalCouncil": "Allied Health Professionals Council",
                "dateOfRegistration": "",
                "registrationNo": "14270"
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
        Schema::dropIfExists('practioner_registrations');
    }
}
