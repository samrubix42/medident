<?php

use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::admin')] #[Title('Dashboard')] class extends Component
{
    /**
     * @return Collection<int, Appointment>
     */
    #[Computed]
    public function recentAppointments(): Collection
    {
        return Appointment::query()
            ->latest()
            ->latest('id')
            ->limit(5)
            ->get();
    }

    /**
     * @return Collection<int, ContactMessage>
     */
    #[Computed]
    public function recentInquiries(): Collection
    {
        return ContactMessage::query()
            ->latest()
            ->latest('id')
            ->limit(4)
            ->get();
    }

    /**
     * @return array<int, array{label: string, value: string, note: string, noteIcon: string, icon: string, iconClass: string}>
     */
    #[Computed]
    public function stats(): array
    {
        $todayAppointments = Appointment::query()
            ->whereDate('created_at', today())
            ->count();

        $weekAppointments = Appointment::query()
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();

        $totalInquiries = ContactMessage::query()->count();
        $unreadInquiries = ContactMessage::query()->where('is_read', false)->count();

        $totalServices = Service::query()->count();
        $activeServices = Service::query()->where('is_active', true)->count();

        $totalReviews = Review::query()->count();
        $averageRating = Review::query()->avg('review_rating');

        return [
            [
                'label' => "Today's appointments",
                'value' => number_format($todayAppointments),
                'note' => number_format($weekAppointments).' this week',
                'noteIcon' => 'ri-calendar-2-line',
                'icon' => 'ri-calendar-check-line',
                'iconClass' => 'bg-sky-50 text-med-blue',
            ],
            [
                'label' => 'Unread inquiries',
                'value' => number_format($unreadInquiries),
                'note' => number_format($totalInquiries).' total '.Str::plural('message', $totalInquiries),
                'noteIcon' => 'ri-mail-line',
                'icon' => 'ri-mail-unread-line',
                'iconClass' => 'bg-amber-50 text-amber-600',
            ],
            [
                'label' => 'Active services',
                'value' => number_format($activeServices),
                'note' => number_format($totalServices).' total '.Str::plural('service', $totalServices),
                'noteIcon' => 'ri-stethoscope-line',
                'icon' => 'ri-stethoscope-line',
                'iconClass' => 'bg-violet-50 text-violet-600',
            ],
            [
                'label' => 'Google reviews',
                'value' => number_format($totalReviews),
                'note' => $totalReviews > 0
                    ? number_format((float) $averageRating, 1).' average rating'
                    : 'No reviews yet',
                'noteIcon' => 'ri-star-line',
                'icon' => 'ri-star-line',
                'iconClass' => 'bg-emerald-50 text-emerald-600',
            ],
        ];
    }
};
