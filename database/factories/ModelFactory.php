<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//        'email' => $faker->safeEmail,
//        'password' => bcrypt(str_random(10)),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(\App\Account::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->word,
        'working_capital'   => $faker->randomFloat(2),
    ];
});

$factory->define(\App\Company::class, function (\Faker\Generator $faker) {
   return [
       'name'   => $faker->company,
   ];
});

$factory->define(\App\Transaction::class, function(\Faker\Generator $faker) {
    return [
        'transaction_date'   => $faker->dateTimeBetween('-1 years')->format('Y-m-d'),
        'payment_date'       => $faker->dateTimeBetween('-1 years', '+2 months')->format('Y-m-d'),
        'company_id'         => rand(1, 15),
        'category_id'        => rand(1, 51),
        'account_id'         => rand(1, 3),
        'is_expense'         => $faker->boolean(),
        'amount'             => $faker->randomFloat(2, 0, 10000),
    ];
});