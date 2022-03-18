<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'    => 1,
                'name'  => 'Iqbal',
                'email' => 'iqbal@gmail.com',
                'password'  => bcrypt(12345678),
                'remember_token'    => NULL,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'    => 2,
                'name'  => 'Nugraha',
                'email' => 'nugraha@gmail.com',
                'password'  => bcrypt(12345678),
                'remember_token'    => NULL,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'    => 3,
                'name'  => 'Ilham',
                'email' => 'ilham@gmail.com',
                'password'  => bcrypt(12345678),
                'remember_token'    => NULL,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'    => 4,
                'name'  => 'Rama',
                'email' => 'rama@gmail.com',
                'password'  => bcrypt(12345678),
                'remember_token'    => NULL,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
        ]);
    }
}
