<?php

namespace App\Zoo;

use Carbon\Carbon;

interface ZooTimeInterface
{
    /**
     * Get the current zoo time or set to the default time
     * @return Carbon
     */
    public function establishZooTime(): Carbon;

    /**
     * Allow the user to increase the zoo time by the number of hours specified, default is 1 hour
     * @param int $hours
     */
    public function increaseZooTimeHours($hours = 1);

    /**
     * What we set the starting time to
     * @return Carbon
     */
    public function getDefaultTime(): Carbon;
}