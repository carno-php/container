<?php
/**
 * Object not found
 * User: moyo
 * Date: 11/10/2017
 * Time: 6:01 PM
 */

namespace Carno\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

class ObjectNotFoundException extends RuntimeException implements NotFoundExceptionInterface
{

}
