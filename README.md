[![Issues](https://img.shields.io/github/issues/anilozmen/Laravel-Ecommerce-Iyzico.svg)](https://github.com/anilozmen/Laravel-Ecommerce-Iyzico/issues)
[![Star](https://img.shields.io/github/stars/anilozmen/Laravel-Ecommerce-Iyzico.svg?style=social&label=Stars)](https://github.com/anilozmen/Laravel-Ecommerce-Iyzico/stargazers)
[![Follow](https://img.shields.io/github/followers/anilozmen.svg?style=social&label=Follow)](https://github.com/anilozmen/)
[![Licence](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/anilozmen/Laravel-Ecommerce-Iyzico/master/LICENSE)


![Laravel Ecommerce Iyzico](https://anilozmen.github.io/laravel-ecommerce-iyzico.gif)


## Laravel Ecommerce + Iyzico
#### Framework Used: Laravel 5.6

Iyzico intigrated e-Commerce system that could be developed easily in simple level.


### Installation
1. Clone the repo and `cd` into it.
2. Open the terminal and write this command `composer install`
3. Rename or copy `.env.example` file to `.env` and write required database information.
4. Run `php artisan key:generate` command.
5. With `php artisan migrate` command, create the tables.
6. `php artisan db:seed` method to run other seed classes.

### Iyzico Settings
1. Enter your `setApiKey(), setSecretKey(), setBaseUrl()` information in `App/Services/PaymentService` . 

### Features

- Multiple Product Images
- Unlimited Categories
- Unlimited Products
- Virtual POS ( [IYZICO](https://www.iyzico.com/) )
- Shopping Cart
- Dynamic Breadcrumbs
- Add any item to the cart + AJAX
- Ability to checkout the pay
- Membership is required to make a payment
- Being able to see your orders
- Editing profile information etc. (address, telephone)
- Responsivity


## Demo
- **[http://ecommerce.anilozmen.com.tr](http://ecommerce.anilozmen.com.tr/)**
-  Admin: [admin@admin.com] / admin
- User: [user@user.com] / user 

## Packages Used

1. [cviebrock/eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable)
2. [gloudemans/shoppingcart](https://github.com/Crinsane/LaravelShoppingcart)
3. [intervention/image](https://github.com/Intervention/image)
4. [iyzico/iyzipay-php](https://github.com/iyzico/iyzipay-php)
5. [laravelcollective/html](https://github.com/LaravelCollective/html)

## Template 
[COLOSHOP](https://colorlib.com/etc/coloshop/index.html#)
 
## Do you want to support?
Why dont you give star to my Github repo and share my repo in social media?
 
[Twitter](https://twitter.com/Anilozmenn)  [Website](https://anilozmen.com)
 
 
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


