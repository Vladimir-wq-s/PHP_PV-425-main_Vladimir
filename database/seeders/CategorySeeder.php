<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Здесь очищаем существующие данные (опционально)
        // Category::query()->truncate();
        // Product::query()->truncate();
        // Tag::query()->truncate();

        $categories = [
            'Смартфоны' => [
                'subcategories' => [
                    'Apple iPhone',
                    'Samsung Galaxy',
                    'Xiaomi Redmi',
                    'Google Pixel',
                    'OnePlus',
                    'Honor',
                    'Realme',
                    'POCO',
                    'ASUS Zenfone',
                    'ZTE',
                ],
                'is_active' => true,
            ],
            'Ноутбуки' => [
                'subcategories' => [
                    'Игровые ноутбуки',
                    'Ультрабуки',
                    'Трансформеры',
                    'Ноутбуки для работы',
                    'Бюджетные ноутбуки',
                    'MacBook',
                    'ASUS ROG',
                    'Lenovo Legion',
                    'HP Pavilion',
                    'Dell XPS',
                ],
                'is_active' => true,
            ],
            'Планшеты' => [
                'subcategories' => [
                    'Apple iPad',
                    'Samsung Galaxy Tab',
                    'Huawei MatePad',
                    'Lenovo Tab',
                    'Xiaomi Pad',
                    'Планшеты для рисования',
                    'Детские планшеты',
                    'Планшеты с клавиатурой',
                ],
                'is_active' => true,
            ],
            'Наушники' => [
                'subcategories' => [
                    'Беспроводные наушники',
                    'Проводные наушники',
                    'Игровые наушники',
                    'Наушники с шумоподавлением',
                    'Спортивные наушники',
                    'TWS наушники',
                    'Apple AirPods',
                    'Sony WH-1000XM',
                    'JBL',
                    'Samsung Buds',
                ],
                'is_active' => true,
            ],
            'Акустические системы' => [
                'subcategories' => [
                    'Портативные колонки',
                    'Домашние кинотеатры',
                    'Саундбары',
                    'Студийные мониторы',
                    'Сателлиты',
                    'Сабвуферы',
                    'JBL Flip',
                    'Marshall',
                    'Sony SRS',
                ],
                'is_active' => true,
            ],
            'Телевизоры' => [
                'subcategories' => [
                    'OLED телевизоры',
                    'QLED телевизоры',
                    'LED телевизоры',
                    '8K телевизоры',
                    '4K телевизоры',
                    'Smart TV',
                    'Телевизоры для игр',
                    'Samsung Smart TV',
                    'LG OLED',
                    'Sony Bravia',
                ],
                'is_active' => true,
            ],
            'Мониторы' => [
                'subcategories' => [
                    'Игровые мониторы',
                    'Профессиональные мониторы',
                    'Изогнутые мониторы',
                    '4K мониторы',
                    'Мониторы для дизайна',
                    'Портативные мониторы',
                    'Мониторы с частотой 144Hz',
                    'Мониторы с частотой 240Hz',
                ],
                'is_active' => true,
            ],
            'Клавиатуры' => [
                'subcategories' => [
                    'Механические клавиатуры',
                    'Мембранные клавиатуры',
                    'Беспроводные клавиатуры',
                    'Игровые клавиатуры',
                    'Компактные клавиатуры',
                    'Клавиатуры с подсветкой',
                    'Apple Magic Keyboard',
                    'Logitech MX Keys',
                ],
                'is_active' => true,
            ],
            'Мыши' => [
                'subcategories' => [
                    'Игровые мыши',
                    'Беспроводные мыши',
                    'Офисные мыши',
                    'Вертикальные мыши',
                    'Трекболы',
                    'Мыши для дизайна',
                    'Logitech G',
                    'Razer',
                    'SteelSeries',
                ],
                'is_active' => true,
            ],
            'Внешние накопители' => [
                'subcategories' => [
                    'Внешние жесткие диски',
                    'Внешние SSD',
                    'Карты памяти',
                    'Флеш-накопители',
                    'Сетевые хранилища NAS',
                    'Samsung T7',
                    'SanDisk Extreme',
                ],
                'is_active' => true,
            ],
            'Зарядные устройства' => [
                'subcategories' => [
                    'Блоки питания',
                    'Станции зарядки',
                    'Автомобильные зарядки',
                    'Беспроводные зарядки',
                    'Быстрые зарядки',
                    'GaN зарядки',
                ],
                'is_active' => true,
            ],
            'Пауэрбанки' => [
                'subcategories' => [
                    'Пауэрбанки 5000 мАч',
                    'Пауэрбанки 10000 мАч',
                    'Пауэрбанки 20000 мАч',
                    'Пауэрбанки с быстрой зарядкой',
                    'Пауэрбанки с беспроводной зарядкой',
                    'Xiaomi Power Bank',
                    'Samsung Power Bank',
                ],
                'is_active' => true,
            ],
            'Кабели и переходники' => [
                'subcategories' => [
                    'USB-C кабели',
                    'HDMI кабели',
                    'Переходники USB-C',
                    'Аудио кабели',
                    'Сетевые кабели',
                    'Кабели для зарядки',
                    'Apple Lightning',
                ],
                'is_active' => true,
            ],
            'Сетевые фильтры' => [
                'subcategories' => [
                    'Сетевые фильтры с USB',
                    'Сетевые фильтры с защитой',
                    'Удлинители с фильтром',
                    'Переносные сетевые фильтры',
                ],
                'is_active' => true,
            ],
            'Роутеры' => [
                'subcategories' => [
                    'Wi-Fi 6 роутеры',
                    'Wi-Fi 5 роутеры',
                    'Игровые роутеры',
                    'Mesh-системы',
                    'Модемы',
                    'ASUS Router',
                    'TP-Link Archer',
                    'MikroTik',
                ],
                'is_active' => true,
            ],
            'Умные часы' => [
                'subcategories' => [
                    'Apple Watch',
                    'Samsung Galaxy Watch',
                    'Xiaomi Watch',
                    'Garmin',
                    'Huawei Watch',
                    'Amazfit',
                    'Умные часы для спорта',
                    'Умные часы с LTE',
                ],
                'is_active' => true,
            ],
            'Фитнес-браслеты' => [
                'subcategories' => [
                    'Xiaomi Mi Band',
                    'Samsung Fit',
                    'Huawei Band',
                    'Amazfit Band',
                    'Фитнес-браслеты с пульсометром',
                    'Фитнес-браслеты с GPS',
                ],
                'is_active' => true,
            ],
            'Игровые приставки' => [
                'subcategories' => [
                    'PlayStation 5',
                    'Xbox Series X',
                    'Xbox Series S',
                    'Nintendo Switch',
                    'Игровые консоли',
                    'Ретро консоли',
                    'Аксессуары для приставок',
                ],
                'is_active' => true,
            ],
            'Электронные книги' => [
                'subcategories' => [
                    'Amazon Kindle',
                    'PocketBook',
                    'ONYX BOOX',
                    'Электронные книги с подсветкой',
                    'Электронные книги с Wi-Fi',
                    'Бюджетные электронные книги',
                ],
                'is_active' => true,
            ],
            'Комплектующие для ПК' => [
                'subcategories' => [
                    'Процессоры',
                    'Видеокарты',
                    'Материнские платы',
                    'Оперативная память',
                    'Блоки питания для пк',
                    'Системы охлаждения',
                    'Корпуса',
                    'SSD накопители',
                    'Intel Core',
                    'AMD Ryzen',
                    'NVIDIA GeForce',
                    'AMD Radeon',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($categories as $parentName => $data) {
            // Создаем или находим родительскую категорию
            $parent = Category::query()->firstOrCreate(
                ['name' => $parentName],
                ['is_active' => $data['is_active']]
            );

            // Обновляем статус если нужно
            if ($parent->is_active !== $data['is_active']) {
                $parent->update(['is_active' => $data['is_active']]);
            }

            // Создаем подкатегории
            foreach ($data['subcategories'] as $subName) {
                // Проверяем существование подкатегории
                $subCategory = Category::query()->where([
                    'name' => $subName,
                    'parent_id' => $parent->id,
                ])->first();

                if (!$subCategory) {
                    // Создаем только если не существует
                    $subCategory = Category::factory([
                        'name' => $subName,
                        'parent_id' => $parent->id,
                        'is_active' => true,
                    ])->create();

                    // Создаем товары только для новых категорий
                    Product::factory()
                        ->count(3)
                        ->for($subCategory)
                        ->has(
                            Tag::factory()->count(3),
                            'tags'
                        )
                        ->create();
                } else {
                    // Обновляем статус если нужно
                    if (!$subCategory->is_active) {
                        $subCategory->update(['is_active' => true]);
                    }
                }
            }
        }
    }
}
