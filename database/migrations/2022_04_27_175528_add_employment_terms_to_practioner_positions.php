<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmploymentTermsToPractionerPositions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('practioner_positions', function (Blueprint $table) {
            //
            $table->string('employmentTerms',50)->after('positionStatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practioner_positions', function (Blueprint $table) {
            $table->dropColumn('employmentTerms',50);
        });
    }
}
