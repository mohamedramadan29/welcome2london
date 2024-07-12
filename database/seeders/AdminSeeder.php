<?php

namespace Database\Seeders;

use App\Models\admin\admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{

    public function run(): void
    {
        $admin = new admin();
        $admin->create([
            'name'=>'admin',
            'email'=>'mr319242@gmail.com',
            'password'=>Hash::make('11111111'),
            'logo'=>'',
            'phone'=>'01022222'
        ]);
    }
}
