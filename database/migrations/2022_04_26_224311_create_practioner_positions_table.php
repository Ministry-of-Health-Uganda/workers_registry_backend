<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractionerPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practioner_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practioner_id');
            $table->string('position',100)->nullable();
            $table->string('startDate',10)->nullable();
            $table->string('endDate',10)->nullable();
            $table->string('dateOfFirst',10)->nullable();
            $table->string('positionStatus',10)->nullable();
            $table->string('cadre',10)->nullable();
            $table->string('workingHours',10)->nullable();
            $table->string('facilityType',50)->nullable();
            $table->string('instituteCategory',50)->nullable();
            $table->string('instituteType',50)->nullable();
            $table->string('district',50)->nullable();
            $table->string('subCounty',50)->nullable();
            $table->string('dhis2Id',30)->nullable();
            $table->string('ihrisId',30)->nullable();
            $table->string('facilityRegId',30)->nullable();
            $table->string('facilityName',100)->nullable();
            $table->timestamps();

            /*
             "position": "Senior Medical Clinical Officer",
                    "startDate": "2021-03-25",
                    "endDate": "",
                    "dateOfFirst": "2021-03-24",
                    "positionStatus": "Active",
                    "facility": {
                        "facilityType": "",
                        "instituteCategory": "",
                        "instituteType": "District",
                        "district": "",
                        "subCounty": "",
                        "dhis2Id": "",
                        "ihrisId": "",
                        "facilityRegId": "",
                        "facilityName": "BUBULO Health Centre IV"
                    },
                    "cadre": "Allied Health Professionals",
                    "workingHours": ""
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
        Schema::dropIfExists('practioner_positions');
    }
}
