<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      foreach ( range(1,10) as $index ) {
          DB::table('customers')->insert([
             [
               'name' => $faker->name,
               'phone' => $faker->phoneNumber,
               'address' => $faker->address
             ]
          ]);
      }
      $this->command->info('Berhasil menambah customer!');
    }
}
