<?php
/**
 * trait A
 * User: moyo
 * Date: 2018/6/8
 * Time: 11:07 AM
 */

namespace Carno\Container\Tests\Traits\SubA;

use Carno\Container\Tests\Traits\Sub1\Sub2\TestA;

trait TraitA
{
    /**
     * @inject      // inline annotations
     * @var TestA   // some annotations
     */
    private $linkA = null;

    /**
     * @return TestA
     */
    public function linkA() : TestA
    {
        return $this->linkA;
    }
}
