<?php
/**
 * trait 1
 * User: moyo
 * Date: 2018/6/8
 * Time: 11:07 AM
 */

namespace Carno\Container\Tests\Traits\Sub1;

use Carno\Container\Tests\Traits\SubA\SubB\TestO;

trait Trait1
{
    /**
     * @inject
     * @var TestO
     */
    private $linkO = null;

    /**
     * @return TestO
     */
    public function linkO() : TestO
    {
        return $this->linkO;
    }
}
