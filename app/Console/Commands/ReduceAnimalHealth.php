<?php

namespace App\Console\Commands;

use App\Zoo\Animals\UpdateAnimalsHealth;
use Illuminate\Console\Command;

class ReduceAnimalHealth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animals:reduce_health';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A random value between 0 and 20 is to be generated for each animal. This value should be
        passed to the appropriate animal, whose health is then reduced by that percentage of their current health.';
    /**
     * @var UpdateAnimalsHealth
     */
    private $reduceAllAnimalsHealth;

    /**
     * Create a new command instance.
     * @param UpdateAnimalsHealth $reduceAllAnimalsHealth
     */
    public function __construct(UpdateAnimalsHealth $reduceAllAnimalsHealth)
    {
        parent::__construct();
        $this->reduceAllAnimalsHealth = $reduceAllAnimalsHealth;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->reduceAllAnimalsHealth->reduce();
    }
}
