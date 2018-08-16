<?php
/**
 * Abs base A
 * User: moyo
 * Date: 2018/6/2
 * Time: 11:32 PM
 */

namespace Carno\Container\Tests\Classes;

abstract class AbsBaseA
{
    /**
     * @inject
     * @var TestC
     */
    private $linkA = null;

    /**
     * will skip because AbsBaseB override linkB
     * @inject
     * @var TestC
     */
    protected $linkB = null;

    /**
     * @return TestC
     */
    public function abaA() : TestC
    {
        return $this->linkA;
    }

    /**
     * @return TestB
     */
    public function abaB() : TestB
    {
        return $this->linkB;
    }
}
