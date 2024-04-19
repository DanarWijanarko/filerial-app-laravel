<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Network;
use App\Models\Favorite;
use Illuminate\Database\Seeder;
use Database\Seeders\FavoriteSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        $json = file_get_contents(base_path('public/networks_fix.json'));
        $networks = json_decode($json, true);

        foreach ($networks as $network) {
            Network::create([
                'network_id' => $network['network_id'],
                'logo' => $network['logo'] !== '' ? $network['logo'] : null,
                'name' => $network['name'] !== '' ? $network['name'] : null,
                'homepage' => $network['homepage'] !== '' ? $network['homepage'] : null,
                'headquarters' => $network['headquarters'] !== '' ? $network['headquarters'] : null,
                'origin_country' => $network['origin_country'] !== '' ? $network['origin_country'] : null,
            ]);
        }
    }
}
