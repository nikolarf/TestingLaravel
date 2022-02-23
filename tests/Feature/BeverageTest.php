<?php

namespace Tests\Feature;

use App\User;
use App\Beverage;
use Tests\TestCase;
use PHPUnit\Framework\Test;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    private $beverage;

    public function setup(){

        parent::setUp();

        $this->beverage = factory(Beverage::class)->create();

    }


    /**
     * A basic test example.
     * @test
     * @return void
     */

    public function a_user_can_visit_beverage_page_and_visit_beverages(){

        $response = $this->get('/beverage');

        $response->assertSee($this->beverage->name);

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_visit_a_single_beverage_page(){

        $response = $this->get('/beverage/' . $this->beverage->id);

        $response->assertSee($this->beverage->name);

        $response->assertStatus(200);

    }

    /** @test */
    public function a_logged_in_user_can_buy_beverage(){

        $user = factory(User::class)->make();
        $this->actingAs($user);

        $data = [
            'beverage_id' => $this->beverage->id,
            'price' => 200
        ];

        $response = $this->post('/beverage/buy', $data);

        $this->assertDatabaseHas('purchases', $data);

        $response->assertStatus(201);

    }

}
