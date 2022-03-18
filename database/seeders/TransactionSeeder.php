<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction')->insert([
            [
                'id'    => 1,
                'trx_id'  => 'a',
                'user_id' => 1,
                'amount'  => 0.01000000,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
            [
                'id'    => 2,
                'trx_id'  => 'B',
                'user_id' => 1,
                'amount'  => 0.02000000,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now()
            ],
        ]);
    }
}
