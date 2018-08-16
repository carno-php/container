<?php
/**
 * Abs object
 * User: moyo
 * Date: 2018/6/2
 * Time: 10:25 PM
 */

namespace Carno\Container\Tests\Classes;

class AbsObject extends AbsBaseB
{
    /**
     * @inject
     * @var TestC
     */
    private $linkA = null;

    /**
     * @return TestA
     */
    public function getA() : TestA
    {
        return $this->linkA();
    }

    /**
     * @return TestB
     */
    public function getB() : TestB
    {
        return $this->linkB;
    }

    /**
     * @return TestC
     */
    public function getC() : TestC
    {
        return $this->linkA;
    }
}
