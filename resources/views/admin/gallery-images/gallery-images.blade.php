<div class="mx-auto max-w-7xl space-y-6">

    {{-- Page header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                Gallery
            </p>

            <h2 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                Gallery images
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Upload photos, assign them to a category, and control which images appear on the public gallery.
            </p>
        </div>

        <div class="flex w-fit flex-wrap items-center gap-2">
            <div class="inline-flex items-center gap-2 border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-med-navy">
                <i class="ri-image-2-line text-lg text-med-blue"></i>
                {{ number_format($this->images->total()) }} images
            </div>

            <button
                type="button"
                wire:click="openCreateModal"
                class="inline-flex items-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200">
                <i class="ri-add-line text-lg"></i>
                Add image
            </button>
        </div>
    </div>

    {{-- Listing --}}
    <section class="border border-slate-200 bg-white">
        <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h3 class="font-bold text-med-navy">Image library</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Manage the photos displayed in the public gallery.
                </p>
            </div>

            <div class="relative">
                <i class="ri-search-line pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-base text-slate-400"></i>

                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search images..."
                    aria-label="Search gallery images"
                    class="h-10 w-full border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100 sm:w-64">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-semibold uppercase tracking-[0.14em] text-slate-500">
                    <tr>
                        <th scope="col" class="px-5 py-3">Image</th>
                        <th scope="col" class="px-5 py-3">Category</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                        <th scope="col" class="px-5 py-3">Created</th>
                        <th scope="col" class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->images as $galleryImage)
                        <tr wire:key="gallery-image-{{ $galleryImage->id }}" class="transition hover:bg-slate-50/70">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <img
                                        src="{{ $galleryImage->imageUrl() }}"
                                        alt="Gallery image in {{ $galleryImage->category?->title ?? 'uncategorized' }}"
                                        class="h-12 w-16 shrink-0 border border-slate-200 object-cover">

                                    <span class="min-w-0">
                                        <span class="block truncate text-sm font-semibold text-med-navy">
                                            {{ $galleryImage->category?->title ?? 'Uncategorized' }}
                                        </span>
                                        <span class="mt-0.5 block max-w-56 truncate text-xs text-slate-400">
                                            {{ $galleryImage->image_link }}
                                        </span>
                                    </span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                {{ $galleryImage->category?->title ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                @if ($galleryImage->is_active)
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
                                {{ $galleryImage->created_at?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        wire:click="openEditModal({{ $galleryImage->id }})"
                                        aria-label="Edit gallery image"
                                        class="inline-grid h-8 w-8 place-items-center border border-slate-200 text-sm text-slate-400 transition hover:border-med-blue hover:text-med-blue">
                                        <i class="ri-pencil-line"></i>
                                    </button>

                                    <button
                                        type="button"
                                        wire:click="confirmDelete({{ $galleryImage->id }})"
                                        aria-label="Delete gallery image"
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
                                    <i class="ri-image-2-line"></i>
                                </span>

                                <p class="mt-4 text-sm font-semibold text-med-navy">
                                    {{ $search !== '' ? 'No images match your search.' : 'No gallery images yet.' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $search !== '' ? 'Try a different search term.' : 'Upload your first image to start building the gallery.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->images->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                {{ $this->images->links() }}
            </div>
        @endif
    </section>

    {{-- Create / edit modal --}}
    <div
        x-data
        x-cloak
        x-show="$wire.showModal"
        @keydown.escape.window="$wire.showModal && $wire.closeModal()"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto p-4">

        <div class="fixed inset-0 bg-slate-900/50" wire:click="closeModal"></div>

        <div
            x-transition
            class="relative my-auto w-full max-w-xl border border-slate-200 bg-white shadow-xl">

            <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                <div>
                    <h3 class="text-lg font-bold text-med-navy">
                        {{ $editingImageId ? 'Edit gallery image' : 'New gallery image' }}
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        {{ $editingImageId ? 'Update the image, category, or visibility.' : 'Upload a photo and assign it to a category.' }}
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
                    <label for="gallery-category" class="text-sm font-semibold text-med-navy">
                        Category
                    </label>

                    <select
                        id="gallery-category"
                        wire:model="categoryId"
                        class="mt-2 h-10 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                        <option value="">Select a category</option>

                        @foreach ($this->categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>

                    @error('categoryId')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror

                    @if ($this->categories->isEmpty())
                        <p class="mt-2 text-xs font-medium text-amber-600">
                            Create a gallery category before uploading images.
                        </p>
                    @endif
                </div>

                <div>
                    <span class="text-sm font-semibold text-med-navy">
                        Image
                    </span>

                    <label
                        for="gallery-image-upload"
                        class="group mt-2 flex cursor-pointer flex-col items-center justify-center overflow-hidden border-2 border-dashed border-slate-200 bg-slate-50 px-5 py-6 text-center transition hover:border-med-blue hover:bg-sky-50/60">

                        @if ($image)
                            <img
                                src="{{ $image->temporaryUrl() }}"
                                alt="Selected gallery image preview"
                                class="max-h-52 w-auto max-w-full border border-slate-200 bg-white object-contain">
                        @elseif ($currentImageLink)
                            <img
                                src="{{ asset($currentImageLink) }}"
                                alt="Current gallery image preview"
                                class="max-h-52 w-auto max-w-full border border-slate-200 bg-white object-contain">
                        @else
                            <span class="grid h-14 w-14 place-items-center bg-white text-2xl text-med-blue shadow-sm">
                                <i class="ri-upload-cloud-2-line"></i>
                            </span>
                        @endif

                        <span class="mt-4 text-sm font-semibold text-med-navy">
                            {{ $image || $currentImageLink ? 'Choose a different image' : 'Click to upload an image' }}
                        </span>

                        <span class="mt-1 text-xs text-slate-400">
                            JPG, PNG, WEBP, GIF or BMP up to 5 MB
                        </span>

                        <input
                            id="gallery-image-upload"
                            type="file"
                            wire:model="image"
                            accept="image/*"
                            class="sr-only">
                    </label>

                    <div wire:loading wire:target="image" class="mt-2 flex items-center gap-2 text-xs font-medium text-med-blue">
                        <i class="ri-loader-4-line animate-spin"></i>
                        Uploading image...
                    </div>

                    @if ($editingImageId && ! $image)
                        <p class="mt-2 text-[11px] text-slate-400">
                            Leave empty to keep the current image.
                        </p>
                    @endif

                    @error('image')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex cursor-pointer items-start gap-3 border border-slate-200 bg-slate-50/70 p-4">
                    <input
                        type="checkbox"
                        wire:model="isActive"
                        class="mt-0.5 h-4 w-4 border-slate-300 text-med-blue focus:ring-sky-200">

                    <span>
                        <span class="block text-sm font-semibold text-med-navy">Active image</span>
                        <span class="mt-0.5 block text-xs leading-5 text-slate-500">
                            Active images are visible on the public gallery.
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
                        wire:target="save,image"
                        class="inline-flex items-center justify-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="save,image"></i>
                        <i class="ri-save-3-line" wire:loading.remove wire:target="save,image"></i>
                        <span wire:loading.remove wire:target="save,image">{{ $editingImageId ? 'Save changes' : 'Upload image' }}</span>
                        <span wire:loading wire:target="save,image">Saving...</span>
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

        @if ($this->imageToDelete)
            <div
                x-transition
                class="relative w-full max-w-md border border-slate-200 bg-white p-6 shadow-xl">

                <div class="flex items-start gap-4">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-red-50 text-xl text-med-red">
                        <i class="ri-delete-bin-6-line"></i>
                    </span>

                    <div>
                        <h3 class="text-lg font-bold text-med-navy">Delete image</h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Are you sure you want to delete this gallery image from
                            <span class="font-semibold text-med-navy">{{ $this->imageToDelete->category?->title ?? 'Uncategorized' }}</span>?
                            This action cannot be undone.
                        </p>
                    </div>
                </div>

                <img
                    src="{{ $this->imageToDelete->imageUrl() }}"
                    alt="Gallery image selected for deletion"
                    class="mt-5 h-32 w-full border border-slate-200 object-cover">

                <div class="mt-6 flex items-center justify-end gap-2">
                    <button
                        type="button"
                        wire:click="cancelDelete"
                        class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                        Cancel
                    </button>

                    <button
                        type="button"
                        wire:click="deleteImage"
                        wire:loading.attr="disabled"
                        wire:target="deleteImage"
                        class="inline-flex items-center justify-center gap-2 bg-med-red px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-200 disabled:cursor-not-allowed disabled:opacity-60">
                        <i class="ri-loader-4-line animate-spin" wire:loading wire:target="deleteImage"></i>
                        <i class="ri-delete-bin-6-line" wire:loading.remove wire:target="deleteImage"></i>
                        <span wire:loading.remove wire:target="deleteImage">Delete image</span>
                        <span wire:loading wire:target="deleteImage">Deleting...</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
