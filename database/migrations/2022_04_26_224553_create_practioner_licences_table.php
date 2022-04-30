<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_licences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('professionalCouncil')->nullable();
            $table->string('dateOfIssue')->nullable();
            $table->string('dateOfExpiry')->nullable();
            $table->string('attachment')->nullable();
            $table->string('licenseNo')->nullable();
            $table->timestamps();

            /*
            "professionalLicense": {
                "professionalCouncil": "Allied Health Professionals Council",
                "dateOfIssue": "",
                "dateOfExpiry": "",
                "attachment": "",
                "licenseNo": null
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
        Schema::dropIfExists('practioner_licences');
    }
}
