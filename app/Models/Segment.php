<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Segment
 * @package App\Models
 */
class Segment extends Model
{

    use HasSlug;

    /**
     * @var array
     */
    protected $fillable = [
        'project_id',
        'name',
        'regulator', // from, what, compare, value
    ];

    /**
     * @var array
     */
    protected $casts = [
        'project_id' => 'int',
        'regulator' => 'json',
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
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
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

    /**
     * @return string
     */
    public function getInputAttribute(): string
    {
        return $this->regulator->input;
    }

    /**
     * @return string
     */
    public function getWhatAttribute(): string
    {
        return $this->regulator->what;
    }

    /**
     * @return array|string
     */
    public function getCompareAttribute()
    {
        return $this->regulator->compare;
    }

    /**
     * @return array|string
     */
    public function getValueAttribute()
    {
        return $this->regulator->value;
    }

}
