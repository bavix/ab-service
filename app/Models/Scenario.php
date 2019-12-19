<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Scenario
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $project_id
 * @property int|null $option_id
 * @property bool $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \App\Models\Option|null $option
 * @property-read \App\Models\Project $project
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scenario whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
