<?php

namespace App\Zoo\Animals;

use App\Zoo\Breeds\Breed;
use App\Zoo\Breeds\Contracts\UniqueBreedDeceasedHealth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;

    const HEALTH_UPPER_LIMIT = 100;
    const HEALTH_LOWER_LIMIT = 0;

    /**
     * Relationship with breeds table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    /**
     * Determine if the animal is at full health or not
     * @return bool
     */
    public function hasFullHealth(): bool
    {
        if ($this->current_health >= static::HEALTH_UPPER_LIMIT) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the animal is deceased or not
     * @return bool
     */
    public function isDeceased(): bool
    {
        //if the deceased limit is determined by the breed
        if ($this->breed->getDeceasedLowerLimit()) {
            if ($this->current_health < $this->breed->getDeceasedLowerLimit()) {
                return true;
            }

            return false;
        }

        //if the animal has an unique way of calculating whether they are deceased
        if ($uniqueBreedClass = $this->getUniqueAnimalClass()) {
            return app($uniqueBreedClass)->isDeceased($this);
        }

        //for default purposes if no deceased limit is provided for the breed and no unique animal class is provided
        if ($this->current_health <= static::HEALTH_LOWER_LIMIT) {
            return true;
        }

        return false;
    }

    /**
     * Set the current health to a range of 0 to 100 and formatting into a float
     * @param $value
     */
    public function setCurrentHealthAttribute($value)
    {
        if ($value > static::HEALTH_UPPER_LIMIT) {
            $value = static::HEALTH_UPPER_LIMIT;
        }

        if ($this->isDeceased()) {
            $value = static::HEALTH_LOWER_LIMIT;
        }

        $this->attributes['current_health'] = number_format($value, config('animals.current-health-decimal-points'));
    }

    /**
     * Get the current status of each animal
     * @return string
     */
    public function getCurrentStatus(): string
    {
        if ($this->isDeceased()) {
            return trans('animals.status.deceased');
        }

        //if the animal has an unique way of calculating the animal's health status
        if ($uniqueBreedClass = $this->getUniqueAnimalClass()) {
            return app($uniqueBreedClass)->getCurrentStatus($this);
        }

        //otherwise the animal must be healthy
        return trans('animals.status.healthy');
    }

    /**
     * Determine if the breed has an unique animal class, i.e. has unique rules against the breed
     * @return string|void
     */
    private function getUniqueAnimalClass()
    {
        //if the breed has a different way of calculating the deceased lower limit - call individual breed classes
        $uniqueBreedClass = "App\Zoo\Animals\UniqueAnimals\\" . $this->breed->name;
        if (class_exists($uniqueBreedClass)) {
            if (app($uniqueBreedClass) instanceof UniqueBreedDeceasedHealth) {
                return $uniqueBreedClass;
            }
        }

        return;
    }

    /**
     * Present as a percentage
     * @return string
     */
    public function presentCurrentHealth(): string
    {
        return $this->current_health . "%";
    }
}