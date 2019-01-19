<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->float('actual_value');
            $table->float('value');
            $table->string('expected_date');
            $table->string('status');
            $table->string('signature');
            $table->text('notes')->nullable();;
            $table->integer('account_from_id')->unsigned();
            $table->foreign('account_from_id')->references('id')->on('accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('account_to_id')->unsigned();
            $table->foreign('account_to_id')->references('id')->on('accounts')
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
        Schema::dropIfExists('money_transfers');
    }
}
