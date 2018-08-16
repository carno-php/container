<?php
/**
 * General class B
 * User: moyo
 * Date: 2018/8/16
 * Time: 3:51 PM
 */

namespace Carno\Container\Tests\General;

class ClassB
{
    /**
     * @inject
     * @var ClassA
     */
    private $a = null;

    /**
     * @var string
     */
    private $e = null;

    /**
     * ClassB constructor.
     * @param string $extra
     */
    public function __construct(string $extra)
    {
        $this->e = $extra;
    }

    /**
     * @return ClassA
     */
    public function a() : ClassA
    {
        return $this->a;
    }

    /**
     * @return string
     */
    public function e() : string
    {
        return $this->e;
    }
}
