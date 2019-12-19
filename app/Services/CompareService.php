<?php

namespace App\Services;

use Symfony\Component\Finder\Comparator\Comparator;

class CompareService
{

    /**
     * @var Comparator
     */
    protected $comparator;

    /**
     * CompareService constructor.
     */
    public function __construct()
    {
        $this->comparator = new Comparator();
    }

    /**
     * @param array|string $target
     * @return $this
     */
    public function setTarget($target): self
    {
        $this->comparator->setTarget($target);
        return $this;
    }

    /**
     * @param string $operator
     * @return $this
     */
    public function setOperator(string $operator): self
    {
        $this->comparator->setOperator($operator);
        return $this;
    }

    /**
     * @param string|array $test
     * @return bool
     */
    public function getResult($test): bool
    {
        if ($test === null && $this->comparator->getTarget() !== null) {
            return false;
        }

        // add compare array
        return $this->comparator->test($test);
    }

}
