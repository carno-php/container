<?php
/**
 * Objects constructor
 * User: moyo
 * Date: 12/10/2017
 * Time: 10:37 AM
 */

namespace Carno\Container\Injection;

trait Constructor
{
    /**
     * @param string $class
     * @param mixed ...$args
     * @return object|mixed
     */
    private function creating(string $class, ...$args)
    {
        $ref = new Reflection($this, $class, $args);

        if ($ref->hasConstructor()) {
            foreach ($params = $ref->getConstructParams() as $idx => $val) {
                $val instanceof Dependency && $params[$idx] = $val->object();
            }
        }

        $object = new $class(...($params ?? []));

        if ($ref->hasProperties()) {
            foreach ($ref->getPropertyInjects() as $name => $target) {
                $target instanceof Dependency && $ref->setProperty($object, $name, $target->object());
            }
        }

        return $object;
    }
}
