<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'LED',
                'children' => [
                    [
                        'name' => 'LED 1',
                        'children' => [
                            [
                                'name' => 'LED 1 1',
                            ],
                        ],
                    ],
                    [
                        'name' => 'LED 2',
                    ],
                ],
            ],
            [
                'name' => 'Źródła światła',
                'children' => [
                    [
                        'name' => 'Źródła światła 1',
                    ],
                    [
                        'name' => 'Źródła światła 2',
                        'children' => [
                            [
                                'name' => 'Źródła światła 2 1',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $categoriesData = [];

        foreach ($categories as $category) {
            $categoriesData = array_merge($categoriesData, $this->makeCategory($category));
        }

        DB::table('categories')->insert($categoriesData);
    }

    private function makeCategory(array $category, string $parentId = null)
    {
        $categoryId = (string) Uuid::uuid4();
        $categories = [];

        $categories[] = [
            'id'        => $categoryId,
            'parent_id' => $parentId ?? null,
            'name'      => $category['name'],
            'slug'      => Str::slug($category['name']),
        ];

        if (isset($category['children'])) {
            foreach ($category['children'] as $newCategory) {
                $categories = array_merge($categories, $this->makeCategory($newCategory, $categoryId));
            }
        }

        return $categories;
    }
}
