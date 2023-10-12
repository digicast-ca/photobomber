<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Throwable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        try {
            User::factory()->createOne([
                'name' => 'Photobomber',
                'email' => 'photobomber@icastgo.com',
            ]);
        } catch (Throwable $exception) {
        }
    }
}
