<?php
/**
 * Depends interface not assigned
 * User: moyo
 * Date: 12/10/2017
 * Time: 2:49 PM
 */

namespace Carno\Container\Exception;

use Psr\Container\ContainerExceptionInterface;
use RuntimeException;

class DependsInterfaceNotAssignedException extends RuntimeException implements ContainerExceptionInterface
{

}
