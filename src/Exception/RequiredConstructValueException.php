<?php
/**
 * Constructor has required value
 * User: moyo
 * Date: 12/10/2017
 * Time: 11:00 AM
 */

namespace Carno\Container\Exception;

use Psr\Container\ContainerExceptionInterface;
use RuntimeException;

class RequiredConstructValueException extends RuntimeException implements ContainerExceptionInterface
{

}
