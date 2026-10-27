<?php

use App\Models\ClinicSetting;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function settings(): ClinicSetting
    {
        return ClinicSetting::current();
    }
};
