<?php namespace Opiy\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('opiy_company_projects', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('style')->nullable();

            $table->string('storeys')->nullable();
            $table->tinyint('storeys_total')->unsigned()->default(1);

            $table->string('mansard')->nullable();
            $table->string('basement')->nullable();
            $table->string('garage')->nullable();
            $table->string('pool')->nullable();
            $table->string('sauna')->nullable();
            $table->string('special_zones')->nullable();
            $table->string('bearing_walls')->nullable();
            $table->string('fasade')->nullable();
            $table->string('roof_type')->nullable();

            $table->text('add_info')->nullable();

            $table->smallint('total_area')->unsigned();
            $table->smallint('price')->unsigned();


            $table->string('url');
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opiy_company_projects');
    }

}
