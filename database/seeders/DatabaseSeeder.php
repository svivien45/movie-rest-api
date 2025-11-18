<?php

namespace Database\Seeders;

use App\Models\ConnectDirectorsMovies;
use App\Models\ConnectMoviesActors;
use App\Models\Studio;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        User::factory()->create([
            'name' =>'rrd',
            'email' => 'rrd@webmania.cc',
            'password' => '123'
        ]);

        $this->call([
            ActorSeeder::class,
            CategorySeeder::class,
            DirectorSeeder::class,
            StudioSeeder::class,
            MovieSeeder::class,
            Connect_Movies_ActorsSeeder::class,
        ]);
    }
}
