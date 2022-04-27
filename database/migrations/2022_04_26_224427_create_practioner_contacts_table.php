<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('phone1',12)->nullable();
            $table->string('phone2',12)->nullable();
            $table->string('email1',50)->nullable();
            $table->string('email2',50)->nullable();
            $table->string('emergencyContactName',50)->nullable();
            $table->string('emergencyContactNamephone',12)->nullable();
            $table->string('mobileMoneyName',50)->nullable();
            $table->string('mobileMoneyPhone',12)->nullable();
            $table->boolean('kycVerified')->nullable();
            $table->timestamps();

            /*
            "contact": {
                "phone1": null,
                "phone2": null,
                "phone3": "",
                "email1": null,
                "email2": "",
                "emergencyContact": {
                    "name": "",
                    "phone": ""
                },
                "mobileMoney": {
                    "name": "",
                    "phone": "",
                    "kycVerified": ""
                }
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
        Schema::dropIfExists('practioner_contacts');
    }
}
