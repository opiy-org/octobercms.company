<?php namespace Opiy\Company\Updates;

use Opiy\Company\Models\Role;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyRoles extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_roles', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Role::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_roles', function ($table) {
            $table->dropColumn('slug');
        });
    }
}