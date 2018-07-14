<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RoutesTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                    ->assertSee('Get up to 30% Off New Arrivals');
        });


    }

    public function testContact()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/contact')
                ->assertSee('Contact Us');
        });
    }

    public function testCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/category/shoes')
                ->assertSee('Shoes');
        });
    }

    public function testProductDetail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/product/shoes-1')
                ->assertSee('Shoes 1');
        });
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login');
        });
    }

    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Register');
        });
    }

    public function testPasswordReset()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/password/reset')
                ->assertSee('Reset Password');
        });

    }

    public function testBasket()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/basket')
                ->assertSee('BASKET');
        });
    }


    public function testAdminUsers()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->value('#email', 'admin@admin.com')
                ->value('#password', 'admin')
                ->press('Login')
                ->assertPathIs('/login')
                ->clickLink('Users')
                ->assertSee('Admin');
        });
    }

    public function testAdminCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->clickLink('Category')
                ->assertSee('Category Name');
        });
    }

    public function testAdminProducts()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->clickLink('Products')
                ->assertSee('Add a New Product');
        });
    }

    


}
