<?php
/**
 * General test
 * User: moyo
 * Date: 2018/6/8
 * Time: 1:23 PM
 */

namespace Carno\Container\Tests;

use Carno\Container\DI;
use Carno\Container\Exception\DependsInterfaceNotAssignedException;
use Carno\Container\Exception\ObjectNotFoundException;
use Carno\Container\Exception\RequiredConstructValueException;
use Carno\Container\Tests\General\API1;
use Carno\Container\Tests\General\ClassA;
use Carno\Container\Tests\General\ClassB;
use Carno\Container\Tests\General\Impl1;
use Carno\Container\Tests\General\InjA;
use Carno\Container\Tests\General\ObjA;
use PHPUnit\Framework\TestCase;
use stdClass;

class GeneralTest extends TestCase
{
    public function testBasic()
    {
        if (DI::has('test-id')) {
            $this->assertTrue(true);
            return;
        }

        $e = null;

        try {
            DI::get('test-id');
        } catch (ObjectNotFoundException $ee) {
            $e = $ee;
        }

        $this->assertTrue($e instanceof ObjectNotFoundException);
        $this->assertTrue(DI::set('test-id', new stdClass) instanceof stdClass);
        $this->assertTrue(DI::has('test-id'));
    }

    public function testCreator()
    {
        $this->initAPI();

        /**
         * @var ClassA $class
         */

        $class = DI::object(ClassA::class);

        $this->assertTrue($class->api() instanceof Impl1);
        $this->assertTrue($class->obj() instanceof ObjA);
        $this->assertTrue($class->inj() instanceof InjA);
        $this->assertEquals('hello', $class->default());
    }

    public function testCreateWithArgs()
    {
        $this->initAPI();

        $e = null;

        try {
            DI::object(ClassB::class);
        } catch (RequiredConstructValueException $ee) {
            $e = $ee;
        }

        $this->assertTrue($e instanceof RequiredConstructValueException);

        /**
         * @var ClassB $class
         */

        $class = DI::object(ClassB::class, 'hello');

        $this->assertEquals('hello', $class->e());
        $this->assertTrue($class->a() instanceof ClassA);
        $this->assertTrue($class->a()->api() instanceof Impl1);
    }

    private function initAPI()
    {
        if (DI::has(API1::class)) {
            return;
        }

        $e = null;

        try {
            DI::object(ClassA::class);
        } catch (DependsInterfaceNotAssignedException $ee) {
            $e = $ee;
        }

        $this->assertTrue($e instanceof DependsInterfaceNotAssignedException);

        DI::set(API1::class, DI::object(Impl1::class));
    }
}
