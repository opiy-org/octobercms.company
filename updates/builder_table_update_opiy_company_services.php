<?php namespace Opiy\Company\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyServices extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_services', function ($table) {
            $table->string('link', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_services', function ($table) {
            $table->dropColumn('link');
        });
    }
}
