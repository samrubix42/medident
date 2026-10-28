@php
    $user = auth()->user();
    $firstName = explode(' ', $user?->name ?? 'Admin')[0];

    $greeting = match (true) {
        now()->hour < 12 => 'Good morning',
        now()->hour < 17 => 'Good afternoon',
        default => 'Good evening',
    };

    $actions = [
        [
            'label' => 'View bookings',
            'hint' => 'Patient appointments',
            'icon' => 'ri-calendar-check-line',
            'iconClass' => 'bg-sky-50 text-med-blue',
            'url' => route('admin.bookings'),
            'navigate' => true,
        ],
        [
            'label' => 'View inquiries',
            'hint' => 'Respond to messages',
            'icon' => 'ri-chat-3-line',
            'iconClass' => 'bg-amber-50 text-amber-600',
            'url' => route('admin.inquiries'),
            'navigate' => true,
        ],
        [
            'label' => 'Manage services',
            'hint' => 'Update offerings',
            'icon' => 'ri-stethoscope-line',
            'iconClass' => 'bg-violet-50 text-violet-600',
            'url' => route('admin.services'),
            'navigate' => true,
        ],
        [
            'label' => 'Add blog post',
            'hint' => 'Publish an article',
            'icon' => 'ri-article-line',
            'iconClass' => 'bg-slate-100 text-slate-700',
            'url' => route('admin.blog-posts.create'),
            'navigate' => false,
        ],
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
        @foreach ($this->stats as $stat)
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

                <p class="mt-4 flex items-center gap-1.5 text-xs font-medium text-slate-500">
                    <i class="{{ $stat['noteIcon'] }}"></i>
                    {{ $stat['note'] }}
                </p>
            </div>
        @endforeach
    </div>

    <div class="grid gap-6 xl:grid-cols-3">

        {{-- Recent appointments --}}
        <section class="border border-slate-200 bg-white xl:col-span-2">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <div>
                    <h3 class="font-bold text-med-navy">Recent appointments</h3>
                    <p class="mt-1 text-xs text-slate-500">Newest booking requests from the website.</p>
                </div>

                <a href="{{ route('admin.bookings') }}"
                    wire:navigate
                    class="text-xs font-semibold text-med-blue transition hover:underline">
                    View all bookings &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                        <tr>
                            <th scope="col" class="px-5 py-3">Patient</th>
                            <th scope="col" class="px-5 py-3">Phone</th>
                            <th scope="col" class="px-5 py-3">Concern</th>
                            <th scope="col" class="px-5 py-3">Received</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($this->recentAppointments as $appointment)
                            @php
                                $initials = str($appointment->name)
                                    ->explode(' ')
                                    ->filter()
                                    ->map(fn ($part) => str($part)->substr(0, 1)->upper())
                                    ->take(2)
                                    ->implode('');
                                $phoneHref = preg_replace('/[^\d+]/', '', (string) $appointment->phone);
                            @endphp

                            <tr wire:key="appointment-{{ $appointment->id }}" class="transition hover:bg-slate-50/70">
                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center bg-slate-100 text-xs font-bold text-slate-600">
                                            {{ $initials ?: 'P' }}
                                        </span>

                                        <span class="text-sm font-semibold text-med-navy">
                                            {{ $appointment->name }}
                                        </span>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                    @if ($phoneHref)
                                        <a href="tel:{{ $phoneHref }}" class="transition hover:text-med-blue">
                                            {{ $appointment->phone }}
                                        </a>
                                    @else
                                        {{ $appointment->phone }}
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-sm text-slate-600">
                                    <span class="block max-w-64 truncate" title="{{ $appointment->problem }}">
                                        {{ $appointment->problem }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                    <time
                                        datetime="{{ $appointment->created_at->toIso8601String() }}"
                                        title="{{ $appointment->created_at->format('d M Y, g:i A') }}">
                                        {{ $appointment->created_at->diffForHumans() }}
                                    </time>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-12 text-center">
                                    <span class="mx-auto grid h-11 w-11 place-items-center bg-slate-100 text-slate-400">
                                        <i class="ri-calendar-line text-xl"></i>
                                    </span>
                                    <p class="mt-3 text-sm font-semibold text-med-navy">No appointment requests yet</p>
                                    <p class="mt-1 text-xs text-slate-500">New bookings from the website will appear here.</p>
                                </td>
                            </tr>
                        @endforelse
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
                        <a href="{{ $action['url'] }}"
                            wire:key="action-{{ $loop->index }}"
                            @if ($action['navigate']) wire:navigate @endif
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

            {{-- Recent inquiries --}}
            <div class="border border-slate-200 bg-white">
                <div class="flex items-center justify-between gap-4 border-b border-slate-100 p-5">
                    <div>
                        <h3 class="font-bold text-med-navy">Recent inquiries</h3>
                        <p class="mt-1 text-xs text-slate-500">Latest contact messages</p>
                    </div>

                    <a href="{{ route('admin.inquiries') }}"
                        wire:navigate
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                        View all
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($this->recentInquiries as $inquiry)
                        @php
                            $initials = str($inquiry->name)
                                ->explode(' ')
                                ->filter()
                                ->map(fn ($part) => str($part)->substr(0, 1)->upper())
                                ->take(2)
                                ->implode('');
                        @endphp

                        <a href="{{ route('admin.inquiries') }}"
                            wire:key="inquiry-{{ $inquiry->id }}"
                            wire:navigate
                            class="group flex gap-3 p-4 transition hover:bg-slate-50">
                            <span class="relative grid h-9 w-9 shrink-0 place-items-center bg-slate-100 text-[11px] font-semibold text-slate-600">
                                {{ $initials ?: 'I' }}

                                @if (! $inquiry->is_read)
                                    <span class="absolute -right-0.5 -top-0.5 h-2.5 w-2.5 rounded-full border-2 border-white bg-med-blue"
                                        aria-label="Unread inquiry"></span>
                                @endif
                            </span>

                            <span class="min-w-0 flex-1">
                                <span class="flex items-center gap-2">
                                    <span class="truncate text-sm font-semibold text-med-navy">
                                        {{ $inquiry->name }}
                                    </span>

                                    @if (! $inquiry->is_read)
                                        <span class="shrink-0 bg-sky-50 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-[0.1em] text-med-blue">
                                            New
                                        </span>
                                    @endif
                                </span>

                                <span class="mt-1 block truncate text-xs text-slate-500">
                                    {{ $inquiry->subject }}
                                </span>

                                <span class="mt-1 block text-[11px] text-slate-400">
                                    {{ $inquiry->created_at->diffForHumans() }}
                                </span>
                            </span>
                        </a>
                    @empty
                        <div class="px-5 py-10 text-center">
                            <span class="mx-auto grid h-11 w-11 place-items-center bg-slate-100 text-slate-400">
                                <i class="ri-mail-line text-xl"></i>
                            </span>
                            <p class="mt-3 text-sm font-semibold text-med-navy">No inquiries yet</p>
                            <p class="mt-1 text-xs text-slate-500">Contact form messages will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>
