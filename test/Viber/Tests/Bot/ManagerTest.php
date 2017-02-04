<?php

namespace Viber\Tests\Bot;

use Viber\Tests\TestCase;
use Viber\Bot\Manager;
use Viber\Api\Event;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class ManagerTest extends TestCase
{
    public function testChecker()
    {
        $totalCalls = 0;
        $m = new Manager(function($e) use (&$totalCalls) {
            $totalCalls++;
            return true;
        }, function($e) use (&$totalCalls) {
            $totalCalls++;
            return true;
        });
        $m->isMatch(new Event([]));
        $this->assertEquals(1, $totalCalls);
    }

    public function testHandler()
    {
        $totalCalls = 0;
        $m = new Manager(function($e) use (&$totalCalls) {
            $totalCalls++;
            return true;
        }, function($e) use (&$totalCalls) {
            $totalCalls++;
            return true;
        });
        $m->runHandler(new Event([]));
        $this->assertEquals(1, $totalCalls);
    }

    public function testIsMatch()
    {
        $totalCalls = 0;
        $m = new Manager(function($e) use (&$totalCalls) {
            $totalCalls++;
            return false;
        }, function($e) use (&$totalCalls) {
            $totalCalls++;
            return true;
        });
        $event = new Event([]);
        if ($m->isMatch($event)) {
            $m->runHandler($event);
        }
        $this->assertEquals(1, $totalCalls);
    }
}
