<?php

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
        $this->call(ProjectsTableSeeder::class);
        $this->call(ScenariosTableSeeder::class);
        $this->call(SegmentsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
    }
}
