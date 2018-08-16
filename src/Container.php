<?php
/**
 * Container
 * User: moyo
 * Date: 2018/8/16
 * Time: 4:45 PM
 */

namespace Carno\Container;

use Carno\Container\Exception\ObjectNotFoundException;
use Carno\Container\Injection\Constructor;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    use Constructor;

    /**
     * @var object[]
     */
    private $instances = [];

    /**
     * @param string $id
     * @return bool
     */
    public function has($id) : bool
    {
        return isset($this->instances[$id]);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function get($id) : object
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        throw new ObjectNotFoundException($id);
    }

    /**
     * @param string $id
     * @param mixed $object
     * @return mixed
     */
    public function set(string $id, object $object) : object
    {
        return $this->instances[$id] = $object;
    }

    /**
     * @param string $class
     * @param mixed ...$args
     * @return mixed
     */
    public function object(string $class, ...$args) : object
    {
        return $this->creating($class, ...$args);
    }
}
