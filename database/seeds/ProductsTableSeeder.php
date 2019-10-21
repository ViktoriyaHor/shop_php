<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //какое кол-во раз мы хотим повторить "посев"
        //тут запускаем фабрику, т.е. сколько товаров загрузить
        //https://laravel.com/docs/6.0/seeding
        factory(App\Product::class, 50)->create();
        //после этого php artisan db:seed
    }
}
