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
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/register')
                    ->assertSee('Đăng kí')
                    ->assertSee('Đăng nhập')
                    ->assertPresent('input[name="name"]')
                    ->assertPresent('input[name="email"]')
                    ->assertPresent('input[name="phone"]')
                    ->assertPresent('input[name="address"]')
                    ->assertPresent('#password')
                    ->assertPresent('#password_confirmation')
                    ->assertPresent('#register');
            }
        );
    }

    public function testRegisterPasswordFail()
    {
        $this->browse(
            function (Browser $browser) {
                $faker = Factory::create();
                $password = $faker->password;
                $browser->visit('/register')
                    ->type('name', $faker->name)
                    ->type('email', $faker->email)
                    ->type('phone', $faker->numerify('##########'))
                    ->type('address', $faker->address)
                    ->type('password', $password)
                    ->type('password_confirmation', $faker->password)
                    ->click('#register');

                $browser->assertSee('không khớp')
                    ->pause(2000)
                    ->assertPathIs('/register');
            }
        );
    }

    public function testRegisterNameFail()
    {
        $this->browse(
            function (Browser $browser) {
                $faker = Factory::create();
                $password = $faker->password;
                $browser->visit('/register')
                    ->type('name', 'abc')
                    ->type('email', $faker->email)
                    ->type('phone', $faker->numerify('##########'))
                    ->type('address', $faker->address)
                    ->type('password', $password)
                    ->type('password_confirmation', $password)
                    ->click('#register');

                $browser->assertSee('tối thiểu')
                    ->pause(2000)
                    ->assertPathIs('/register');
            }
        );
    }

    public function testRegisterEmailFail()
    {
        $this->browse(
            function (Browser $browser) {
                $faker = Factory::create();
                $password = $faker->password;
                $browser->visit('/register')
                    ->type('name', $faker->name)
                    ->type('email', 'a@a.com')
                    ->type('phone', $faker->numerify('##########'))
                    ->type('address', $faker->address)
                    ->type('password', $password)
                    ->type('password_confirmation', $password)
                    ->click('#register');

                $browser->assertSee('13 kí tự')
                    ->pause(2000)
                    ->assertPathIs('/register');
            }
        );
    }

    public function testRegisterPhoneFail()
    {
        $this->browse(
            function (Browser $browser) {
                $faker = Factory::create();
                $password = $faker->password;
                $browser->visit('/register')
                    ->type('name', $faker->name)
                    ->type('email', $faker->email)
                    ->type('phone', 123)
                    ->type('address', $faker->address)
                    ->type('password', $password)
                    ->type('password_confirmation', $password)
                    ->click('#register');

                $browser->assertSee('10 chữ số')
                    ->pause(2000)
                    ->assertPathIs('/register');
            }
        );
    }

    public function testRegisterAddressFail()
    {
        $this->browse(
            function (Browser $browser) {
                $faker = Factory::create();
                $password = $faker->password;
                $browser->visit('/register')
                    ->type('name', $faker->name)
                    ->type('email', $faker->email)
                    ->type('phone', $faker->numerify('##########'))
                    ->type('address', 'abc')
                    ->type('password', $password)
                    ->type('password_confirmation', $password)
                    ->click('#register');

                $browser->assertSee('tối thiểu')
                    ->pause(2000)
                    ->assertPathIs('/register');
            }
        );
    }

    public function testRegister()
    {
        $this->browse(
            function (Browser $browser) {
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
            }
        );
    }
}
