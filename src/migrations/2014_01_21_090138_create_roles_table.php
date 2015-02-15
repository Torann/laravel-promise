<?php

use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function($table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('description', 255)->nullable();
            $table->boolean('default')->default(false);
			$table->timestamps();
		});

        DB::table('roles')->insert(array(
            array(
                'name' => \Config::get('promise.super_admin'),
                'description' => 'Super Admin',
                'default'    => false,
                'created_at' => '2014-01-21 09:01:38',
                'updated_at' => '2014-01-21 09:01:38'
            )
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}

}