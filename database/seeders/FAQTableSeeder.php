<?php
namespace Database\Seeders;

use App\Models\FAQ;
use App\Models\FaqCategory;
use Illuminate\Database\Seeder;
class FAQTableSeeder extends Seeder
{
    public function run(\Faker\Generator $faker)
    {

        FAQ::truncate();
        FaqCategory::truncate();

        for ($i = 0; $i < 3; $i++) {
            $item = FaqCategory::create([
                'name' => $faker->sentence(2)
            ]);

            for ($a = 0; $a < $faker->numberBetween(3, 8); $a++) {
                $item->faqs()->create([
                    'question' => $faker->sentence(8),
                    'answer'   => $faker->paragraph(3),
                ]);
            }
        }
    }
}