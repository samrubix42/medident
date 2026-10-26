<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::admin')] #[Title('Dashboard')] class extends Component
{
    /**
     * @var array<int, array{name: string, service: string, time: string, status: string, color: string}>
     */
    public array $appointments = [
        ['name' => 'Ayesha Khan', 'service' => 'General Consultation', 'time' => '10:00 AM', 'status' => 'Confirmed', 'color' => 'blue'],
        ['name' => 'Rohit Sharma', 'service' => 'Diabetes Follow-up', 'time' => '10:30 AM', 'status' => 'Waiting', 'color' => 'amber'],
        ['name' => 'Meera Patel', 'service' => 'Dental Check-up', 'time' => '11:15 AM', 'status' => 'Confirmed', 'color' => 'violet'],
        ['name' => 'Imran Ali', 'service' => 'Respiratory Review', 'time' => '12:00 PM', 'status' => 'Cancelled', 'color' => 'red'],
        ['name' => 'Sara Ahmed', 'service' => 'Vaccination', 'time' => '12:30 PM', 'status' => 'Confirmed', 'color' => 'emerald'],
    ];
};
