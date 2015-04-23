<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdFieldToPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('posts', function($table)
        {
            $table->integer('user_id')->unsigned()->index()->default('1');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('posts', function($table)
        {
            $table->dropColumn('user_id');
        });
	}

}
