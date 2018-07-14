<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testAllUserLogin()
    {
        $users = User::all();
        foreach($users as $user) {
            $this->browse(function ($browser) use ($user) {
                $browser->loginAs($user)
                    ->visit('/home')
                    ->assertSee('Get up to 30% Off New Arrivals')
                    ->clickLink('Logout');
            });
        }
    }

    public function testRegister()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->value('#name', 'TEST')
                ->value('#surname', 'TEST')
                ->value('#email', 'test@test.com')
                ->value('#password', '123456')
                ->value('#password-confirm', '123456')
                ->press('Register')
                ->assertPathIs('/register');
        });
    }
}
