<?php
/**
 * Trait abs
 * User: moyo
 * Date: 2018/6/8
 * Time: 11:01 AM
 */

namespace Carno\Container\Tests\Traits;

use Carno\Container\Tests\Traits\Sub1\Sub2\TestA2;
use Carno\Container\Tests\Traits\SubA\TraitA;

abstract class TraitAbstract
{
    use TraitA;

    /**
     * @inject
     * @var TestA2
     */
    private $linkA2;

    /**
     * @return TestA2
     */
    public function linkA2() : TestA2
    {
        return $this->linkA2;
    }
}
