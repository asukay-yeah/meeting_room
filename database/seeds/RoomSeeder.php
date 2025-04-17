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
            ['name' => 'Ruang 1', 'description' => 'Ruang rapat lantai 1'],
            ['name' => 'Ruang 2', 'description' => 'Ruang rapat lantai 2'],
            ['name' => 'Ruang 3', 'description' => 'Ruang rapat lantai 3'],
            ['name' => 'Ruang 4', 'description' => 'Ruang rapat lantai 4'],
        ]);

    }
}
