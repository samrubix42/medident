<?php

namespace Database\Factories;

use App\Models\ClinicSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClinicSetting>
 */
class ClinicSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'clinic_name' => fake()->company(),
            'address' => fake()->address(),
            'phone' => fake()->numerify('+91 9#########'),
            'secondary_phone' => fake()->numerify('0120-#######'),
            'email' => fake()->unique()->safeEmail(),
            'opening_hours' => 'Mon - Sat 11:00 AM - 1:00 PM | 5:00 PM - 8:30 PM',
            'whatsapp_number' => fake()->numerify('+91 9#########'),
            'facebook_url' => 'https://www.facebook.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'linkedin_url' => 'https://www.linkedin.com/',
        ];
    }
}
