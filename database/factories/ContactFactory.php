<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = collect(User::all()->modelKeys());

        $image = fake()->image();
        $imageFile = new File($image);

        return [
            'contact_name' => fake()->name(),
            'contact_email' => fake()->email(),
            'contact_phone_number' => fake()->numberBetween(1000000000,9999999999),
            'contact_address' => fake()->address(),
            'contact_description' => fake()->paragraph(),
            'company_name' => fake()->company(),
            'job_title' => fake()->jobTitle(),
            'status' => Arr::random(Contact::STATUS),
            'created_by' => $users->random(),
            'contact_image' => '/storage/'.Storage::disk('public')->put('/images', $imageFile),
        ];
    }
}
