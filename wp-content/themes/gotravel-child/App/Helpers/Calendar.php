<?php

namespace App\Helpers;
/**
 *  functions for mocking calendar
 */
class Calendar {
  public static function calendarData() {
    return [
      [
        'Schedule' => MORNING_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-01-23T09:00:00+03:00',
        'People' => ''
      ],
      // 2 following share the same day
      [
        'Schedule' => MORNING_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-02-01T09:00:00+03:00',
        'People' => ''
      ],

      [
        'Schedule' => AFTERNOON_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-01-01T09:00:00+03:00',
        'People' => ''
      ],
      // full day
      [
        'Schedule' => SCH_FULL_DAY_ES,
        'Type' => PRIVATE_TRIP_ES,
        'Start_DateTime' => '2020-02-23T09:00:00+03:00',
        'People' => ''
      ],
      // group
      [
        'Schedule' => AFTERNOON_ES,
        'Type' => GROUP_TRIP_ES,
        'Start_DateTime' => '2020-02-24T09:00:00+03:00',
        'People' => '3'
      ],

      [
        'Schedule' => AFTERNOON_ES,
        'Type' => GROUP_TRIP_ES,
        'Start_DateTime' => '2020-03-01T15:00:00+03:00',
        'People' => '5'
      ],
      // past event
      [
        'Schedule' => AFTERNOON_ES,
        'Type' => GROUP_TRIP_ES,
        'Start_DateTime' => '2012-03-01T15:00:00+03:00',
        'People' => '1'
      ],
    ];
  }

}