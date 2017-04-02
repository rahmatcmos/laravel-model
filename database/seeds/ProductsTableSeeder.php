<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
         [
           'name' => "Toyota Alphard",
           'price' => 150000000,
           'stock' => 4,
         ],

         [
            'name' => "Toyota Avanza",
            'price' => 350000,
            'stock' => 8,
         ]
     ]);
     
     $this->command->info('Berhasil menambah 2 mobil!');
    }
}
