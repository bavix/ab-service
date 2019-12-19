<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectObserver
{

    /**
     * @param Project $project
     * @return void
     */
    public function creating(Project $project): void
    {
        $project->user()->associate(Auth::user());
    }

}
