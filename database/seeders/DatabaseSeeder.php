<?php

namespace Database\Seeders;

use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Jhon Doe',
            'email' => 'test@test.com'
        ]);

        Listing::factory(50)->create([
            'user_id' => $user->id
        ]);
    }
}
