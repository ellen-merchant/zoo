# Zoo Coding Test
[![Build Status](https://travis-ci.com/ellllllen/zoo.svg?branch=master)](https://travis-ci.com/ellllllen/zoo)

## Specification
Write a simple Zoo simulator which contains 3 different types of animal: monkey,
giraffe and elephant. The zoo should open with 5 of each type of animal.
Each animal has a health value held as a percentage (100% is completely healthy).

Every animal starts at 100% health. This value should be a floating point value.
The application should act as a simulator, with time passing at the rate of 1 hour
with each interation. Every hour that passes, a random value between 0 and 20 is to be
generated for each animal. This value should be passed to the appropriate animal, whose
health is then reduced by that percentage of their current health.

The user must be able to feed the animals in the zoo. When this happens, the zoo
should generate three random values between 10 and 25; one for each type of animal. The
health of the respective animals is to be increased by the specified percentage of their
current health. Health should be capped at 100%.

When an Elephant has a health below 70% it cannot walk. If its health does not
return above 70% once the subsequent hour has elapsed, it is pronounced dead.
When a Monkey has a health below 30%, or a Giraffe below 50%, it is pronounced
dead straight away.

The user interface should show the current status of each Animal and contain two
buttons, one to provoke an hour of time to pass and another to feed the zoo. The UI should
update to reflect each change in state, and the current time at the zoo.

## Technologies used
* PHP 7.2
* Laravel 5.6
* Bootstrap
* SaSS
* MySQL

## Assumptions
* The float on the Animal's health is limited to 2 decimals places by default. This can be reconfigured within the configuration file (config/animals.php)
* Logs have been made to ensure calculations have be done correctly, they are not currently used in the application

## Developer Notes
This application can be developed further if the specification is changed or enhanced. Please follow these instructions
to set up your development environment: 

`composer update`

`npm install`

`npm run development`

`php artisan migrate --seed`


### How to add a new Breed
Seed the new Breed using the `BreedsTableSeeder` class. If you want the deceased level (the health limit that the Animal can decline to before is becomes deceased) to come from the Breed, enter a percentage into the deceased_level column. Otherwise create a new class within the App\Zoo\Animals\UniqueAnimals folder and implement the `App\Zoo\Breeds\Contracts\UniqueBreedDeceasedHealth` interface, this class should be named after the Breed name.

## Future Developments
* PHPUnit tests
* Send alerts when an Animal's health declines via different communication types, e.g. email
* Asynchronous (AJAX) loading when feeding and reducing health buttons are pressed
* Search the Animals
* Have a reset button to restart the simulation
* Authentication to track user's progress - this will also allow for multiple simulations to be played at teh same time
* UI Improvements - Feedback after simulation buttons are submitted, health bar against each animal with colour coding
* Implement presenters instead of the presenting code being placed in the models
* Home page with instructions
 
