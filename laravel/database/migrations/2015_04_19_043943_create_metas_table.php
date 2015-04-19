<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('metas', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('title',160);
            $table->text('description');
            $table->text('twitter_card');
            $table->string('og_title',160);
            $table->string('og_image',200);
            $table->text('og_description');
            $table->integer('post_id')->unsigned()->index();

			$table->timestamps();


            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('metas');
	}

}
