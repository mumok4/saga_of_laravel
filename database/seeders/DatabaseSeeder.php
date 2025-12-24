<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tag1 = Tag::create(['name' => 'Laravel']);
        $tag2 = Tag::create(['name' => 'PHP']);
        $tag3 = Tag::create(['name' => 'News']);

        $post1 = Post::create([
            'title' => 'Изучаем Laravel 10',
            'content' => 'Это очень мощный фреймворк для веб-разработки.',
            'is_published' => true,
        ]);
        $post1->tags()->attach([$tag1->id, $tag2->id]);

        $post2 = Post::create([
            'title' => 'Новости IT Иркутска',
            'content' => 'Сегодня в Иркутске прошла конференция разработчиков.',
            'is_published' => true,
        ]);
        $post2->tags()->attach([$tag3->id]);
    }
}
