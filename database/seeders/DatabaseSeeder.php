<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Database\Seeder;
use Database\Seeders\FavoriteSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        $user1 = User::factory()->create([
            'role' => 'admin',
            'username' => 'dnoobody',
            'email' => 'danarwijanarko98@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
        ]);

        $user2 = User::factory()->create([
            'role' => 'user',
            'username' => 'xeesoxee',
            'email' => 'hansohee@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        FavoriteSeeder::drama($user1);
        FavoriteSeeder::person($user1);
        FavoriteSeeder::movies($user1);
        FavoriteSeeder::person2($user2);

        User::factory(5)->create();
    }
}
