<?php
/**
 * Dependency target
 * User: moyo
 * Date: 12/10/2017
 * Time: 11:16 AM
 */

namespace Carno\Container\Injection;

use Carno\Container\Container;
use Carno\Container\Exception\DependsInterfaceNotAssignedException;

class Dependency
{
    /**
     * @var Container
     */
    private $di = null;

    /**
     * @var string
     */
    private $class = null;

    /**
     * @var bool
     */
    private $contract = false;

    /**
     * @var bool
     */
    private $optional = false;

    /**
     * Dependency constructor.
     * @param Container $di
     * @param string $class
     * @param bool $contract
     * @param bool $optional
     */
    public function __construct(Container $di, string $class, bool $contract = false, bool $optional = false)
    {
        $this->di = $di;
        $this->class = $class;
        $this->contract = $contract;
        $this->optional = $optional;
    }

    /**
     * @return object|mixed|null
     */
    public function object()
    {
        if ($this->di->has($this->class)) {
            return $this->di->get($this->class);
        }

        if ($this->contract) {
            if ($this->optional) {
                return null;
            }

            throw new DependsInterfaceNotAssignedException($this->class);
        }

        return $this->di->set($this->class, $this->di->object($this->class));
    }
}
