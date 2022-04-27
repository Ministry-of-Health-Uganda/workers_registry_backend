<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('nin',14)->nullable();
            $table->string('cardNo',14)->nullable();
            $table->string('passportNo',14)->nullable();
            $table->string('passportExpiryDate',14)->nullable();
            $table->string('driverLicenseNo',20)->nullable();
            $table->string('driverExpiryDate',14)->nullable();
            $table->string('employeeIPPS')->nullable();
            $table->timestamps();
        });
        /*"identity": {
                "HWID": "",
                 "nin": "CM850671013XYK",
                 "cardNo": "",
                 "expiryDate": "",
                 "passportNo": "",
                 "expiryDate": "",
                "driverLicense": "",
                "driverExpiryDate": "",
                "employeeIPPS": ""
            }*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practioner_identities');
    }
}
