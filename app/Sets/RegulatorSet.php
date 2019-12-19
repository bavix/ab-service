<?php

namespace App\Sets;

use App\Models\Segment;

/**
 * Class RegulatorSet
 * @package App\Sets
 * @property string $input
 * @property string $what
 * @property string $compare
 * @property string|array $value
 */
class RegulatorSet implements \JsonSerializable
{

    /**
     * @var Segment
     */
    protected $segment;

    /**
     * RegulatorSet constructor.
     * @param Segment $segment
     */
    public function __construct(Segment $segment)
    {
        $this->segment = $segment;
    }

    /**
     * @param Segment $segment
     * @return static
     */
    public static function make(Segment $segment): self
    {
        return new static($segment);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return (array)$this->segment->regulator;
    }

    /**
     * @param string $key
     * @return string
     */
    public function __get(string $key): ?string
    {
        return $this->segment->regulator[$key] ?? null;
    }

    /**
     * @param string $key
     * @param string|array|null $value
     */
    public function __set(string $key, $value): void
    {
        $this->segment->regulator[$key] = $value;
    }

    /**
     * @param string $key
     */
    public function __unset(string $key): void
    {
        unset($this->segment->regulator[$key]);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return array_key_exists($key, $this->segment->regulator);
    }

}
