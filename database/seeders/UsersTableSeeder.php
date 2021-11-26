<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => config('admin.name'),
            'email' => config('admin.email'),
            'phone' => config('admin.phone'),
            'address' => config('admin.address'),
            'password' => Hash::make(config('admin.password')),
            'role_id' => config('const.admin'),
        ]);
    }
}
