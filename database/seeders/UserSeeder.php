<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (!User::where("email", "nic@buia.it")->first()) {
            $mainUser = new User();
            $mainUser->name = "Nicholas";
            $mainUser->email = "nic@buia.it";
            $mainUser->email_verified_at = now();
            $mainUser->password = Hash::make('123asd');
            $mainUser->save();
        }
    }
}
