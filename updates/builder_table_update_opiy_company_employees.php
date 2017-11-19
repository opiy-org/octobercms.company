<?php namespace Opiy\Company\Updates;

use Opiy\Company\Models\Employee;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyEmployees extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_employees', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Employee::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_employees', function ($table) {
            $table->dropColumn('slug');
        });
    }
}