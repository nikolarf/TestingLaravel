<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserModelTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function user_has_full_name_attribute()
    {
        // create user
        $user = User::create([
            'firstname' => 'Nikola',
            'lastname' => 'Raf',
            'email' => 'test@test.com',
            'password' => 'secret',
        ]);
        // user has full name
        $this->assertEquals('Nikola Raf', $user->fullname);
    }
}
