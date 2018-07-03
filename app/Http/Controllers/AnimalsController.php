<?php

namespace App\Http\Controllers;

use App\Zoo\Animals\UpdateAnimalsHealth;
use App\Zoo\Animals\RetrieveAnimals;
use App\Zoo\ZooTimeInterface;

class AnimalsController extends Controller
{
    /**
     * @var UpdateAnimalsHealth
     */
    private $updateAnimalsHealth;

    /**
     * AnimalsController constructor.
     * @param UpdateAnimalsHealth $updateAnimalsHealth
     */
    public function __construct(UpdateAnimalsHealth $updateAnimalsHealth)
    {
        $this->updateAnimalsHealth = $updateAnimalsHealth;
    }

    /**
     * @param RetrieveAnimals $retrieveAnimals
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RetrieveAnimals $retrieveAnimals)
    {
        $animals = $retrieveAnimals->paginate();

        return view('animals.index', compact('animals'));
    }

    public function reduceHealth(ZooTimeInterface $zooTime)
    {
        $zooTime->increaseZooTimeHours();

        $this->updateAnimalsHealth->reduce();

        return redirect()->route('animals.index')->with('message', trans('animals.health.reduced.message'));
    }

    public function feed()
    {
        $this->updateAnimalsHealth->increase();

        return redirect()->route('animals.index')->with('message', trans('animals.health.increased.message'));
    }
}