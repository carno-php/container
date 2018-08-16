<?php
/**
 * Class reflection
 * User: moyo
 * Date: 12/10/2017
 * Time: 10:32 AM
 */

namespace Carno\Container\Injection;

use Carno\Container\Container;
use Carno\Container\Exception\RequiredConstructValueException;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class Reflection
{
    /**
     * @var Used
     */
    private $used = null;

    /**
     * @var Container
     */
    private $container = null;

    /**
     * @var ReflectionClass
     */
    private $reflection = null;

    /**
     * @var Dependency[]
     */
    private $constructParams = [];

    /**
     * @var Dependency[]
     */
    private $propertyInjects = [];

    /**
     * @var ReflectionClass[]
     */
    private $propertyKeepers = [];

    /**
     * Reflection constructor.
     * @param Container $container
     * @param string $class
     * @param array $args
     */
    public function __construct(Container $container, string $class, array $args = [])
    {
        $this->used = new Used;
        $this->container = $container;
        $this->reflection = $ref = new ReflectionClass($class);

        if ($init = $ref->getConstructor()) {
            $args
                ? $this->constructParams = $args
                : $this->parsingConstructor($init)
            ;
        }

        $this->analyzingProperties($ref);
    }

    /**
     * @return bool
     */
    public function hasConstructor() : bool
    {
        return !! $this->constructParams;
    }

    /**
     * @return array
     */
    public function getConstructParams() : array
    {
        return $this->constructParams;
    }

    /**
     * @return bool
     */
    public function hasProperties() : bool
    {
        return !! $this->propertyInjects;
    }

    /**
     * @return array
     */
    public function getPropertyInjects() : array
    {
        return $this->propertyInjects;
    }

    /**
     * @param object $object
     * @param string $name
     * @param $data
     * @return bool
     */
    public function setProperty(object $object, string $name, $data) : bool
    {
        if ($property = ($this->propertyKeepers[$name] ?? $this->reflection)->getProperty($name)) {
            $property->isPublic() || $property->setAccessible(true);
            $property->setValue($object, $data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param ReflectionClass $class
     * @param ReflectionClass $master
     */
    private function analyzingProperties(ReflectionClass $class, ReflectionClass $master = null) : void
    {
        foreach ($class->getTraits() as $trait) {
            $this->analyzingProperties($trait, $class);
        }

        $this->parsingProperties($class->getProperties(), $master);

        ($parent = $class->getParentClass()) && $this->analyzingProperties($parent);
    }

    /**
     * @param ReflectionMethod $method
     */
    private function parsingConstructor(ReflectionMethod $method) : void
    {
        foreach ($method->getParameters() as $param) {
            if ($class = $param->getClass()) {
                $this->constructParams[$param->getPosition()] = new Dependency(
                    $this->container,
                    $class->getName(),
                    $class->isInterface(),
                    $param->isOptional()
                );
                continue;
            }

            if ($param->isOptional()) {
                $this->constructParams[$param->getPosition()] = $param->getDefaultValue();
                continue;
            }

            throw new RequiredConstructValueException(
                "CLASS {$param->getDeclaringClass()->getName()} P#{$param->getPosition()}"
            );
        }
    }

    /**
     * @param ReflectionProperty[] $properties
     * @param ReflectionClass $master
     */
    private function parsingProperties(array $properties, ReflectionClass $master = null) : void
    {
        foreach ($properties as $property) {
            $keeper = $property->getDeclaringClass();
            $linker = $master ?? $keeper;
            $anno = new Annotation($property->getDocComment());
            if ($anno->has('inject')) {
                if ($link = $anno->get('see') ?? $anno->get('var')) {
                    // check exists
                    if (isset($this->propertyInjects[$name = $property->getName()])) {
                        // skip if keeper also matched
                        if (isset($this->propertyKeepers[$name])) {
                            continue;
                        }
                        // renaming
                        $name = $keeper->getName().'::'.$name;
                    }
                    // check keeper
                    $this->reflection->getName() === $linker->getName() || $this->propertyKeepers[$name] = $linker;
                    // injector assigning
                    $this->propertyInjects[$name] = new Dependency(
                        $this->container,
                        $this->used->getFullClass($keeper, $link)
                    );
                }
            }
        }
    }
}
