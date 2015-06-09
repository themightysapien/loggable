<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('system_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loggable_id');
            $table->string('loggable_type');
            $table->string('loggable_route');
            $table->string('log_entry');
            $table->string('log_entry_for');
            $table->string('log_entry_type');
            $table->string('user_id');
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
		Schema::drop('system_logs');
	}

}
