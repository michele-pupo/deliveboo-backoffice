<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories  = [
        "italian",
        "hamburger",
        "pizza",
        "sushi",
        "chinese",
        "dessert",
        "greek",
        "vegan",
        "thai",
        "fish",
        "meat",
        "fast-food",];

        foreach($categories as $category){
            $newCategory = new Category();

            $newCategory->name = $category;
            $newCategory->image = 'category_images/' . $category . '.jpg';

            $newCategory->save();
        }
        
    }
}
