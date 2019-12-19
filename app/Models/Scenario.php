<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Scenario extends Model
{

    use HasSlug;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'project_id',
        'option_id',
        'enabled',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'project_id' => 'int',
        'option_id' => 'int',
        'enabled' => 'bool',
    ];

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class)
            ->withDefault();
    }

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnCreate();
    }

}
