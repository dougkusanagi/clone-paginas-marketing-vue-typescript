<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClonedPage>
 */
class ClonedPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::first();
        $links = array_map(fn () => [$url = fake()->url() => $url], range(1, 5));
        $trackers = array_map(fn () => [$tracker = fake()->word() => $tracker], range(1, 5));

        return [
            'user_id' => $user->id,
            'url' => fake()->url(),
            'links' => json_encode($links),
            'trackers' => json_encode($trackers),
        ];
    }
}
