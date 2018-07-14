<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->value('#email', 'admin@admin.com')
                ->value('#password', 'admin')
                ->press('Login')
                ->clickLink('Products')
                ->assertSee('Add a New Product')
                ->clickLink('Add a New Product')
                ->assertSee('Product Image')
                ->attach('img[]', storage_path('app/public/testing/test_upload.png'))
                ->select('category_id', '1')
                ->value('#product_name', 'TEST')
                ->value('#original_price', '150')
                ->value('#product_price', '100')
                ->value('#product_detail', 'TEST DETAIL')
                ->click('@btn-save')
                ->assertSee('LARAVEL');
        });
    }

    public function testProductDelete() {
        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/admin-products/2');
        $this->assertEquals(302, $response->getStatusCode());
    }


    public function testUpdateProduct()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('admin-products/1/edit')
                ->attach('img[]', storage_path('app/public/testing/edit_test_upload.jpg'))
                ->select('category_id', '2')
                ->value('#product_name', 'TEST EDIT')
                ->value('#original_price', '1500')
                ->value('#product_price', '1000')
                ->value('#product_detail', 'TEST DETAIL EDIT')
                ->press('Update');
        });
    }

}
