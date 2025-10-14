<?php

namespace Database\Seeders;

use App\Models\ConnectMoviesActors;
use Illuminate\Database\Seeder;

class Connect_Movies_ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adatok = [];

        $filePath = database_path('seeders/data/movies_actors.txt');
        $handle = fopen($filePath, "r");

        while (($line = fgets($handle)) !== false) {
            $data = explode(',', trim($line));

            $adatok[] = [
                'movie_id' => $data[0] ?? null,
                'actor_id' => $data[1] ?? null,
            ];
        }

        fclose($handle);

        // Tömeges beszúrás (gyorsabb)
        ConnectMoviesActors::insert($adatok);
    }
}



