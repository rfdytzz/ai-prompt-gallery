<?php

namespace Database\Seeders;

use App\Models\Prompt;
use Illuminate\Database\Seeder;

class PromptSeeder extends Seeder
{
    public function run(): void
    {
        $prompts = [
            [
                'title' => 'Anime Cyberpunk Girl',
                'description' => 'Neon city futuristic anime style',
                'prompt' => 'cyberpunk girl, neon lights, futuristic city, rain, glowing eyes, ultra detailed, cinematic lighting',
                'author_id' => 1,
                'category_id' => 1,
                'tag_id' => 2,
            ],
            [
                'title' => 'Fantasy Castle Landscape',
                'description' => 'Epic medieval fantasy castle',
                'prompt' => 'huge fantasy castle on mountain, clouds, sunrise, ultra realistic, cinematic, detailed architecture',
                'author_id' => 1,
                'category_id' => 1,
                'tag_id' => 2,
            ],
            [
                'title' => 'Samurai Warrior',
                'description' => 'Ancient samurai in battle stance',
                'prompt' => 'samurai warrior holding katana, cherry blossom, wind blowing, dramatic lighting, highly detailed armor',
                'author_id' => 2,
                'category_id' => 2,
                'tag_id' => 2,
            ],
            [
                'title' => 'Space Explorer',
                'description' => 'Astronaut exploring unknown planet',
                'prompt' => 'astronaut on alien planet, glowing sky, stars, futuristic suit, cinematic, ultra realistic space scene',
                'author_id' => 2,
                'category_id' => 2,
                'tag_id' => 3,
            ],
            [
                'title' => 'Anime Girl Rain Scene',
                'description' => 'Sad anime girl under rain',
                'prompt' => 'anime girl standing in rain, wet hair, emotional expression, dark atmosphere, cinematic lighting',
                'author_id' => 2,
                'category_id' => 1,
                'tag_id' => 1,
            ],
            [
                'title' => 'Dragon in Sky',
                'description' => 'Epic dragon flying above clouds',
                'prompt' => 'giant dragon flying in sky, fire breath, clouds, fantasy world, ultra detailed, cinematic view',
                'author_id' => 2,
                'category_id' => 1,
                'tag_id' => 3,
            ],
            [
                'title' => 'Futuristic City Night',
                'description' => 'Sci-fi city glowing at night',
                'prompt' => 'futuristic city skyline at night, neon lights, flying cars, cyberpunk aesthetic, ultra detailed',
                'author_id' => 2,
                'category_id' => 2,
                'tag_id' => 1,
            ],
            [
                'title' => 'Elf Archer Forest',
                'description' => 'Fantasy elf with bow in forest',
                'prompt' => 'elf archer in magical forest, glowing arrows, green nature, fantasy style, highly detailed',
                'author_id' => 2,
                'category_id' => 1,
                'tag_id' => 2,
            ],
        ];

        foreach ($prompts as $prompt) {
            Prompt::create($prompt);
        }
    }
}