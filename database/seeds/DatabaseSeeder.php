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
        if (!app()->isLocal()) {
            $output = $this->command->getOutput();
            $output->error('Allowed only in local environment');
            return;
        }

        $this->call(UsersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(ScenariosTableSeeder::class);
//        $this->call(SegmentsTableSeeder::class);
//        $this->call(OptionsTableSeeder::class);
//        $this->call(GroupsTableSeeder::class);
    }

}
