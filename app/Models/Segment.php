<?php

namespace App\Models;

use App\Sets\RegulatorSet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Segment
 *
 * @package App\Models
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string $slug
 * @property array $payload
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array|string $compare
 * @property-read string $input
 * @property-read RegulatorSet $regulator_set
 * @property-read array|string $value
 * @property-read string $what
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \App\Models\Project $project
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Segment whereUpdatedAt($value)
 * @mixin \Eloquent
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
        'payload', // from, what, compare, value
    ];

    /**
     * @var array
     */
    protected $casts = [
        'project_id' => 'int',
        'payload' => 'json',
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
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * @return RegulatorSet
     */
    public function getRegulatorSetAttribute(): RegulatorSet
    {
        static $regulatorSet;
        if (!$regulatorSet) {
            $regulatorSet = RegulatorSet::make($this);
        }

        return $regulatorSet;
    }

    /**
     * @return string
     */
    public function getInputAttribute(): string
    {
        return $this->getRegulatorSetAttribute()->input;
    }

    /**
     * @return string
     */
    public function getWhatAttribute(): string
    {
        return $this->getRegulatorSetAttribute()->what;
    }

    /**
     * @return string
     */
    public function getCompareAttribute(): string
    {
        return $this->getRegulatorSetAttribute()->compare;
    }

    /**
     * @return array|string
     */
    public function getValueAttribute()
    {
        return $this->getRegulatorSetAttribute()->value;
    }

}
