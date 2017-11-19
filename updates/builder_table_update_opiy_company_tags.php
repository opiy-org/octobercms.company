<?php namespace Opiy\Company\Updates;

use Opiy\Company\Models\Tag;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOpiyCompanyTags extends Migration
{
    public function up()
    {
        Schema::table('opiy_company_tags', function ($table) {
            $table->string('slug')->index();
        });

        // Fill slug attributes
        Tag::all()->each(function ($model) {
            $model->slugAttributes();
            $model->save();
        });
    }

    public function down()
    {
        Schema::table('opiy_company_tags', function ($table) {
            $table->dropColumn('slug');
        });
    }
}