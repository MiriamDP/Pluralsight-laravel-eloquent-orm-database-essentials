<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_codes')->insert([
            'name'=>'Client 1 - Consulting',
            'billing_code'=>'C10001',
            'created_at'=>date('Y/m/d H:i:s'),
            'updated_at'=>date('Y/m/d H:i:s'),
        ]);   
        DB::table('job_codes')->insert([
            'name'=>'Client 1 - Programming',
            'billing_code'=>'C10002',
            'created_at'=>date('Y/m/d H:i:s'),
            'updated_at'=>date('Y/m/d H:i:s'),
        ]);   
        DB::table('job_codes')->insert([
            'name'=>'Client 2 - Consulting',
            'billing_code'=>'C10003',
            'created_at'=>date('Y/m/d H:i:s'),
            'updated_at'=>date('Y/m/d H:i:s'),
        ]);   
        DB::table('job_codes')->insert([
            'name'=>'Client 2 - Programming',
            'billing_code'=>'C10004',
            'created_at'=>date('Y/m/d H:i:s'),
            'updated_at'=>date('Y/m/d H:i:s'),
        ]);   
    }
}
