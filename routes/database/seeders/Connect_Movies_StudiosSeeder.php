<?php

namespace Database\Seeders;

use App\Models\ConnectMoviesStudios;
use Illuminate\Database\Seeder;

class Connect_Movies_StudiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adatok = [];

        $filePath = database_path('\seeders\data\movies_studios.txt');
        $handle = fopen($filePath, "r");

        while (($line = fgets($handle)) !== false) {
            $data = explode(',', trim($line));

            $adatok[] = [
                'studios_id' => $data[1] ?? null,
                'movies_id' => $data[0] ?? null,
            ];
        }

        fclose($handle);

        // Tömeges beszúrás (gyorsabb)
        ConnectMoviesStudios::insert($adatok);
    }
}
