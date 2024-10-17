<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        User::create([
            'name'=>'Admin',
            'email'=>'admin@example.com',
            'role'=>'admin',
            'password'=>Hash::make('admin123')

        ]);
        User::create([
            'name'=>'Kasir',
            'email'=>'kasir@example.com',
            'role'=>'kasir',
            'password'=>Hash::make('kasir123')

        ]);
        
    }
}
