<?php

namespace App\Http\Classes;

abstract class Status {
    const CANCELLED = 0;
    const PLANNED = 1;
    const WORKING = 2;
    const APPROVED = 3;
    const ACTIVE = 4;
    const COMPLETE = 5;
}
