<?php

use Illuminate\Database\Seeder;
use App\Domain\Categories\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        factory(Category::class, 6)->create()->each(function (Category $category) {
            $this->seedCategories($category, 2);
        });
    }

    public function seedCategories($category, $nested)
    {
        factory(Category::class, rand(2, 4))->make()->each(function (Category $nestedCategory) use ($category, $nested) {
            $category->children()->save($nestedCategory);

            if ($nested > 0) {
                $this->seedCategories($nestedCategory, --$nested);
            }
        });
    }
}
