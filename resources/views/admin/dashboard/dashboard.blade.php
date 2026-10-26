@php
    $user = auth()->user();
    $firstName = explode(' ', $user?->name ?? 'Admin')[0];

    $greeting = match (true) {
        now()->hour < 12 => 'Good morning',
        now()->hour < 17 => 'Good afternoon',
        default => 'Good evening',
    };

    $stats = [
        [
            'label' => "Today's appointments",
            'value' => '12',
            'note' => '3 more than yesterday',
            'noteClass' => 'text-slate-500',
            'icon' => 'ri-calendar-check-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
        [
            'label' => 'Total patients',
            'value' => '1,248',
            'note' => '24 new this month',
            'noteClass' => 'text-slate-500',
            'icon' => 'ri-user-heart-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
        [
            'label' => 'Services offered',
            'value' => '6',
            'note' => 'All services active',
            'noteClass' => 'text-slate-500',
            'icon' => 'ri-stethoscope-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
        [
            'label' => 'Pending enquiries',
            'value' => '4',
            'note' => 'Needs follow-up',
            'noteClass' => 'text-slate-500',
            'icon' => 'ri-chat-3-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
    ];

    $actions = [
        [
            'label' => 'New appointment',
            'hint' => 'Schedule a visit',
            'icon' => 'ri-calendar-2-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
        [
            'label' => 'Add patient',
            'hint' => 'Create a record',
            'icon' => 'ri-user-add-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
        [
            'label' => 'Manage services',
            'hint' => 'Update offerings',
            'icon' => 'ri-stethoscope-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
        [
            'label' => 'View enquiries',
            'hint' => 'Respond to messages',
            'icon' => 'ri-chat-3-line',
            'iconClass' => 'bg-slate-100 text-slate-500',
        ],
    ];

    $avatarStyles = [
        'blue' => 'bg-slate-100 text-slate-600',
        'amber' => 'bg-slate-100 text-slate-600',
        'violet' => 'bg-slate-100 text-slate-600',
        'red' => 'bg-slate-100 text-slate-600',
        'emerald' => 'bg-slate-100 text-slate-600',
    ];

    $statusStyles = [
        'Confirmed' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/10',
        'Waiting' => 'bg-amber-50 text-amber-700 ring-amber-600/10',
        'Cancelled' => 'bg-red-50 text-red-700 ring-red-600/10',
    ];
@endphp

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Greeting --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Overview
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                {{ $greeting }}, {{ $firstName }}
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Here is what is happening at the clinic today.
            </p>
        </div>

        <a href="{{ route('home') }}"
            wire:navigate
            class="inline-flex w-fit items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue">
            <i class="ri-global-line text-lg"></i>
            View website
            <i class="ri-arrow-right-up-line text-base text-slate-400"></i>
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div
                wire:key="stat-{{ $loop->index }}"
                class="border border-slate-200 bg-white p-5 transition hover:border-slate-300 hover:shadow-sm">

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">{{ $stat['label'] }}</p>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-med-navy">
                            {{ $stat['value'] }}
                        </p>
                    </div>

                    <span class="grid h-11 w-11 shrink-0 place-items-center {{ $stat['iconClass'] }}">
                        <i class="{{ $stat['icon'] }} text-xl"></i>
                    </span>
                </div>

                <p class="mt-4 flex items-center gap-1.5 text-xs font-medium {{ $stat['noteClass'] }}">
                    <i class="ri-arrow-up-line"></i>
                    {{ $stat['note'] }}
                </p>
            </div>
        @endforeach
    </div>

    <div class="grid gap-6 xl:grid-cols-3">

        {{-- Recent appointments --}}
        <section class="border border-slate-200 bg-white xl:col-span-2">
            <div class="flex flex-col gap-3 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="font-bold text-med-navy">Recent appointments</h3>
                    <p class="mt-1 text-xs text-slate-500">Today's patient schedule</p>
                </div>

                <a href="#"
                    class="inline-flex w-fit items-center gap-2 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                    View all
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                        <tr>
                            <th scope="col" class="px-5 py-3">Patient</th>
                            <th scope="col" class="px-5 py-3">Service</th>
                            <th scope="col" class="px-5 py-3">Time</th>
                            <th scope="col" class="px-5 py-3">Status</th>
                            <th scope="col" class="px-5 py-3 text-right">View</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach ($appointments as $appointment)
                            @php
                                $initials = str($appointment['name'])
                                    ->explode(' ')
                                    ->map(fn ($part) => str($part)->substr(0, 1)->upper())
                                    ->take(2)
                                    ->implode('');
                            @endphp

                            <tr wire:key="appointment-{{ $loop->index }}" class="transition hover:bg-slate-50/70">
                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center text-xs font-bold {{ $avatarStyles[$appointment['color']] }}">
                                            {{ $initials }}
                                        </span>

                                        <span class="text-sm font-semibold text-med-navy">
                                            {{ $appointment['name'] }}
                                        </span>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                    {{ $appointment['service'] }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                    {{ $appointment['time'] }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold ring-1 ring-inset {{ $statusStyles[$appointment['status']] }}">
                                        {{ $appointment['status'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <a href="#"
                                        aria-label="View appointment for {{ $appointment['name'] }}"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="ri-arrow-right-up-line"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Side column --}}
        <aside class="space-y-6">

            {{-- Quick actions --}}
            <div class="border border-slate-200 bg-white p-5">
                <h3 class="font-bold text-med-navy">Quick actions</h3>
                <p class="mt-1 text-xs text-slate-500">Common clinic tasks</p>

                <div class="mt-4 grid grid-cols-2 gap-3">
                    @foreach ($actions as $action)
                        <a href="#"
                            wire:key="action-{{ $loop->index }}"
                            class="group border border-slate-100 bg-slate-50/70 p-4 transition hover:border-slate-200 hover:bg-white hover:shadow-sm">
                            <span class="grid h-9 w-9 place-items-center {{ $action['iconClass'] }}">
                                <i class="{{ $action['icon'] }} text-lg"></i>
                            </span>

                            <p class="mt-3 text-sm font-semibold text-med-navy">
                                {{ $action['label'] }}
                            </p>
                            <p class="mt-1 text-[11px] leading-5 text-slate-500">
                                {{ $action['hint'] }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Clinic status --}}
            <div class="border border-slate-200 bg-white p-5">
                <div class="flex items-center justify-between gap-4">
                    <h3 class="font-bold text-med-navy">Clinic status</h3>

                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Open
                    </span>
                </div>

                <div class="mt-4 flex items-start gap-3 border border-slate-100 bg-slate-50 p-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center bg-sky-50 text-med-blue">
                        <i class="ri-time-line text-lg"></i>
                    </span>

                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-slate-400">
                            Today's hours
                        </p>
                        <p class="mt-0.5 text-sm font-semibold text-med-navy">
                            9:00 AM – 8:00 PM
                        </p>
                    </div>
                </div>

                <p class="mt-3 text-xs leading-6 text-slate-500">
                    Monday to Saturday. The clinic is closed on Sundays.
                </p>

                <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4 text-xs">
                    <span class="text-slate-500">Doctors on duty</span>
                    <span class="font-semibold text-med-navy">3</span>
                </div>
            </div>
        </aside>
    </div>
</div>
