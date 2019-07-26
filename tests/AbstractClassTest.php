<?php
/**
 * Abstract class test
 * User: moyo
 * Date: 2018/6/2
 * Time: 10:28 PM
 */

namespace Carno\Container\Tests;

use Carno\Container\DI;
use Carno\Container\Tests\Classes\AbsObject;
use Carno\Container\Tests\Classes\TestA;
use Carno\Container\Tests\Classes\TestB;
use Carno\Container\Tests\Classes\TestC;
use PHPUnit\Framework\TestCase;

class AbstractClassTest extends TestCase
{
    public function testCreator()
    {
        /**
         * @var AbsObject $obj
         */

        $obj = DI::object(AbsObject::class);

        // test injection
        $this->assertTrue(($objA = $obj->getA()) instanceof TestA);
        $this->assertTrue(($objB = $obj->getB()) instanceof TestB);
        $this->assertTrue(($objC = $obj->getC()) instanceof TestC);

        $this->assertTrue(($objAC = $obj->abaA()) instanceof TestC);
        $this->assertTrue(($objBB = $obj->abaB()) instanceof TestB);

        // test singleton
        $this->assertEquals(spl_object_hash($objA->getB()), spl_object_hash($objB));
        $this->assertEquals(spl_object_hash($objA->getB()->getC()), spl_object_hash($objC));

        $this->assertEquals(spl_object_hash($objAC), spl_object_hash($objC));
        $this->assertEquals(spl_object_hash($objBB), spl_object_hash($objB));
    }
}
