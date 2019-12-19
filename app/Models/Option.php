<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Option extends Model
{

    use HasSlug;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'scenario_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'scenario_id' => 'int',
    ];

    /**
     * @return BelongsTo
     */
    public function scenario(): BelongsTo
    {
        return $this->belongsTo(Scenario::class);
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
