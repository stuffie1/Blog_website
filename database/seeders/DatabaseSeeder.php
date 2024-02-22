<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\BlogCategorie;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        // for ($i = 1; $i <= 34; $i++) {
        //     $blog = Blog::find($i);
        //     $categories = Categorie::all()->random(rand(1, 15));

        //     foreach ($categories as $categorie) {
        //         $blogCategorie = new BlogCategorie();
        //         $blogCategorie->blog_id = $blog->id;
        //         $blogCategorie->categorie_id = $categorie->id;
        //         $blogCategorie->save();
        //     }
        // }
              for($i=1; $i<=51; $i++) {
                $user = User::find($i);
                // $user->profile_photo_path= fake()->imageUrl();
                $user->role= 'membre';
                $user->save();
            }
    }
}
