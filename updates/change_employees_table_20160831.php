<?php namespace Opiy\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class ChangeEmployeesTable20160831 extends Migration
{

    public function up()
    {
        Schema::table('opiy_company_employees', function ($table) {
            $table->text('social_media')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_employees', function ($table) {
            $table->text('social_media')->change();
        });
    }
}
