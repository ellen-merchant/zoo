<?php

namespace App\Providers;

use App\Http\ViewComposers\ZooTimeComposer;
use App\Zoo\Animals\Animals;
use App\Zoo\Breeds\Breeds;
use App\Zoo\Breeds\Contracts\BreedRepositoryInterface;
use App\Zoo\ZooTime;
use App\Zoo\ZooTimeInterface;
use Illuminate\Support\ServiceProvider;
use App\Zoo\Animals\Contracts\AnimalRepositoryInterface;
use App\Zoo\Animals\Contracts\UpdateAnimalInterface;
use App\Zoo\Animals\UpdateAnimal;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //make the zoo time available to all views as it is part of the layout
        view()->composer(
            '*', ZooTimeComposer::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //repositories
        $this->app->bind(AnimalRepositoryInterface::class, Animals::class);
        $this->app->bind(BreedRepositoryInterface::class, Breeds::class);

        //service classes
        $this->app->bind(UpdateAnimalInterface::class, UpdateAnimal::class);
        $this->app->bind(ZooTimeInterface::class, ZooTime::class);
    }
}
