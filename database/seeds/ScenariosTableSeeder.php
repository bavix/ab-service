<?php

class ScenariosTableSeeder extends DataSeeder
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|\App\Models\Project $model
     * @return mixed|void
     * @throws
     */
    public function each(\Illuminate\Database\Eloquent\Model $model)
    {
        /**
         * @var \App\Models\Scenario $scenario
         */
        $collection = factory(\App\Models\Scenario::class, random_int(1, 5))->make();
        foreach ($collection as $scenario) {
            $scenario->project()->associate($model);
            $scenario->save();
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Models\Project::query();
    }

}
