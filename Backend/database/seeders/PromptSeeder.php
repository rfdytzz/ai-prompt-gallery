<?php

namespace Database\Seeders;

use App\Models\Prompt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prompt::create([
            'title' => 'Generate photo to Anime style',
            'description' => 'Generate your photo to anime style, cool, amazing, and realistic',
            'prompt' => 'anime girl with long silver hair and violet eyes, wearing a dark blue school uniform with a red ribbon, cherry blossom petals floating around her, soft sunset background, gentle smile, detailed eyes with light reflections, high quality anime illustration',
            'author_id' => '2',
            'category_id' => '1',
            'tag_id' => '2',
        ]);
    }
}
