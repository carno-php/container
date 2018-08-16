<?php
/**
 * Quick APIs of container (default)
 * User: moyo
 * Date: 11/10/2017
 * Time: 4:13 PM
 */

namespace Carno\Container;

/**
 * @see Container
 * @method static bool has(string $id)
 * @method static mixed get(string $id)
 * @method static mixed set(string $id, object $object)
 * @method static mixed object(string $class, mixed ...$args)
 */
final class DI
{
    /**
     * @var Container
     */
    private static $container = null;

    /**
     * @return Container
     */
    private static function default() : Container
    {
        return self::$container ?? self::$container = new Container;
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic(string $name, array $args)
    {
        return self::default()->$name(...$args);
    }
}
