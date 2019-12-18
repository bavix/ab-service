<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsToMany
     */
    public function segments(): BelongsToMany
    {
        return $this->belongsToMany(Segment::class);
    }

    /**
     * @return BelongsToMany
     */
    public function scenarios(): BelongsToMany
    {
        return $this->belongsToMany(Scenario::class);
    }

}
