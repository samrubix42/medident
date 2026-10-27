<div class="mx-auto max-w-7xl space-y-6">

    {{-- Flash message --}}
    @if (session('status'))
        <div class="flex items-center gap-3 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            <i class="ri-checkbox-circle-line text-lg"></i>
            {{ session('status') }}
        </div>
    @endif

    {{-- Page header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Content
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Services
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Manage physician and dental services, images, page content, and search engine details.
            </p>
        </div>

        <div class="flex w-fit flex-wrap items-center gap-2">
            <div class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
                <i class="ri-service-line text-lg text-med-blue"></i>
                {{ number_format($this->services->total()) }} services
            </div>

            <a
                href="{{ route('admin.service-categories') }}"
                wire:navigate
                class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                <i class="ri-folders-line text-lg"></i>
                Categories
            </a>

            <a
                href="{{ route('admin.services.create') }}"
                class="inline-flex items-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                <i class="ri-add-line text-lg"></i>
                Add service
            </a>
        </div>
    </div>

    {{-- Listing --}}
    <section class="border border-slate-200 bg-white">
        <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h3 class="font-bold text-med-navy">Service library</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Manage active and inactive clinic services.
                </p>
            </div>

            <div class="relative">
                <i class="ri-search-line pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400"></i>

                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search services..."
                    aria-label="Search services"
                    class="h-10 w-full border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 sm:w-64">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Service</th>
                        <th scope="col" class="px-5 py-3">Category</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                        <th scope="col" class="px-5 py-3">Updated</th>
                        <th scope="col" class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->services as $service)
                        <tr wire:key="service-{{ $service->id }}" class="transition hover:bg-slate-50/70">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($service->imageUrl())
                                        <img
                                            src="{{ $service->imageUrl() }}"
                                            alt="{{ $service->title }}"
                                            class="h-12 w-16 shrink-0 border border-slate-200 object-cover">
                                    @else
                                        <span class="grid h-12 w-16 shrink-0 place-items-center border border-slate-200 bg-slate-50 text-xl text-slate-300">
                                            <i class="ri-service-line"></i>
                                        </span>
                                    @endif

                                    <span class="min-w-0">
                                        <span class="block max-w-md truncate text-sm font-semibold text-med-navy">
                                            {{ $service->title }}
                                        </span>
                                        <span class="mt-0.5 block max-w-md truncate text-xs text-slate-400">
                                            /{{ $service->slug }}
                                        </span>
                                    </span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                {{ $service->category?->title ?? 'Uncategorized' }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                @if ($service->is_active)
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/10">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-500 ring-1 ring-inset ring-slate-500/10">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                {{ $service->updated_at?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('admin.services.edit', $service) }}"
                                        aria-label="Edit {{ $service->title }}"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="ri-pencil-line"></i>
                                    </a>

                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $service->id }})"
                                        aria-label="Delete {{ $service->title }}"
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
                                    <i class="ri-service-line"></i>
                                </span>

                                <p class="mt-4 text-sm font-semibold text-med-navy">
                                    {{ $search !== '' ? 'No services match your search.' : 'No services yet.' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $search !== '' ? 'Try a different title, slug, or category.' : 'Add your first service to build the service library.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->services->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $this->services->links() }}
            </div>
        @endif
    </section>

    {{-- Delete confirmation modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.showDeleteModal"
        @keydown.escape.window="$wire.showDeleteModal && $wire.cancelDelete()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">

        <div class="absolute inset-0 bg-slate-900/50" wire:click="cancelDelete"></div>

        @if ($this->serviceToDelete)
            <div
                x-transition
                class="relative w-full max-w-md border border-slate-200 bg-white p-6 shadow-xl">

                <div class="flex items-start gap-4">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                        <i class="ri-delete-bin-6-line"></i>
                    </span>

                    <div>
                        <h3 class="text-lg font-bold text-med-navy">Delete service</h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Are you sure you want to delete
                            <span class="font-semibold text-med-navy">{{ $this->serviceToDelete->title }}</span>?
                            This action cannot be undone.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-2">
                    <button
                        type="button"
                        wire:click="cancelDelete"
                        class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                        Cancel
                    </button>

                    <button
                        type="button"
                        wire:click="deleteService"
                        wire:loading.attr="disabled"
                        wire:target="deleteService"
                        class="inline-flex items-center justify-center gap-2 bg-med-red px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-200 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="deleteService"></i>
                        <i class="ri-delete-bin-6-line" wire:loading.remove wire:target="deleteService"></i>
                        <span wire:loading.remove wire:target="deleteService">Delete service</span>
                        <span wire:loading wire:target="deleteService">Deleting...</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
