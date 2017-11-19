<?php namespace Opiy\Company\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreatePropertiesValuesTable extends Migration
{

    public function up()
    {
        Schema::create('opiy_company_properties_values', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->string('value')->nullable();
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();

            $table->unique(['project_id', 'property_id']);

            $table->foreign('property_id')
                ->references('id')
                ->on('opiy_company_properties');

            $table->foreign('project_id')
                ->references('id')
                ->on('opiy_company_projects');


        });
    }

    public function down()
    {
        Schema::dropIfExists('opiy_company_properties_values');
    }

}
