<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeadAccount;

class HeadAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeadAccount::create([
            'Head_Ac_Name' => 'Current Assets',
            'RID' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        HeadAccount::create([
            'Head_Ac_Name' => 'Fixed Assets',
            'RID' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        //Liabilities
        HeadAccount::create([
            'Head_Ac_Name' => 'Current Liability',
            'RID' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        HeadAccount::create([
            'Head_Ac_Name' => 'Long Term Liabilities',
            'RID' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        //Capital
        HeadAccount::create([
            'Head_Ac_Name' => 'Shareholders\' Equity',
            'RID' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        HeadAccount::create([
            'Head_Ac_Name' => 'Capital',
            'RID' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        //Revenu income
        HeadAccount::create([
            'Head_Ac_Name' => 'Revenue',
            'RID' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        HeadAccount::create([
            'Head_Ac_Name' => 'Retained Earnings',
            'RID' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        //Expense
        HeadAccount::create([
            'Head_Ac_Name' => 'Operating Expenses',
            'RID' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        HeadAccount::create([
            'Head_Ac_Name' => 'Financial Expenses',
            'RID' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        HeadAccount::create([
            'Head_Ac_Name' => 'Cost Of Revenue',
            'RID' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    }
}
