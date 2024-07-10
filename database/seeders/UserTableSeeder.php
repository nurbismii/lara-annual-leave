<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Human Resources',
            'email'    => 'hr@vdni.top',
            'password'    => bcrypt('vdni678910')
        ]);
    }
}
