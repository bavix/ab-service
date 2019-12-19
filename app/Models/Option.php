<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Option
 *
 * @property int $id
 * @property int $scenario_id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Scenario $scenario
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereScenarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Option whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
