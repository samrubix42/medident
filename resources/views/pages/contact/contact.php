<?php

use App\Models\ClinicSetting;
use App\Models\ContactMessage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Contact Us')] class extends Component
{
    private const MAP_EMBED_URL = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3500.4913929423965!2d77.4632996!3d28.674943799999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cf175f325dba9%3A0x24bb042cbe7d8a2f!2sMedident%20Multicare%20Clinic%3A%20Medical%2C%20Diabetes%2C%20Dental%20%26%20Physician%20Care!5e0!3m2!1sen!2sin!4v1793096116708!5m2!1sen!2sin';

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
            'email' => ['nullable', 'string', 'email', 'max:190'],
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
        return self::MAP_EMBED_URL;
    }

    #[Computed]
    public function mapDirectionsUrl(): string
    {
        return 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($this->mapQuery());
    }

    public function submit(): void
    {
        $validated = $this->validate();
        $validated['email'] = filled($validated['email'] ?? null) ? trim($validated['email']) : null;

        ContactMessage::create([
            ...$validated,
            'is_read' => false,
        ]);

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
