<?php
/**
 * Trait test object
 * User: moyo
 * Date: 2018/6/8
 * Time: 11:01 AM
 */

namespace Carno\Container\Tests\Traits;

use Carno\Container\Tests\Traits\Sub1\Trait1;
use Carno\Container\Tests\Traits\SubA\SubB\TestO2;

class TraitObject extends TraitAbstract
{
    use Trait1;

    /**
     * @inject
     * @var TestO2
     */
    private $linkO2;

    /**
     * @return TestO2
     */
    public function linkO2() : TestO2
    {
        return $this->linkO2;
    }
}
