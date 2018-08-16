<?php
/**
 * Test with traits
 * User: moyo
 * Date: 2018/6/8
 * Time: 11:13 AM
 */

namespace Carno\Container\Tests;

use Carno\Container\DI;
use Carno\Container\Tests\Traits\Sub1\Sub2\TestA;
use Carno\Container\Tests\Traits\Sub1\Sub2\TestA2;
use Carno\Container\Tests\Traits\SubA\SubB\TestO;
use Carno\Container\Tests\Traits\SubA\SubB\TestO2;
use Carno\Container\Tests\Traits\TraitObject;
use PHPUnit\Framework\TestCase;

class TraitCodeTest extends TestCase
{
    public function testCreator()
    {
        /**
         * @var TraitObject $obj
         */

        $obj = DI::object(TraitObject::class);

        $this->assertTrue($obj->linkA() instanceof TestA);
        $this->assertTrue($obj->linkA2() instanceof TestA2);
        $this->assertTrue($obj->linkO() instanceof TestO);
        $this->assertTrue($obj->linkO2() instanceof TestO2);
    }
}
