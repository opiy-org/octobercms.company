<?php namespace Opiy\Company\Updates;

use Opiy\Company\Models\Link;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyLinks extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_links', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Link::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_links', function ($table) {
            $table->dropColumn('slug');
        });
    }
}