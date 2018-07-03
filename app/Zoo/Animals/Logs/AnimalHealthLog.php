<?php

namespace App\Zoo\Animals\Logs;

use Illuminate\Database\Eloquent\Model;

class AnimalHealthLog extends Model
{
    protected $dates = ['zoo_time'];
}