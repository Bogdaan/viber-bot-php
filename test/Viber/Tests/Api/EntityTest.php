<?php

namespace Viber\Tests\Api;

use Viber\Tests\TestCase;
use Viber\Api\Entity;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class EntityTest extends TestCase
{
    public function testApiArray()
    {
        $e = new Entity([]);
        $this->assertEquals([], $e->toApiArray());
    }
}
