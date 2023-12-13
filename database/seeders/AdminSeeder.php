<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'username' => 'Admin',
                'fullname' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
        foreach ($data as $d) {
            User::create([
                'username' => $d['username'],
                'fullname' => $d['fullname'],
                'email' => $d['email'],
                'password' => $d['password'],
                'role' => $d['role'],
            ]);
        }
    }
}
