<?php

namespace Database\Seeders;

use App\Models\ClinicSetting;
use Illuminate\Database\Seeder;

class ClinicSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = ClinicSetting::query()->firstOrNew([]);

        $settings->fill(ClinicSetting::defaults());
        $settings->save();
    }
}
