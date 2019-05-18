<?php

//namespace App\Tests;
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Models\ZohoHelpers\Calendar as ZohoCalendar;
use App\Models\Calendar;

class FirstTest extends TestCase
{
  
  
  public function testPushAndPop() {
    $stack = array();
    $this->assertEquals(0, count($stack));

    array_push($stack, 'foo');
    $this->assertEquals('foo', $stack[count($stack)-1]);
    $this->assertEquals(1, count($stack));

    $this->assertEquals('foo', array_pop($stack));
    $this->assertEquals(0, count($stack));
  }
}