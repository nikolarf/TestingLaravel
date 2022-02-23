<?php

namespace Tests\Unit;

use App\Beverage;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\MinorCannotBuyAlcoholicBeverageException;

class BeverageTest extends TestCase
{
    use DatabaseMigrations;

    private $beverage;
    
    public function setup(){
        
        parent::setup();

        $this->beverage = factory(Beverage::class)->make();

    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function beverage_has_name()
    {
        $this->assertNotEmpty($this->beverage->name);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function beverage_has_type()
    {
        $this->assertNotEmpty($this->beverage->type);
    }

    /** @test */
    public function a_minor_user_can_not_buy_alcoholic_beverage(){
        $this->beverage = factory(Beverage::class)->make([
            'type' => 'Alcoholic'
        ]);

        $user = factory(User::class)->make([
            'age' => '17'
        ]);
        
        $this->actingAs($user);

        $this->expectException(MinorCannotBuyAlcoholicBeverageException::class);

        $this->beverage->buy();
        
    }
}
