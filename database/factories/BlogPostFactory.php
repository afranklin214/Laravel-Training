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

    public function new_title()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'New title',
                'content' =>'Content of the blog post',
                'created_at'=> $this->faker->dateTimeBetween('-3 months'),
            ];
        });      
    }
}
