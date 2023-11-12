<?php

namespace Modules\User\seeders;

use Illuminate\Database\Seeder;
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Quốc Việt';
        $user->email = 'phoquocviet@gmail.com';
        $user->password = Hash::make('12345678');
        $user->group_id = 1;
        $user->save();
    }
}
