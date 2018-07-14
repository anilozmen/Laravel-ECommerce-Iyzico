<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    /** @test */
    public function testCreateCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->value('#email', 'admin@admin.com')
                ->value('#password', 'admin')
                ->press('Login')
                ->assertPathIs('/login')
                ->clickLink('Category')
                ->clickLink('Add a New Category')
                ->assertSee('Category Name')
                ->value('#category_name', 'TEST CATEGORY')
                ->press('Save')
                ->assertSee('ID');
        });
    }

    public function testDeleteCategory() {
        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/admin-category/1');
        $this->assertEquals(302, $response->getStatusCode());
    }


    public function testUpdateCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('admin-category/1/edit')
                ->value('#category_name', 'CATEGORY NAME EDIT')
                ->press('Update');
        });
    }


}
