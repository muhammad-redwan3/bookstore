<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
       Admin::create([
            'name'=>'Root',
            'email'=>'admin@gmail.com',
            'avatar'=>'',
            'password'=>Hash::make('5wvQ5X7L6!5R'),
        ]);
    }
}
