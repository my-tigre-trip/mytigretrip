<?php

namespace App\Helpers;
/**
 *  functions for mocking calendar
 */
class Calendar {
  public static function calendarData() {
    return [
      [
        'Id' => '1',
        'Schedule' => MORNING_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-01-23T09:00:00+03:00',
        'People' => ''
      ],
      // 2 following share the same day
      [
        'Id' => '2',
        'Schedule' => MORNING_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-02-01T09:00:00+03:00',
        'People' => ''
      ],

      [
        'Id' => '3',
        'Schedule' => AFTERNOON_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-01-01T09:00:00+03:00',
        'People' => ''
      ],
      // full day
      [
        'Id' => '4',
        'Schedule' => SCH_FULL_DAY_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-02-23T09:00:00+03:00',
        'People' => ''
      ],
      // group
      [
        'Id' => '5',
        'Schedule' => AFTERNOON_ES,
        'Type' => GROUP_TRIP_ES,
        'Start_DateTime' => '2020-02-24T09:00:00+03:00',
        'People' => '3'
      ],

      [
        'Id' => '6',
        'Schedule' => AFTERNOON_ES,
        'Type' => GROUP_TRIP_ES,
        'Start_DateTime' => '2020-03-01T15:00:00+03:00',
        'People' => '5'
      ],
      // past event
      [
        'Id' => '7',
        'Schedule' => AFTERNOON_ES,
        'Type' => GROUP_TRIP_ES,
        'Start_DateTime' => '2012-03-01T15:00:00+03:00',
        'People' => '1'
      ],
    ];
  }

}