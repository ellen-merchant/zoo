<?php

namespace App\Zoo;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ZooTime implements ZooTimeInterface
{
    const CACHE_KEY = "zoo_time";

    /**
     * Get the current zoo time or set to the default time
     * @return Carbon
     */
    public function establishZooTime(): Carbon
    {
        if (Cache::has(static::CACHE_KEY)) {
            return Cache::get(static::CACHE_KEY);
        }

        return $this->setDefaultTime();
    }

    /**
     * Set the default zoo time, only assessed if we cannot retrieve the current zoo time, e.g. when establishing the zoo time
     * @return Carbon
     */
    private function setDefaultTime(): Carbon
    {
        $defaultTime = $this->getDefaultTime();

        Cache::forever(static::CACHE_KEY, $defaultTime);

        return $defaultTime;
    }

    /**
     * Allow the user to increase the zoo time by the number of hours specified, default is 1 hour
     * @param int $hours
     */
    public function increaseZooTimeHours($hours = 1)
    {
        Cache::forever(static::CACHE_KEY, $this->establishZooTime()->addHours($hours));
    }

    /**
     * What we set the starting time to
     * @return Carbon
     */
    public function getDefaultTime(): Carbon
    {
        return Carbon::createFromTimestamp(0);
    }
}