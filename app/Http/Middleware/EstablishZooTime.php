<?php

namespace App\Http\Middleware;

use App\Zoo\ZooTimeInterface;
use Closure;

class EstablishZooTime
{
    /**
     * @var ZooTimeInterface
     */
    private $zooTime;

    /**
     * EstablishZooTimeCache constructor.
     * @param ZooTimeInterface $zooTime
     */
    public function __construct(ZooTimeInterface $zooTime)
    {
        $this->zooTime = $zooTime;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->zooTime->establishZooTime();

        return $next($request);
    }
}
