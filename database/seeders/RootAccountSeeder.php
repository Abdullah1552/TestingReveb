<?php

namespace Database\Seeders;
use App\Models\RootAccount;

use Illuminate\Database\Seeder;

class RootAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RootAccount::create([
            'code' => 01,
            'acc_name' => 'Asset',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        RootAccount::create([
            'code' => 02,
            'acc_name' => 'Liability',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        RootAccount::create([
            'code' => 03,
            'acc_name' => 'Owner Equity',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        RootAccount::create([
            'code' => 04,
            'acc_name' => 'Income',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        RootAccount::create([
            'code' => 05,
            'acc_name' => 'Expense',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
