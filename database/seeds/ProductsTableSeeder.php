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
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'iPhone X 64GB 2',
                'code' => 'iphone_x_64',
                'description' => 'Отличный продвинутый телефон с памятью на 64 gb',
                'image' => 'products/iphone_x.jpg',
                'price' => 71990,
            ],
            [
                'category_id' => 1,
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'description' => 'Отличный продвинутый телефон с памятью на 256 g',
                'image' => 'products/iphone_x_silver.jpg',
                'price' => 89990,
            ],
            [
                'category_id' => 1,
                'name' => 'HTC One S',
                'code' => 'htc_one_s',
                'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'image' => 'products/htc_one_s.png',
                'price' => 12490,
            ],
            [
                'category_id' => 1,
                'name' => 'iPhone 5SE',
                'code' => 'iphone_5se',
                'description' => 'Отличный классический iPhone',
                'image' => 'products/iphone_5.jpg',
                'price' => 17221,
            ],
            [
                'category_id' => 2,
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'description' => 'Отличный звук от Dr. Dre',
                'image' => 'products/beats.jpg',
                'price' => 20221,
            ],
            [
                'category_id' => 2,
                'name' => 'Камера GoPro',
                'code' => 'gopro',
                'description' => 'Снимай самые яркие моменты с помощью этой камеры',
                'image' => 'products/gopro.jpg',
                'price' => 20221,
            ],
            [
                'category_id' => 2,
                'name' => 'Камера Panasonic HC-V770',
                'code' => 'panasonic_hc-v770',
                'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                'image' => 'products/video_panasonic.jpg',
                'price' => 27900,
            ],
            [
                'category_id' => 3,
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'description' => 'Хорошее утро начинается с хорошего кофе!',
                'image' => 'products/delongi.jpg',
                'price' => 25200,
            ],
            [
                'category_id' => 3,
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'description' => 'Для большой семьи большой холодильник!',
                'image' => 'products/haier.jpg',
                'price' => 40200,
            ],
            [
                'category_id' => 3,
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых идей',
                'image' => 'products/moulinex.jpg',
                'price' => 4200,
            ],
            [
                'category_id' => 3,
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'image' => 'products/bosch.jpg',
                'price' => 9200,
            ],
            [
                'category_id' => 1,
                'name' => 'Samsung Galaxy J6',
                'code' => 'samsung_j6',
                'description' => 'Современный телефон начального уровня',
                'image' => 'products/samsung_j6.jpg',
                'price' => 11980,
            ],
        ]);
    }
}
