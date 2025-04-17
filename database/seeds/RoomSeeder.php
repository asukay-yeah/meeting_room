<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // RoomSeeder
        DB::table('rooms')->insert([
            ['name' => 'Ruang Rapat Jakarta', 'description' => 'Ruang rapat lantai 1', 'capacity' => "30", 'ac' => '2', 'screen' => '1 TV'],
            ['name' => 'Ruang Rapat Depok', 'description' => 'Ruang rapat lantai 2', 'capacity' => "6", 'ac' => '1', 'screen' => '1 Projector'],
            ['name' => 'Ruang Rapat Bogor', 'description' => 'Ruang rapat lantai 3', 'capacity' => "15", 'ac' => '2', 'screen' => '1 Projector'],
            ['name' => 'Ruang Rapat Bekasi', 'description' => 'Ruang rapat lantai 4', 'capacity' => "30+", 'ac' => '3 Standing', 'screen' => '1 TV'],
        ]);

    }
}
