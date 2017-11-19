<?php namespace Opiy\Company\Updates;

use Opiy\Company\Models\Project;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyProjects extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_projects', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Project::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_projects', function ($table) {
            $table->dropColumn('slug');
        });
    }
}