<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		Artisan::call('authentication:install');
		$this->call('StateTableSeeder');
		$this->call('TypeDocumentTableSeeder');
		$this->call('TaskTableSeeder');
		$this->call('TemplateTableSeeder');
	}

}
