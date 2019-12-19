<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Group extends Model
{

    use HasSlug;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'project_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'project_id' => 'int',
    ];

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

    /**
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnCreate();
    }

}
