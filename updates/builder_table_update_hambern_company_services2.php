<?php namespace Opiy\Company\Updates;

use Opiy\Company\Models\Service;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyServices2 extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_services', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Service::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_services', function ($table) {
            $table->dropColumn('slug');
        });
    }
}