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
     * @return object
     */
    public function get($id)
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        throw new ObjectNotFoundException($id);
    }

    /**
     * @param string $id
     * @param object $object
     * @return object
     */
    public function set(string $id, $object)
    {
        assert(is_object($object));
        return $this->instances[$id] = $object;
    }

    /**
     * @param string $class
     * @param mixed ...$args
     * @return object
     */
    public function object(string $class, ...$args)
    {
        return $this->creating($class, ...$args);
    }
}
