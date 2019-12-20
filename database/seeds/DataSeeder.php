<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class DataSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $self = $this;
        $output = $this->command->getOutput();
        $progressBar = $output->createProgressBar($this->query()->count());
        $this->query()->each(static function () use ($self, $progressBar) {
            call_user_func_array([$self, 'each'], func_get_args());
            $progressBar->advance();
        });

        $output->newLine();
    }

    /**
     * @param Model $model
     * @return mixed
     */
    abstract public function each(Model $model);

    /**
     * @return Builder
     */
    abstract public function query(): Builder;

}
