<?php namespace Opiy\Company\Updates;

use Opiy\Company\Models\Gallery;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyGalleries extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_galleries', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Gallery::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_galleries', function ($table) {
            $table->dropColumn('slug');
        });
    }
}