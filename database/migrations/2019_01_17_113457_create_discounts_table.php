<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->text('notes')->nullable();
            $table->string('signature');
            $table->integer('project_id')->unique()->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts')
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
        Schema::dropIfExists('discounts');
    }
}
