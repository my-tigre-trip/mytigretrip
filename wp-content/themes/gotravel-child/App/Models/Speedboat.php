<?php

namespace App\Models;

use App\Models\BaseTrip;

class Speedboat extends BaseTrip
{
    public function __construct()
    {
      //
        $this->boat = 'speedboat';
    }
}
