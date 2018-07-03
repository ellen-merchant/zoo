<?php

namespace App\Http\ViewComposers;

use App\Zoo\ZooTimeInterface;
use Illuminate\View\View;

class ZooTimeComposer
{
    /**
     * @var ZooTimeInterface
     */
    private $zooTime;

    /**
     * ZooTimeComposer constructor.
     * @param ZooTimeInterface $zooTime
     */
    public function __construct(ZooTimeInterface $zooTime)
    {
        $this->zooTime = $zooTime;
    }

    /**
     * Bind data to the view.
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('currentZooTime', $this->zooTime->establishZooTime())
            ->with('defaultZooTime', $this->zooTime->getDefaultTime());
    }
}