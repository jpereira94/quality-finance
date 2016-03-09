<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //adds the category lists
        $this->call(CategorySeeder::class);

        //adds 15 companies (entidades) for testing
        factory(\App\Company::class, 15)->create();

        //adds 3 accounts for testing
        factory(\App\Account::class, 3)->create();

        //adds 50 transactions for testing
        factory(\App\Transaction::class, 30)->create();
    }
}
