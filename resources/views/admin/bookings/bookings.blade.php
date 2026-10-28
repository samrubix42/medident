<div
    x-data
    x-effect="document.body.classList.toggle('overflow-hidden', $wire.showBookingModal || $wire.showDeleteModal)"
    class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Clinic Appointments
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Bookings
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Manage appointment requests submitted by patients online and coordinate clinic consultations.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
                <i class="ri-calendar-check-line text-lg text-slate-400"></i>
                {{ number_format($this->stats['total']) }} total
            </span>

            <span class="inline-flex items-center gap-2 border border-sky-100 bg-sky-50 px-4 py-2.5 text-sm font-semibold text-med-blue">
                <span class="h-2 w-2 rounded-full bg-med-blue"></span>
                {{ number_format($this->stats['today']) }} today
            </span>

            <span class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600">
                <i class="ri-calendar-event-line text-lg text-slate-400"></i>
                {{ number_format($this->stats['this_week']) }} this week
            </span>
        </div>
    </div>

    {{-- Main Table Section --}}
    <section class="border border-slate-200 bg-white">
        <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h3 class="font-bold text-med-navy">Appointments list</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Showing latest booking requests first.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative">
                    <i class="ri-search-line pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400"></i>

                    <input
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search patient, phone, problem..."
                        aria-label="Search bookings"
                        class="h-10 w-full border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 sm:w-72">
                </div>

                <select
                    wire:model.live="dateFilter"
                    aria-label="Filter bookings by date"
                    class="h-10 border border-slate-200 bg-white px-3 text-sm text-slate-600 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                    <option value="all">All dates</option>
                    <option value="today">Today only</option>
                    <option value="this_week">This week</option>
                    <option value="this_month">This month</option>
                </select>

                <select
                    wire:model.live="perPage"
                    aria-label="Bookings per page"
                    class="h-10 border border-slate-200 bg-white px-3 text-sm text-slate-600 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Patient</th>
                        <th scope="col" class="px-5 py-3">Contact</th>
                        <th scope="col" class="px-5 py-3">Address</th>
                        <th scope="col" class="px-5 py-3">Problem / Concern</th>
                        <th scope="col" class="px-5 py-3">Requested</th>
                        <th scope="col" class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->bookings as $booking)
                        @php
                            $initials = str($booking->name)
                                ->explode(' ')
                                ->filter()
                                ->map(fn ($part) => str($part)->substr(0, 1)->upper())
                                ->take(2)
                                ->implode('');
                            $phoneHref = preg_replace('/[^\d+]/', '', (string) $booking->phone);
                        @endphp

                        <tr wire:key="booking-{{ $booking->id }}" class="align-top transition hover:bg-slate-50/70">
                            {{-- Patient Name & Age --}}
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center bg-sky-50 text-xs font-bold text-med-blue ring-1 ring-inset ring-sky-600/10">
                                        {{ $initials ?: 'PT' }}
                                    </span>

                                    <div>
                                        <button
                                            type="button"
                                            wire:click="openBooking({{ $booking->id }})"
                                            class="block text-left text-sm font-semibold text-med-navy transition hover:text-med-blue">
                                            {{ $booking->name }}
                                        </button>
                                        <p class="mt-0.5 text-xs text-slate-500">
                                            Age: {{ $booking->age }} yrs
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Phone / Contact --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm">
                                @if ($phoneHref)
                                    <a
                                        href="tel:{{ $phoneHref }}"
                                        class="inline-flex items-center gap-1.5 font-medium text-slate-700 transition hover:text-med-blue">
                                        <i class="ri-phone-line text-xs text-slate-400"></i>
                                        {{ $booking->phone }}
                                    </a>
                                @else
                                    <span class="text-slate-600">{{ $booking->phone }}</span>
                                @endif
                                <p class="mt-0.5 text-xs text-slate-400">Click to call</p>
                            </td>

                            {{-- Address --}}
                            <td class="px-5 py-4 text-sm text-slate-600">
                                <p class="max-w-xs truncate" title="{{ $booking->address }}">
                                    <i class="ri-map-pin-line mr-1 text-slate-400"></i>
                                    {{ $booking->address }}
                                </p>
                            </td>

                            {{-- Problem / Concern --}}
                            <td class="px-5 py-4">
                                <p class="max-w-sm text-sm leading-6 text-slate-600">
                                    {{ \Illuminate\Support\Str::limit($booking->problem, 110) }}
                                </p>
                            </td>

                            {{-- Requested Date --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                <p>{{ $booking->created_at->format('M d, Y') }}</p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    {{ $booking->created_at->format('g:i A') }} · {{ $booking->created_at->diffForHumans() }}
                                </p>
                            </td>

                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        wire:click="openBooking({{ $booking->id }})"
                                        aria-label="View booking details for {{ $booking->name }}"
                                        title="View Details"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="ri-eye-line"></i>
                                    </button>

                                    @if ($phoneHref)
                                        <a
                                            href="tel:{{ $phoneHref }}"
                                            aria-label="Call {{ $booking->name }}"
                                            title="Call Patient"
                                            class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-sky-300 hover:bg-sky-50 hover:text-med-blue">
                                            <i class="ri-phone-line"></i>
                                        </a>
                                    @endif

                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $booking->id }})"
                                        aria-label="Delete booking for {{ $booking->name }}"
                                        title="Delete Booking"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-red-200 hover:bg-red-50 hover:text-med-red">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-14 text-center">
                                <span class="mx-auto grid h-12 w-12 place-items-center bg-slate-100 text-2xl text-slate-400">
                                    <i class="ri-calendar-line"></i>
                                </span>

                                <p class="mt-4 text-sm font-semibold text-med-navy">
                                    {{ $search !== '' || $dateFilter !== 'all' ? 'No bookings match your filters.' : 'No appointment requests yet.' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $search !== '' || $dateFilter !== 'all' ? 'Try a different search term or date filter.' : 'New appointment requests from the website will appear here.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->bookings->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $this->bookings->links() }}
            </div>
        @endif
    </section>

    {{-- Booking Detail Modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.showBookingModal"
        x-transition.opacity
        @keydown.escape.window="$wire.closeBooking()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" wire:click="closeBooking"></div>

        @if ($this->selectedBooking)
            @php
                $detailInitials = str($this->selectedBooking->name)
                    ->explode(' ')
                    ->filter()
                    ->map(fn ($part) => str($part)->substr(0, 1)->upper())
                    ->take(2)
                    ->implode('');
                $detailPhoneHref = preg_replace('/[^\d+]/', '', (string) $this->selectedBooking->phone);
            @endphp

            <div
                x-transition
                role="dialog"
                aria-modal="true"
                aria-labelledby="booking-detail-title"
                class="relative flex max-h-[90vh] w-full max-w-2xl flex-col border border-slate-200 bg-white shadow-xl">

                <div class="flex items-start justify-between gap-4 border-b border-slate-100 p-5 sm:p-6">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <span class="grid h-12 w-12 shrink-0 place-items-center bg-sky-50 text-sm font-bold text-med-blue ring-1 ring-inset ring-sky-600/10">
                            {{ $detailInitials ?: 'PT' }}
                        </span>

                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-xs font-semibold text-slate-500">
                                    Age: {{ $this->selectedBooking->age }} years
                                </span>
                                <span class="text-xs text-slate-300">·</span>
                                <span class="text-xs text-slate-400">
                                    {{ $this->selectedBooking->created_at->format('M d, Y \a\t g:i A') }}
                                </span>
                            </div>

                            <h3 id="booking-detail-title" class="mt-1 truncate text-xl font-bold tracking-tight text-med-navy">
                                {{ $this->selectedBooking->name }}
                            </h3>
                        </div>
                    </div>

                    <button
                        type="button"
                        wire:click="closeBooking"
                        aria-label="Close modal"
                        class="grid h-8 w-8 shrink-0 place-items-center text-lg text-slate-400 transition hover:bg-slate-50 hover:text-med-navy">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <div class="flex-1 space-y-5 overflow-y-auto p-5 sm:p-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Patient Name</p>
                            <p class="mt-1.5 text-sm font-semibold text-med-navy">{{ $this->selectedBooking->name }}</p>
                        </div>

                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Patient Age</p>
                            <p class="mt-1.5 text-sm font-semibold text-med-navy">{{ $this->selectedBooking->age }} years old</p>
                        </div>

                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Phone Number</p>
                            @if ($detailPhoneHref)
                                <a href="tel:{{ $detailPhoneHref }}" class="mt-1.5 inline-flex items-center gap-1.5 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                                    <i class="ri-phone-line text-xs"></i>
                                    {{ $this->selectedBooking->phone }}
                                </a>
                            @else
                                <p class="mt-1.5 text-sm font-semibold text-slate-700">{{ $this->selectedBooking->phone }}</p>
                            @endif
                        </div>

                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Requested On</p>
                            <p class="mt-1.5 text-sm font-semibold text-med-navy">
                                {{ $this->selectedBooking->created_at->format('M d, Y') }}
                            </p>
                            <p class="mt-0.5 text-xs text-slate-400">
                                {{ $this->selectedBooking->created_at->format('g:i A') }} ({{ $this->selectedBooking->created_at->diffForHumans() }})
                            </p>
                        </div>
                    </div>

                    <div class="border border-slate-200 bg-slate-50/60 p-4">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Residential Address</p>
                        <p class="mt-1.5 text-sm text-slate-700 leading-6">{{ $this->selectedBooking->address }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Dental or Medical Concern</p>
                        <div class="mt-2 border border-slate-200 bg-white p-4">
                            <p class="whitespace-pre-line text-sm leading-7 text-slate-700">{{ $this->selectedBooking->problem }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    @if ($detailPhoneHref)
                        <a
                            href="tel:{{ $detailPhoneHref }}"
                            class="inline-flex items-center justify-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-med-blue hover:text-med-blue">
                            <i class="ri-phone-line text-base text-med-blue"></i>
                            Call {{ $this->selectedBooking->phone }}
                        </a>
                    @else
                        <div></div>
                    @endif

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                        <button
                            type="button"
                            wire:click="confirmDelete({{ $this->selectedBooking->id }})"
                            class="inline-flex items-center justify-center gap-2 border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-med-red transition hover:bg-red-100">
                            <i class="ri-delete-bin-6-line text-base"></i>
                            Delete
                        </button>

                        <button
                            type="button"
                            wire:click="closeBooking"
                            class="inline-flex items-center justify-center bg-med-blue px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Delete Modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.showDeleteModal"
        x-transition.opacity
        @keydown.escape.window="$wire.cancelDelete()"
        class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" wire:click="cancelDelete"></div>

        @if ($this->bookingToDelete)
            <div
                x-transition
                role="dialog"
                aria-modal="true"
                aria-labelledby="delete-booking-title"
                class="relative w-full max-w-md border border-slate-200 bg-white p-6 shadow-xl">

                <div class="flex items-start gap-4">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                        <i class="ri-delete-bin-6-line"></i>
                    </span>

                    <div class="min-w-0">
                        <h3 id="delete-booking-title" class="text-lg font-bold text-med-navy">Delete this booking?</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            The appointment request from
                            <span class="font-semibold text-slate-700">{{ $this->bookingToDelete->name }}</span>
                            will be permanently removed.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <button
                        type="button"
                        wire:click="cancelDelete"
                        class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-med-navy">
                        Cancel
                    </button>

                    <button
                        type="button"
                        wire:click="deleteBooking"
                        wire:loading.attr="disabled"
                        wire:target="deleteBooking"
                        class="inline-flex items-center justify-center gap-2 bg-med-red px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-70">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="deleteBooking"></i>
                        <span wire:loading.remove wire:target="deleteBooking">Delete booking</span>
                        <span wire:loading wire:target="deleteBooking">Deleting...</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
