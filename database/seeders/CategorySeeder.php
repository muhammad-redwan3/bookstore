<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'ريادة الأعمال', 'slug' => 'ريادة-الأعمال']);
        Category::create(['name' => 'العمل الحر','slug' => 'العمل-الحر']);
        Category::create(['name' => 'التسويق والمبيعات','slug' => 'التسويق-و-المبيعات']);
        Category::create(['name' => 'التصميم','slug' => 'التصميم']);
        Category::create(['name' => 'البرمجة','slug' => 'البرمجة']);
    }
}
