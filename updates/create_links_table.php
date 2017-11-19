<?php namespace Opiy\Company\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateLinksTable extends Migration
{

    public function up()
    {
        Schema::create('opiy_company_links', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->string('url');
            $table->text('description');
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
        Schema::table('opiy_company_pivots', function ($table) {
            $table->integer('link_id')->unsigned()->nullable()->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opiy_company_links');

        if (Schema::hasColumn('opiy_company_pivots', 'link_id')) {
            Schema::table('opiy_company_pivots', function ($table) {
                $table->dropColumn('link_id');
            });
        }
    }

}
