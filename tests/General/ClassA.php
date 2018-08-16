<?php
/**
 * General class A
 * User: moyo
 * Date: 2018/6/8
 * Time: 1:17 PM
 */

namespace Carno\Container\Tests\General;

class ClassA
{
    /**
     * @var API1
     */
    private $api = null;

    /**
     * @var ObjA
     */
    private $obj = null;

    /**
     * @inject yes
     * @var InjA // inline annotation test
     */
    private $inj = null;

    /**
     * @var string
     */
    private $default = null;

    /**
     * ClassA constructor.
     * @param API1 $api
     * @param ObjA $obj
     * @param string $default
     */
    public function __construct(API1 $api, ObjA $obj, string $default = 'hello')
    {
        $this->api = $api;
        $this->obj = $obj;
        $this->default = $default;
    }

    /**
     * @return Impl1
     */
    public function api() : API1
    {
        return $this->api;
    }

    /**
     * @return ObjA
     */
    public function obj() : ObjA
    {
        return $this->obj;
    }

    /**
     * @return InjA
     */
    public function inj() : InjA
    {
        return $this->inj;
    }

    /**
     * @return string
     */
    public function default() : string
    {
        return $this->default;
    }
}
