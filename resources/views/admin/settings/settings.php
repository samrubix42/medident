<?php

use App\Models\ClinicSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::admin')] #[Title('Clinic Settings')] class extends Component
{
    public string $clinicName = '';

    public string $address = '';

    public string $phone = '';

    public string $secondaryPhone = '';

    public string $email = '';

    public string $openingHours = '';

    public string $whatsappNumber = '';

    public string $facebookUrl = '';

    public string $instagramUrl = '';

    public string $linkedinUrl = '';

    public function mount(): void
    {
        $settings = ClinicSetting::current();

        $this->clinicName = $settings->clinic_name;
        $this->address = $settings->address;
        $this->phone = $settings->phone;
        $this->secondaryPhone = $settings->secondary_phone ?? '';
        $this->email = $settings->email;
        $this->openingHours = $settings->opening_hours;
        $this->whatsappNumber = $settings->whatsapp_number;
        $this->facebookUrl = $settings->facebook_url ?? '';
        $this->instagramUrl = $settings->instagram_url ?? '';
        $this->linkedinUrl = $settings->linkedin_url ?? '';
    }

    /**
     * @return array<string, list<string>>
     */
    protected function rules(): array
    {
        return [
            'clinicName' => ['required', 'string', 'max:120'],
            'address' => ['required', 'string', 'max:500'],
            'phone' => ['required', 'string', 'max:30'],
            'secondaryPhone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'openingHours' => ['required', 'string', 'max:255'],
            'whatsappNumber' => ['required', 'string', 'max:30'],
            'facebookUrl' => ['nullable', 'url', 'max:255'],
            'instagramUrl' => ['nullable', 'url', 'max:255'],
            'linkedinUrl' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function save(): void
    {
        abort_unless(auth()->check(), 403);

        $validated = $this->validate();

        ClinicSetting::current()->update([
            'clinic_name' => $validated['clinicName'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'secondary_phone' => $validated['secondaryPhone'] ?: null,
            'email' => $validated['email'],
            'opening_hours' => $validated['openingHours'],
            'whatsapp_number' => $validated['whatsappNumber'],
            'facebook_url' => $validated['facebookUrl'] ?: null,
            'instagram_url' => $validated['instagramUrl'] ?: null,
            'linkedin_url' => $validated['linkedinUrl'] ?: null,
        ]);

        $this->dispatch('toast-show', message: 'Clinic settings updated successfully.', type: 'success');
    }
};
