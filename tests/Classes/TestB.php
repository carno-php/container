<?php
/**
 * Test class B
 * User: moyo
 * Date: 2018/6/2
 * Time: 10:19 PM
 */

namespace Carno\Container\Tests\Classes;

class TestB
{
    /**
     * @inject
     * @var TestC
     */
    private $linkC = null;

    /**
     * @return TestC
     */
    public function getC() : TestC
    {
        return $this->linkC;
    }
}
