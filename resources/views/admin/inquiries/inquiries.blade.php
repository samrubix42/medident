<div
    x-data
    x-effect="document.body.classList.toggle('overflow-hidden', $wire.showInquiryModal || $wire.showDeleteModal)"
    class="mx-auto max-w-7xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Contact Messages
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Inquiries
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Review messages submitted through the contact form and keep track of follow-ups.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
                <i class="ri-mail-line text-lg text-slate-400"></i>
                {{ number_format($this->stats['total']) }} total
            </span>

            <span class="inline-flex items-center gap-2 border border-sky-100 bg-sky-50 px-4 py-2.5 text-sm font-semibold text-med-blue">
                <span class="h-2 w-2 rounded-full bg-med-blue"></span>
                {{ number_format($this->stats['unread']) }} unread
            </span>

            <button
                type="button"
                wire:click="markAllAsRead"
                wire:loading.attr="disabled"
                wire:target="markAllAsRead"
                @disabled($this->stats['unread'] === 0)
                class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-med-blue hover:text-med-blue disabled:cursor-not-allowed disabled:opacity-50">
                <i class="ri-mail-open-line text-lg" wire:loading.remove wire:target="markAllAsRead"></i>
                <i class="ri-loader-4-line animate-spin text-lg" wire:loading wire:target="markAllAsRead"></i>
                Mark all read
            </button>
        </div>
    </div>

    <section class="border border-slate-200 bg-white">
        <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h3 class="font-bold text-med-navy">Inquiry inbox</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Showing the newest inquiries first.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative">
                    <i class="ri-search-line pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400"></i>

                    <input
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search inquiries..."
                        aria-label="Search inquiries"
                        class="h-10 w-full border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 sm:w-64">
                </div>

                <select
                    wire:model.live="filter"
                    aria-label="Filter inquiries"
                    class="h-10 border border-slate-200 bg-white px-3 text-sm text-slate-600 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                    <option value="all">All inquiries</option>
                    <option value="unread">Unread only</option>
                    <option value="read">Read only</option>
                </select>

                <select
                    wire:model.live="perPage"
                    aria-label="Inquiries per page"
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
                        <th scope="col" class="px-5 py-3">Status</th>
                        <th scope="col" class="px-5 py-3">Sender</th>
                        <th scope="col" class="px-5 py-3">Subject</th>
                        <th scope="col" class="px-5 py-3">Received</th>
                        <th scope="col" class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->inquiries as $inquiry)
                        <tr wire:key="inquiry-{{ $inquiry->id }}" class="align-top transition hover:bg-slate-50/70">
                            <td class="whitespace-nowrap px-5 py-4">
                                @if ($inquiry->is_read)
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                        <i class="ri-check-double-line"></i>
                                        Read
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-sky-50 px-2.5 py-1 text-xs font-semibold text-med-blue ring-1 ring-inset ring-sky-600/10">
                                        <span class="h-1.5 w-1.5 rounded-full bg-med-blue"></span>
                                        Unread
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <button
                                    type="button"
                                    wire:click="openInquiry({{ $inquiry->id }})"
                                    class="max-w-56 truncate text-left text-sm font-semibold text-med-navy transition hover:text-med-blue">
                                    {{ $inquiry->name }}
                                </button>

                                <p class="mt-0.5 max-w-56 truncate text-xs text-slate-500">
                                    {{ $inquiry->email ?: 'No email provided' }}
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    {{ $inquiry->phone }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                <button
                                    type="button"
                                    wire:click="openInquiry({{ $inquiry->id }})"
                                    class="block max-w-md truncate text-left text-sm font-semibold text-med-navy transition hover:text-med-blue">
                                    {{ $inquiry->subject }}
                                </button>

                                <p class="mt-1 max-w-md text-sm leading-6 text-slate-500">
                                    {{ \Illuminate\Support\Str::limit($inquiry->message, 130) }}
                                </p>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                <p>{{ $inquiry->created_at->format('M d, Y') }}</p>
                                <p class="mt-0.5 text-xs text-slate-400">{{ $inquiry->created_at->format('g:i A') }}</p>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        wire:click="openInquiry({{ $inquiry->id }})"
                                        aria-label="View inquiry from {{ $inquiry->name }}"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="ri-eye-line"></i>
                                    </button>

                                    <button
                                        type="button"
                                        wire:click="toggleRead({{ $inquiry->id }})"
                                        aria-label="{{ $inquiry->is_read ? 'Mark inquiry as unread' : 'Mark inquiry as read' }}"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="{{ $inquiry->is_read ? 'ri-mail-unread-line' : 'ri-mail-open-line' }}"></i>
                                    </button>

                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $inquiry->id }})"
                                        aria-label="Delete inquiry from {{ $inquiry->name }}"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-red-200 hover:bg-red-50 hover:text-med-red">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-14 text-center">
                                <span class="mx-auto grid h-12 w-12 place-items-center bg-slate-100 text-2xl text-slate-400">
                                    <i class="ri-mail-line"></i>
                                </span>

                                <p class="mt-4 text-sm font-semibold text-med-navy">
                                    {{ $search !== '' || $filter !== 'all' ? 'No inquiries match your filters.' : 'No inquiries yet.' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $search !== '' || $filter !== 'all' ? 'Try a different search term or status filter.' : 'New contact form submissions will appear here.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->inquiries->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $this->inquiries->links() }}
            </div>
        @endif
    </section>

    <div
        x-data
        x-cloak
        x-show="$wire.showInquiryModal"
        x-transition.opacity
        @keydown.escape.window="$wire.closeInquiry()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" wire:click="closeInquiry"></div>

        @if ($this->selectedInquiry)
            <div
                x-transition
                role="dialog"
                aria-modal="true"
                aria-labelledby="inquiry-detail-title"
                class="relative flex max-h-[90vh] w-full max-w-2xl flex-col border border-slate-200 bg-white shadow-xl">

                <div class="flex items-start justify-between gap-4 border-b border-slate-100 p-5 sm:p-6">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            @if ($this->selectedInquiry->is_read)
                                <span class="inline-flex items-center gap-1.5 bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                    <i class="ri-check-double-line"></i>
                                    Read
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-sky-50 px-2.5 py-1 text-xs font-semibold text-med-blue ring-1 ring-inset ring-sky-600/10">
                                    <span class="h-1.5 w-1.5 rounded-full bg-med-blue"></span>
                                    Unread
                                </span>
                            @endif

                            <span class="text-xs text-slate-400">
                                {{ $this->selectedInquiry->created_at->format('M d, Y \a\t g:i A') }}
                            </span>
                        </div>

                        <h3 id="inquiry-detail-title" class="mt-3 text-xl font-bold tracking-tight text-med-navy">
                            {{ $this->selectedInquiry->subject }}
                        </h3>
                    </div>

                    <button
                        type="button"
                        wire:click="closeInquiry"
                        aria-label="Close inquiry"
                        class="grid h-8 w-8 shrink-0 place-items-center text-lg text-slate-400 transition hover:bg-slate-50 hover:text-med-navy">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <div class="flex-1 space-y-5 overflow-y-auto p-5 sm:p-6">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Name</p>
                            <p class="mt-1.5 text-sm font-semibold text-med-navy">{{ $this->selectedInquiry->name }}</p>
                        </div>

                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Email</p>

                            @if ($this->selectedInquiry->email)
                                <a href="mailto:{{ $this->selectedInquiry->email }}" class="mt-1.5 block break-all text-sm font-semibold text-med-blue transition hover:text-sky-800">
                                    {{ $this->selectedInquiry->email }}
                                </a>
                            @else
                                <p class="mt-1.5 text-sm text-slate-500">Not provided</p>
                            @endif
                        </div>

                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Phone</p>
                            <a href="tel:{{ $this->selectedInquiry->phone }}" class="mt-1.5 block text-sm font-semibold text-med-blue transition hover:text-sky-800">
                                {{ $this->selectedInquiry->phone }}
                            </a>
                        </div>

                        <div class="border border-slate-200 bg-slate-50/60 p-4">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Received</p>
                            <p class="mt-1.5 text-sm font-semibold text-med-navy">
                                {{ $this->selectedInquiry->created_at->format('M d, Y') }}
                            </p>
                            <p class="mt-0.5 text-xs text-slate-400">
                                {{ $this->selectedInquiry->created_at->format('g:i A') }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-400">Message</p>
                        <p class="mt-2 whitespace-pre-line border border-slate-200 bg-white p-4 text-sm leading-7 text-slate-600">{{ $this->selectedInquiry->message }}</p>
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <button
                        type="button"
                        wire:click="toggleRead({{ $this->selectedInquiry->id }})"
                        class="inline-flex items-center justify-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-med-blue hover:text-med-blue">
                        <i class="{{ $this->selectedInquiry->is_read ? 'ri-mail-unread-line' : 'ri-mail-open-line' }} text-base"></i>
                        {{ $this->selectedInquiry->is_read ? 'Mark as unread' : 'Mark as read' }}
                    </button>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                        <button
                            type="button"
                            wire:click="confirmDelete({{ $this->selectedInquiry->id }})"
                            class="inline-flex items-center justify-center gap-2 border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-med-red transition hover:bg-red-100">
                            <i class="ri-delete-bin-6-line text-base"></i>
                            Delete
                        </button>

                        <button
                            type="button"
                            wire:click="closeInquiry"
                            class="inline-flex items-center justify-center bg-med-blue px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div
        x-data
        x-cloak
        x-show="$wire.showDeleteModal"
        x-transition.opacity
        @keydown.escape.window="$wire.cancelDelete()"
        class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" wire:click="cancelDelete"></div>

        @if ($this->inquiryToDelete)
            <div
                x-transition
                role="dialog"
                aria-modal="true"
                aria-labelledby="delete-inquiry-title"
                class="relative w-full max-w-md border border-slate-200 bg-white p-6 shadow-xl">

                <div class="flex items-start gap-4">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                        <i class="ri-delete-bin-6-line"></i>
                    </span>

                    <div class="min-w-0">
                        <h3 id="delete-inquiry-title" class="text-lg font-bold text-med-navy">Delete this inquiry?</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            The inquiry from
                            <span class="font-semibold text-slate-700">{{ $this->inquiryToDelete->name }}</span>
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
                        wire:click="deleteInquiry"
                        wire:loading.attr="disabled"
                        wire:target="deleteInquiry"
                        class="inline-flex items-center justify-center gap-2 bg-med-red px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-70">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="deleteInquiry"></i>
                        <span wire:loading.remove wire:target="deleteInquiry">Delete inquiry</span>
                        <span wire:loading wire:target="deleteInquiry">Deleting...</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
