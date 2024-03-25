<?php

namespace App\Http\Classes;

abstract class Status {
    const CANCELLED = 0;
    const PLANNED = 1;
    const WORKING = 2;
    const ASSIGNED = 3;
    const APPROVED = 4;
    const ACTIVE = 5;
    const COMPLETE = 6;
}
