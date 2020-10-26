<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            [
                'name' => 'Цвет',
                'name_en' => 'color',
                'options' => [
                    [
                        'name' => 'Черный',
                        'name_en' => 'Black',
                    ],
                    [
                        'name' => 'Белый',
                        'name_en' => 'White',
                    ],
                    [
                        'name' => 'Синий',
                        'name_en' => 'Blue',
                    ],
                    [
                        'name' => 'Серебристый',
                        'name_en' => 'Silver',
                    ],
                    [
                        'name' => 'Золотой',
                        'name_en' => 'Gold',
                    ],
                    [
                        'name' => 'Красный',
                        'name_en' => 'Red',
                    ],
                ],
            ],
            [
                'name' => 'Размер памяти',
                'name_en' => 'Memory size',
                'options' => [
                    [
                        'name' => '16Гб',
                        'name_en' => '16Gb',
                    ],
                    [
                        'name' => '32Гб',
                        'name_en' => '32Gb',
                    ],
                    [
                        'name' => '64Гб',
                        'name_en' => '64Gb',
                    ],
                    [
                        'name' => '256Гб',
                        'name_en' => '256Gb',
                    ],
                ],
            ],
        ];

        foreach ($properties as $category) {
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();

            $propertyOptions = $category['options'];
            unset($category['options']);

            $propertyId = DB::table('properties')->insertGetId($category);

            foreach ($propertyOptions as $product) {
                $product['created_at'] = Carbon::now();
                $product['updated_at'] = Carbon::now();
                $product['property_id'] = $propertyId;
                DB::table('property_options')->insert($product);
            }
        }

        $categories = [
            [
                'name' => 'Мобильные телефоны',
                'name_en' => 'Mobiles phones',
                'code' => 'mobiles',
                'description' => 'В этом разделе вы найдёте самые популярные мобильные телефоны по отличным ценам!',
                'description_en' => 'In this section you will find the most popular mobile phones at great prices!',
                'image' => 'categories/mobile.jpg',
                'products' => [
                    [
                        'name' => 'iPhone X 64GB 2',
                        'name_en' => 'iPhone X 64GB 2 EN',
                        'code' => 'iphone_x_64',
                        'description' => 'Отличный продвинутый телефон с памятью на 64 gb',
                        'description_en' => 'Excellent advanced phone with 64 gb memory',
                        'image' => 'products/iphone_x.jpg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 9,
                            ],
                            [
                                2, 9,
                            ],
                            [
                                4, 9,
                            ],
                            [
                                5, 9,
                            ],
                        ],
                    ],
                    [
                        'name' => 'iPhone X 256GB',
                        'name_en' => 'iPhone X 256GB EN',
                        'code' => 'iphone_x_256',
                        'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
                        'description_en' => 'Excellent advanced phone with 256 gb memory',
                        'image' => 'products/iphone_x_silver.jpg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 10,
                            ],
                            [
                                2, 10,
                            ],
                            [
                                4, 10,
                            ],
                            [
                                5, 10,
                            ],
                        ],
                    ],
                    [
                        'name' => 'HTC One S',
                        'name_en' => 'HTC One S EN',
                        'code' => 'htc_one_s',
                        'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                        'description_en' => 'Why pay for excess? Legendary HTC One S',
                        'image' => 'products/htc_one_s.png',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                        ],
                    ],
                    [
                        'name' => 'iPhone 5SE',
                        'name_en' => 'iPhone 5SE EN',
                        'code' => 'iphone_5se',
                        'description' => 'Отличный классический iPhone',
                        'description_en' => 'Great classic iPhone',
                        'image' => 'products/iphone_5.jpg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 7,
                            ],
                            [
                                2, 8,
                            ],
                            [
                                1, 7,
                            ],
                            [
                                2, 8,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Samsung Galaxy J6',
                        'name_en' => 'Samsung Galaxy J6 EN',
                        'code' => 'samsung_j6',
                        'description' => 'Современный телефон начального уровня',
                        'description_en' => 'Modern entry-level phone',
                        'image' => 'products/samsung_j6.jpg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Портативная техника',
                'name_en' => 'Portable equipment',
                'code' => 'portable',
                'description' => 'Раздел с портативной техникой.',
                'description_en' => 'Section with portable equipment.',
                'image' => 'categories/portable.jpg',
                'products' => [
                    [
                        'name' => 'Камера GoPro',
                        'name_en' => 'GoPro camera',
                        'code' => 'gopro',
                        'description' => 'Снимай самые яркие моменты с помощью этой камеры',
                        'description_en' => 'Capture your highlights with this camera',
                        'image' => 'products/gopro.jpg',
                    ],
                    [
                        'name' => 'Камера Panasonic HC-V770',
                        'name_en' => 'Panasonic HC-V770 camera',
                        'code' => 'panasonic_hc-v770',
                        'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                        'description_en' => 'Serious video shooting requires a serious camera. Panasonic HC-V770 is the best choice for these purposes!',
                        'image' => 'products/video_panasonic.jpg',
                    ],
                    [
                        'name' => 'Наушники Beats Audio',
                        'name_en' => 'Beats Audio earphones',
                        'code' => 'beats_audio',
                        'description' => 'Отличный звук от Dr. Dre',
                        'description_en' => 'Great sound from Dr. Dre',
                        'image' => 'products/beats.jpg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                3,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Бытовая техника',
                'name_en' => 'Household appliances',
                'code' => 'appliances',
                'description' => 'Раздел с бытовой техникой',
                'description_en' => 'Section with household appliances',
                'image' => 'categories/appliance.jpg',
                'products' => [
                    [
                        'name' => 'Кофемашина DeLongi',
                        'name_en' => 'DeLongi coffee machine',
                        'code' => 'delongi',
                        'description' => 'Хорошее утро начинается с хорошего кофе!',
                        'description_en' => 'A good morning starts with good coffee!',
                        'image' => 'products/delongi.jpg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Холодильник Haier',
                        'name_en' => 'Refrigerator Haier',
                        'code' => 'haier',
                        'description' => 'Для большой семьи большой холодильник!',
                        'description_en' => 'A large refrigerator for a large family!',
                        'image' => 'products/haier.jpg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                4,
                            ],
                            [
                                6,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Блендер Moulinex',
                        'name_en' => 'Blender Moulinex',
                        'code' => 'moulinex',
                        'description' => 'Для самых смелых идей',
                        'description_en' => 'For the most daring ideas',
                        'image' => 'products/moulinex.jpg',
                    ],
                    [
                        'name' => 'Мясорубка Bosch',
                        'name_en' => 'Meat grinder Bosch',
                        'code' => 'bosch',
                        'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                        'description_en' => 'Do you like homemade cutlets? You should definitely take a look at this meat grinder!',
                        'image' => 'products/bosch.jpg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                6,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($categories as $category) {
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();

            $products = $category['products'];
            unset($category['products']);

            $categoryId = DB::table('categories')->insertGetId($category);

            foreach ($products as $product) {
                foreach (['hit', 'new', 'recommend'] as $item) {
                    $product[$item] = ($item == 'hit') ? !boolval(rand(0, 3)) : rand(0, 1);
                }
                $product['created_at'] = Carbon::now();
                $product['updated_at'] = Carbon::now();
                $product['category_id'] = $categoryId;

                if (isset($product['properties'])) {
                    $properties = $product['properties'];
                    unset($product['properties']);
                    $skusOptions = $product['options'];
                    unset($product['options']);
                }

                $productId = DB::table('products')->insertGetId($product);

                if (isset($properties) && isset($skusOptions)) {
                    foreach ($properties as $propertyId) {
                        DB::table('property_product')->insert([
                            'product_id' => $productId,
                            'property_id' => $propertyId,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }

                    foreach ($skusOptions as $skuOptions) {
                        $skuId = DB::table('skus')->insertGetId([
                            'product_id' => $productId,
                            'count' => rand(0, 10),
                            'price' => rand(1000, 50000),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        foreach ($skuOptions as $skuOption) {
                            $skuData['sku_id'] = $skuId;
                            $skuData['property_option_id'] = $skuOption;
                            $skuData['created_at'] = Carbon::now();
                            $skuData['updated_at'] = Carbon::now();
                            DB::table('sku_property_option')->insert($skuData);
                        }
                    }

                    unset($properties);
                    unset($skusOptions);
                } else {
                    DB::table('skus')->insert([
                        'product_id' => $productId,
                        'count' => rand(0, 10),
                        'price' => rand(1000, 50000),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
    }
}
