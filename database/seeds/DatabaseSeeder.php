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
        // $this->call(UsersTableSeeder::class);
        $this->call('ProductsTableSeeder');
        $this->call('MembershipTypesTableSeeder');
        $this->call('CustomersTableSeeder');
        $this->call('PostsTableSeeder');
    }
}
