<?php

use App\Mail\IntakeNotification;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

new class extends Component
{
    public bool $showModal = false;

    public bool $submitted = false;

    public string $name = '';

    public string $phone = '';

    public string $age = '';

    public string $address = '';

    public string $problem = '';

    /**
     * @return array<string, list<string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]{7,20}$/'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'address' => ['required', 'string', 'max:500'],
            'problem' => ['required', 'string', 'max:2000'],
        ];
    }

    public function openModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetValidation();
    }

    public function submit(): void
    {
        $validated = $this->validate();

        Appointment::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'age' => (int) $validated['age'],
            'address' => $validated['address'],
            'problem' => $validated['problem'],
        ]);

        Mail::to(config('mail.to'))->send(
            new IntakeNotification(
                'New appointment request',
                'A patient requested an appointment through the MediDENT website.',
                [
                    ['label' => 'Name', 'value' => $validated['name']],
                    ['label' => 'Phone', 'value' => $validated['phone']],
                    ['label' => 'Age', 'value' => (string) $validated['age']],
                    ['label' => 'Address', 'value' => $validated['address']],
                    ['label' => 'Problem', 'value' => $validated['problem']],
                ],
                'New appointment request - MediDENT',
            ),
        );

        $this->submitted = true;
    }

    public function bookAnother(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset([
            'name',
            'phone',
            'age',
            'address',
            'problem',
            'submitted',
        ]);

        $this->resetValidation();
    }
};
