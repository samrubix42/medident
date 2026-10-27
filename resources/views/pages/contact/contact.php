<?php

use App\Models\ClinicSetting;
use App\Models\ContactMessage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Contact Us')] class extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $subject = '';

    public string $message = '';

    public bool $submitted = false;

    /**
     * @return array<string, list<string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]{7,20}$/'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    #[Computed]
    public function settings(): ClinicSetting
    {
        return ClinicSetting::current();
    }

    #[Computed]
    public function mapEmbedUrl(): string
    {
        return 'https://www.google.com/maps?q='.rawurlencode($this->mapQuery()).'&output=embed';
    }

    #[Computed]
    public function mapDirectionsUrl(): string
    {
        return 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($this->mapQuery());
    }

    public function submit(): void
    {
        $validated = $this->validate();

        ContactMessage::create($validated);

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        $this->submitted = true;
    }

    public function sendAnother(): void
    {
        $this->submitted = false;
        $this->resetValidation();
    }

    private function mapQuery(): string
    {
        return $this->settings->address ?: 'MediDENT Multicare Clinic, Ghaziabad';
    }
};
