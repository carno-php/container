<?php
/**
 * Test class A
 * User: moyo
 * Date: 2018/6/2
 * Time: 10:18 PM
 */

namespace Carno\Container\Tests\Classes;

class TestA
{
    /**
     * @inject
     * @var TestB
     */
    private $linkB = null;

    /**
     * @return TestB
     */
    public function getB() : TestB
    {
        return $this->linkB;
    }
}
