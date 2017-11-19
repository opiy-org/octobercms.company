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
            $table->string('type')->default('string');
            $table->string('default_value')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opiy_company_properties');
    }

}
