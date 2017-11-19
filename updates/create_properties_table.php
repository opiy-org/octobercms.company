<?php namespace Opiy\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreatePropertiesTable extends Migration
{

    public function up()
    {
        Schema::create('opiy_company_properties', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->integer('project_id')->unsigned();
            $table->string('value')->nullable();
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();

            $table->foreign('project_id')
                ->references('id')
                ->on('opiy_company_projects');

        });
    }

    public function down()
    {
        Schema::dropIfExists('opiy_company_properties');
    }

}
