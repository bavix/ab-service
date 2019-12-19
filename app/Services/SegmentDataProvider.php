<?php

namespace App\Services;

use App\Models\Segment;
use Illuminate\Support\Arr;

class SegmentDataProvider
{

    public const INPUT_HEADER = 'header';
    public const INPUT_BODY = 'body';
    public const INPUT_QUERY = 'query';

    /**
     * @param Segment $segment
     * @return array
     */
    public function getInput(Segment $segment): array
    {
        switch ($segment->getInputAttribute()) {
            case self::INPUT_HEADER:
                return request()->headers->all();

            case self::INPUT_QUERY:
                return request()->query();

            case self::INPUT_BODY:
                return request()->input();
        }

        return request()->all();
    }

    /**
     * @param Segment $segment
     * @return string|null
     */
    public function getWhat(Segment $segment): ?string
    {
        return Arr::get($this->getInput($segment), $segment->getWhatAttribute());
    }

    /**
     * @param Segment $segment
     * @return bool
     */
    public function collate(Segment $segment): bool
    {
        $operate = $segment->getCompareAttribute();
        $value = $segment->getValueAttribute();
        return app(CollateService::class)
            ->getResult($operate, $this->getWhat($segment), $value);
    }

}
