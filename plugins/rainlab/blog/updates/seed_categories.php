<?php namespace RainLab\Blog\Updates;

use Bedard\BlogTags\Models\Tag;
use Carbon\Carbon;
use RainLab\Blog\Models\Category;
use October\Rain\Database\Updates\Seeder;

class SeedCategories extends Seeder
{
    public $data = [
        "Аптеки" => [
            "name" => "Аптеки",
            "code" => "pharmacy",
            "children" => []
        ],
        "Лабаратории" => [
            "name" => "Лабаратории",
            "code" => "laboratory",
            "children" => []
        ],
        "Клиники" => [
            "name" => "Клиники",
            "code" => "clinics",
            "children" => [
                "Частные клиники",
                "Стоматологические поликлиники",
                "Диагностические центры",
                "Семейные Клиники",
            ]
        ],
        "Врачи" => [
            "name" => "Врачи",
            "code" => "doctors",
            "children" => []
        ],
    ];

    public function run()
    {
        foreach ($this->data as $key => $category) {
            $category_slug = str_slug($category['name']);
            $category_created = Category::create([
                'name' => $category['name'],
                'slug' => $category_slug,
                'code' => $category['code'],
            ]);
            foreach ($category['children'] as $child) {
                Category::create([
                    'name' => $child,
                    'slug' => str_slug($child),
                    'code' => $category['code'],
                    'parent_id' => $category_created->id
                ]);
            }

        }
    }

}
