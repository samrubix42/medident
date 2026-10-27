<div class="mx-auto max-w-7xl space-y-6">

    {{-- Page header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Content
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Service categories
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Group clinic services by care type, such as physician and dental, and control which categories are active.
            </p>
        </div>

        <div class="flex w-fit flex-wrap items-center gap-2">
            <div class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
                <i class="ri-folders-line text-lg text-med-blue"></i>
                {{ number_format($this->categories->total()) }} categories
            </div>

            <a href="{{ route('admin.services') }}"
               wire:navigate
               class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                <i class="ri-service-line text-lg"></i>
                Manage services
            </a>

            <button
                type="button"
                wire:click="openCreateModal"
                class="inline-flex items-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                <i class="ri-add-line text-lg"></i>
                Add category
            </button>
        </div>
    </div>

    {{-- Listing --}}
    <section class="border border-slate-200 bg-white">
        <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h3 class="font-bold text-med-navy">Category library</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Manage the categories used to group services.
                </p>
            </div>

            <div class="relative">
                <i class="ri-search-line pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400"></i>

                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search categories..."
                    aria-label="Search service categories"
                    class="h-10 w-full border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 sm:w-64">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Category</th>
                        <th scope="col" class="px-5 py-3">Slug</th>
                        <th scope="col" class="px-5 py-3">Services</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                        <th scope="col" class="px-5 py-3">Created</th>
                        <th scope="col" class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->categories as $category)
                        <tr wire:key="service-category-{{ $category->id }}" class="transition hover:bg-slate-50/70">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="grid h-9 w-9 shrink-0 place-items-center bg-sky-50 text-med-blue">
                                        <i class="ri-folders-line text-lg"></i>
                                    </span>

                                    <span class="text-sm font-semibold text-med-navy">
                                        {{ $category->title }}
                                    </span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                /{{ $category->slug }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                {{ number_format($category->services_count) }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                @if ($category->is_active)
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
                                {{ $category->created_at?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        wire:click="openEditModal({{ $category->id }})"
                                        aria-label="Edit {{ $category->title }}"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="ri-pencil-line"></i>
                                    </button>

                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $category->id }})"
                                        aria-label="Delete {{ $category->title }}"
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
                                    <i class="ri-folders-line"></i>
                                </span>

                                <p class="mt-4 text-sm font-semibold text-med-navy">
                                    {{ $search !== '' ? 'No categories match your search.' : 'No service categories yet.' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $search !== '' ? 'Try a different category title or slug.' : 'Add your first category to start organizing services.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->categories->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $this->categories->links() }}
            </div>
        @endif
    </section>

    {{-- Create / edit modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.showModal"
        @keydown.escape.window="$wire.showModal && $wire.closeModal()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">

        <div class="absolute inset-0 bg-slate-900/50" wire:click="closeModal"></div>

        <div
            x-transition
            class="relative w-full max-w-lg border border-slate-200 bg-white shadow-xl">

            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-bold text-med-navy">
                        {{ $editingCategoryId ? 'Edit service category' : 'New service category' }}
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        {{ $editingCategoryId ? 'Update the category details below.' : 'Create a category such as Physician or Dental.' }}
                    </p>
                </div>

                <button
                    type="button"
                    wire:click="closeModal"
                    aria-label="Close modal"
                    class="grid h-8 w-8 place-items-center text-lg text-slate-400 transition hover:bg-slate-50 hover:text-med-navy">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <form wire:submit="save" class="space-y-5 p-6">
                <div>
                    <label for="service-category-title" class="text-sm font-semibold text-med-navy">
                        Title
                    </label>

                    <input
                        id="service-category-title"
                        type="text"
                        wire:model.live.debounce.300ms="title"
                        placeholder="e.g. Physician"
                        autocomplete="off"
                        class="mt-2 h-10 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                    @error('title')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="service-category-slug" class="text-sm font-semibold text-med-navy">
                        Slug
                    </label>

                    <div class="mt-2 flex items-stretch">
                        <span class="inline-flex items-center border border-r-0 border-slate-200 bg-slate-50 px-3 text-xs font-medium text-slate-400">
                            /services/
                        </span>

                        <input
                            id="service-category-slug"
                            type="text"
                            wire:model.live.debounce.300ms="slug"
                            placeholder="physician"
                            autocomplete="off"
                            class="h-10 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                    </div>

                    @error('slug')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-[11px] text-slate-400">
                        Generated from the title until you edit it. Must be unique.
                    </p>
                </div>

                <label class="flex cursor-pointer items-start gap-3 border border-slate-200 bg-slate-50/70 p-4">
                    <input
                        type="checkbox"
                        wire:model="isActive"
                        class="mt-0.5 h-4 w-4 border-slate-300 text-med-blue focus:ring-sky-200">

                    <span>
                        <span class="block text-sm font-semibold text-med-navy">Active category</span>
                        <span class="mt-0.5 block text-xs leading-5 text-slate-500">
                            Active categories can be used for visible clinic services.
                        </span>
                    </span>
                </label>

                <div class="flex items-center justify-end gap-2 border-t border-slate-100 pt-5">
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="save"
                        class="inline-flex items-center justify-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="save"></i>
                        <i class="ri-save-3-line" wire:loading.remove wire:target="save"></i>
                        <span wire:loading.remove wire:target="save">{{ $editingCategoryId ? 'Save changes' : 'Create category' }}</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete confirmation modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.showDeleteModal"
        @keydown.escape.window="$wire.showDeleteModal && $wire.cancelDelete()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4">

        <div class="absolute inset-0 bg-slate-900/50" wire:click="cancelDelete"></div>

        @if ($this->categoryToDelete)
            <div
                x-transition
                class="relative w-full max-w-md border border-slate-200 bg-white p-6 shadow-xl">

                <div class="flex items-start gap-4">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                        <i class="ri-delete-bin-6-line"></i>
                    </span>

                    <div>
                        <h3 class="text-lg font-bold text-med-navy">Delete service category</h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Are you sure you want to delete
                            <span class="font-semibold text-med-navy">{{ $this->categoryToDelete->title }}</span>?
                            This action cannot be undone.
                        </p>

                        @if ($this->categoryToDelete->services_count > 0)
                            <p class="mt-2 text-xs leading-5 text-slate-500">
                                {{ number_format($this->categoryToDelete->services_count) }} service(s) will become uncategorized.
                            </p>
                        @endif
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
                        wire:click="deleteCategory"
                        wire:loading.attr="disabled"
                        wire:target="deleteCategory"
                        class="inline-flex items-center justify-center gap-2 bg-med-red px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-200 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="deleteCategory"></i>
                        <i class="ri-delete-bin-6-line" wire:loading.remove wire:target="deleteCategory"></i>
                        <span wire:loading.remove wire:target="deleteCategory">Delete category</span>
                        <span wire:loading wire:target="deleteCategory">Deleting...</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
