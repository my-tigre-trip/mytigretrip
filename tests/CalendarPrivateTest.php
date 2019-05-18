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
   * assert not available
   */
  public function assertNotAvailable($e) {
    $this->assertEquals($e['eventId'], 'fake id');
    $this->assertEquals($e['classes'], 'mtt-not-available');
    $this->assertEquals($e['people'], '');
  }

  /**
   * assert classes
   */
  public function assertClasses() {
    
  }

  /**
   * @testdox should return true for future dates and false for past dates
   * @group CalendarPrivate
   * @covers  \App\Models\CalendarPrivate::isValidDate
   */
  public function testIsValidDate() {
    $calendar = new CalendarPrivate(null, MORNING);
    $eValid =  ['Start_DateTime' => '2029-01-23T09:00:00+03:00'];
    $eNotValid =  ['Start_DateTime' => '2012-01-23T09:00:00+03:00'];
    $this->assertEquals($calendar->isValidDate($eValid), true);
    $this->assertEquals($calendar->isValidDate($eNotValid), false);
  }

  /**
   * @testdox should process the events array according to morning rules
   * @group CalendarPrivate
   * @covers  \App\Models\CalendarPrivate::processMorning
   */
  public function testProcessMorningEvent() {
    $calendar = new CalendarPrivate(null, MORNING);   
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
    $this->assertNotAvailable($events[0]);
  }
  
  /**
   * @testdox should process the events array according to afternoon rules
   * @group CalendarPrivate
   * @covers  \App\Models\CalendarPrivate::processAfternoon
   */
  public function testProcessAfternoonEvent() {    
    $calendar = new CalendarPrivate(null, AFTERNOON);   
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
    $this->assertNotAvailable($events[0]);
  }

    /**
   * @testdox should process the events array according to afternoon rules
   * @group CalendarPrivate
   * @covers  \App\Models\CalendarPrivate::processFullDay
   */
  public function testProcessFullDayEvent() {
    $calendar = new CalendarPrivate(null, FULL_DAY);   
    $e =  [
      'Id' => 'fake id',
      'Schedule' => MORNING_ES,
      'Type' => PRIVATE_TRIP_ES,
      'Start_DateTime' => '2020-01-23T15:00:00+03:00',
      'People' => ''
    ];
    $calendar->processFullDay($e);
    $events = $calendar->getProcessedEvents();
    //$calendar->events;
    $this->assertEquals(is_array($events), true);
    $this->assertNotAvailable($events[0]);
  }

  # Map events - the most important method
  # 1 tests for morning against the mock data
  # 1 tests for afternoon against the mock data
  # 1 tests for full day against the mock data
  /**
   * @testdox  Should resturn a proper array of events for a private morning trip 
   */
  public function testMapEventsMorning() {
    $stubZohoCalendar = $this->getCalendarMock();
    $calendar = new CalendarPrivate($stubZohoCalendar, FULL_DAY);
    $calendar->fetchEvents();
    $calendar->mapEvents();
    $events = $calendar->getProcessedEvents();
    $this->assertEquals(is_array($events), true);
    $this->assertEquals(count($events), 6); // should filter only a past date
    #check classes
  }



}