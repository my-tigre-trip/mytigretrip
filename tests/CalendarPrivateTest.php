<?php
declare(strict_types=1);

namespace App\Tests\Checkout;

use PHPUnit\Framework\TestCase;
use App\Models\CalendarPrivate;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\CalendarHandler;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use App\Helpers\Calendar as CalendarHelper;

require_once dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/definitions.php';
require_once 'secrets.php';

class CaldendarPrivateTest extends TestCase {
  //private $stubZohoCalendar;
   
  public static function setUpBeforeClass () {
    // ZohoHandler::getInstance()->auth();
   
    // $this->stubZohoCalendar = $stubZohoCalendar;
  }
  
  /**
   * calendar stub/mock creation
   */
  public function getCalendarMock() {
    $stubZohoCalendar = $this->createMock(CalendarHandler::class);
    //mocking the calendar
    $stubZohoCalendar->method('fetchEvents')
      ->willReturn(CalendarHelper::calendarData());
      return $stubZohoCalendar;
  }

  /**
   * @testdox should process the events array according to morning rules
   * @group CalendarPrivate
   * @covers  \App\Models\CalendarPrivate::processMorning
   */
  public function testProcessMorningEvent() {
    $stubZohoCalendar = $this->getCalendarMock();
    $calendar = new CalendarPrivate($stubZohoCalendar, MORNING);   
    $e =  [
      'Id' => 'fake id',
      'Schedule' => MORNING_ES,
      'Type' => PRIVATE_TRIP_ES,
      'Start_DateTime' => '2020-01-23T09:00:00+03:00',
      'People' => ''
    ];
    $calendar->processMorning($e);
    $events = $calendar->getProcessedEvents();
    //$calendar->events;
    $this->assertEquals(is_array($events), true);
    $this->assertEquals($events[0]['eventId'], 'fake id');
    $this->assertEquals($events[0]['classes'], 'mtt-not-available');
    $this->assertEquals($events[0]['people'], '');
  }
  
  /**
   * @testdox should process the events array according to afternoon rules
   * @group CalendarPrivate
   * @covers  \App\Models\CalendarPrivate::processAfternoon
   */
  public function testProcessAfternoonEvent() {
    $stubZohoCalendar = $this->getCalendarMock();
    $calendar = new CalendarPrivate($stubZohoCalendar, AFTERNOON);   
    $e =  [
      'Id' => 'fake id',
      'Schedule' => AFTERNOON_ES,
      'Type' => PRIVATE_TRIP_ES,
      'Start_DateTime' => '2020-01-23T15:00:00+03:00',
      'People' => ''
    ];
    $calendar->processAfternoon($e);
    $events = $calendar->getProcessedEvents();
    //$calendar->events;
    $this->assertEquals(is_array($events), true);
    $this->assertEquals($events[0]['eventId'], 'fake id');
    $this->assertEquals($events[0]['classes'], 'mtt-not-available');
    $this->assertEquals($events[0]['people'], '');
  }



}