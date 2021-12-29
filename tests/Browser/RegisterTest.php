<?php

namespace Tests\Browser;

use Faker\Factory;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testGoToRegisterPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Đăng kí')
                ->assertPresent('input[name="name"]')
                ->assertPresent('input[name="email"]')
                ->assertPresent('input[name="phone"]')
                ->assertPresent('input[name="address"]')
                ->assertPresent('#password')
                ->assertPresent('#password_confirmation')
                ->assertPresent('#register');
        });
    }

    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $faker = Factory::create();
            $name = $faker->name;
            $password = $faker->password;
            $browser->visit('/register')
                    ->type('name', $name)
                    ->type('email', $faker->email)
                    ->type('phone', $faker->numerify('##########'))
                    ->type('address', $faker->address)
                    ->type('password', $password)
                    ->type('password_confirmation', $password)
                    ->click('#register');

            $browser->assertSee($name)
                    ->assertPathIs('/');
        });
    }
}
