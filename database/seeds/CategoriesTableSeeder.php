<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// start with an empty table. We need to temporarily disable the foreign key constraints to delete the articles.
    	Schema::disableForeignKeyConstraints();
    	App\Category::truncate();
    	Schema::enableForeignKeyConstraints();

    	$faker = \Faker\Factory::create();

        // create some categories
    	for($i = 0; $i < 5; $i++) {
    		App\Category::create([
    			'title' => $faker->word
    		]);
    	}
    }
}
