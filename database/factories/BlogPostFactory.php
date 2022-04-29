<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraphs(5, true)
        ];
    }

    public function state($state)
    {
        return [
            'title' => 'New title',
            'content' =>'Content of the blog post'
        ];
    }
}
