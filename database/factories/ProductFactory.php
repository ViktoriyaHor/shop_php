<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//use App\Model;
use App\Product;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
	$id = Category::all('id')->random()->id;
	//айдишники категорий, в методе all можем узнать определенные данные
	//В категори контроллере можем вывести и проверить $ids = Category::all('id')->random(); dd($ids);/random дает одну случайную категорию из коллекции
    return [
        'name' => $faker->words(3, true),
        'slug' => $faker->slug(3),
        'price' => $faker->randomFloat(2, 1, 10000),
        'img' => $faker->imageUrl(),//все смотрим на https://github.com/fzaninotto/Faker
        'description' => $faker->text(),
        'quantity' => rand(0, 10),
        'recommended' => rand(0, 1),
        'created_at' => $faker->dateTime(),
        'category_id' => $id,//из random()->id

    ];
});
