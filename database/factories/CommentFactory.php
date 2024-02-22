<?php

namespace Database\Factories;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(150),
            'user_id'=>$this->faker->numberBetween(1,50),
            'blog_id'=>$this->faker->numberBetween(1,35),

        ];
    }
}
