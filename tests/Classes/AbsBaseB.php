<?php
/**
 * Abs base B
 * User: moyo
 * Date: 2018/6/2
 * Time: 10:18 PM
 */

namespace Carno\Container\Tests\Classes;

abstract class AbsBaseB extends AbsBaseA
{
    /**
     * @inject
     * @var TestA
     */
    private $linkA = null;

    /**
     * @inject
     * @var TestB
     */
    protected $linkB = null;

    /**
     * @return TestA
     */
    protected function linkA() : TestA
    {
        return $this->linkA;
    }
}
