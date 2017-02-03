<?php

namespace Viber\Tests\Api;

use Viber\Api\Signature;
use Viber\Tests\TestCase;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class SignatureTest extends TestCase
{
    public function testIsValid()
    {
        $this->assertTrue(
            Signature::isValid(
                '4703d481ddedca88184497744b52937586bef3b273645082c04529f73b85456e',
                '1',
                '2'
            )
        );
        $this->assertFalse(
            Signature::isValid(
                '-',
                '1',
                '2'
            )
        );
    }
}
