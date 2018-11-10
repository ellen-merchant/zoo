<?php

namespace Tests\Feature;

use App\Zoo\Animals\Animal;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimalsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testPageLoads()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSeeText("Animals Coding Test - Ellen Merchant");
    }

    /**
     * @test
     */
    public function testNoResults()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSeeText("No animals have been entered into the database. Please follow the install instructions to continue.");
    }

    /**
     * @test
     */
    public function testCanSeeResults()
    {
        factory(Animal::class, 2)->create([
            'breed_id' => 1
        ]);
        factory(Animal::class, 2)->create([
            'breed_id' => 2
        ]);
        factory(Animal::class, 2)->create([
            'breed_id' => 3
        ]);

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSeeTextInOrder([
                'Monkey',
                'Monkey',
                'Giraffe',
                'Giraffe',
                'Elephant',
                'Elephant',
            ]);
    }

    /**
     * @test
     */
    public function testPagination()
    {
        factory(Animal::class, 4)->create([
            'breed_id' => 1
        ]);
        factory(Animal::class, 4)->create([
            'breed_id' => 2
        ]);
        factory(Animal::class, 4)->create([
            'breed_id' => 3
        ]);

        $response = $this->get('/?page=2');

        $response->assertStatus(200)
            ->assertSeeTextInOrder([
                'Elephant',
                'Elephant',
            ])
            ->assertDontSeeText('Monkey')
            ->assertDontSeeText('Giraffe');
    }
}
