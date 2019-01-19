<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commission');
            $table->string('value')->nullable();
            $table->text('notes')->nullable();
            $table->string('status');
            $table->string('signature');
            $table->unique(['finished_id','employee_id']);
            $table->integer('finished_id')->unsigned();
            $table->foreign('finished_id')->references('id')->on('finished_projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_projects');
    }
}
