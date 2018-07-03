<?php

namespace App\Zoo\Breeds;

use App\Zoo\Animals\Animal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Emoji\Emoji;

class Breed extends Model
{
    /**
     * @return HasMany
     */
    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    /**
     * Determine if the animal is deceased or not
     */
    public function getDeceasedLowerLimit()
    {
        if ($this->deceased_health) {
            return $this->deceased_health;
        }

        return;
    }

    public function presentIcon(): string
    {
        switch ($this->id) {
            case 1:
                return Emoji::CHARACTER_MONKEY;
                break;
            case 2:
                return "\u{1F992}";
                break;
            case 3:
                return Emoji::CHARACTER_ELEPHANT;
                break;
        }

        return "";
    }
}