<?php

namespace App\Services;

class CollateService
{

    /**
     * @param string $operate
     * @param null|string $left
     * @param null|string $right
     * @return bool
     */
    public function getResult(string $operate, ?string $left, ?string $right): bool
    {
        return app(CompareService::class)
            ->setTarget($left)
            ->setOperator($operate)
            ->getResult($right);
    }

}
