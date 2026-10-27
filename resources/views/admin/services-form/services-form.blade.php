<div class="mx-auto max-w-6xl space-y-6">

    {{-- Page header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <a href="{{ route('admin.services') }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 transition hover:text-med-blue">
                <i class="ri-arrow-left-line"></i>
                Back to services
            </a>

            <h2 class="mt-3 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                {{ $serviceId ? 'Edit service' : 'Create service' }}
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                {{ $serviceId ? 'Update the service content, image, and search engine details.' : 'Add a new physician or dental service to the clinic library.' }}
            </p>
        </div>

        <div class="flex w-fit items-center gap-2">
            <a href="{{ route('admin.services') }}"
               class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                Cancel
            </a>

            <button
                type="submit"
                form="service-form"
                wire:loading.attr="disabled"
                wire:target="save,imageUpload"
                class="inline-flex items-center justify-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200 disabled:cursor-not-allowed disabled:opacity-60">
                <i class="ri-loader-4-line animate-spin" wire:loading wire:target="save,imageUpload"></i>
                <i class="ri-save-3-line" wire:loading.remove wire:target="save,imageUpload"></i>
                <span wire:loading.remove wire:target="save,imageUpload">{{ $serviceId ? 'Save changes' : 'Create service' }}</span>
                <span wire:loading wire:target="save,imageUpload">Saving...</span>
            </button>
        </div>
    </div>

    @if ($this->categories->isEmpty())
        <div class="flex flex-col gap-3 border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800 sm:flex-row sm:items-center sm:justify-between">
            <span class="inline-flex items-center gap-2">
                <i class="ri-alert-line text-lg"></i>
                Add a service category before creating a service.
            </span>

            <a href="{{ route('admin.service-categories') }}"
               wire:navigate
               class="inline-flex w-fit items-center gap-1.5 font-semibold text-amber-900 underline underline-offset-2">
                Manage categories
                <i class="ri-arrow-right-line"></i>
            </a>
        </div>
    @endif

    <form id="service-form" wire:submit="save" class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_340px]">

        <div class="space-y-6">
            {{-- Service details --}}
            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                    <h3 class="font-bold text-med-navy">Service details</h3>
                    <p class="mt-1 text-xs text-slate-500">The title, URL slug, category, and short summary.</p>
                </div>

                <div class="space-y-5 p-5 sm:p-6">
                    <div>
                        <label for="service-title" class="text-sm font-semibold text-med-navy">
                            Title
                        </label>

                        <input
                            id="service-title"
                            type="text"
                            wire:model.live.debounce.300ms="title"
                            placeholder="e.g. Dental Implants"
                            autocomplete="off"
                            class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                        @error('title')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="service-slug" class="text-sm font-semibold text-med-navy">
                                Slug
                            </label>

                            <div class="mt-2 flex items-stretch">
                                <span class="inline-flex items-center border border-r-0 border-slate-200 bg-slate-50 px-3 text-xs font-medium text-slate-400">
                                    /services/
                                </span>

                                <input
                                    id="service-slug"
                                    type="text"
                                    wire:model.live.debounce.300ms="slug"
                                    placeholder="dental-implants"
                                    autocomplete="off"
                                    class="h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                            </div>

                            @error('slug')
                                <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="service-category" class="text-sm font-semibold text-med-navy">
                                Category
                            </label>

                            <select
                                id="service-category"
                                wire:model="serviceCategoryId"
                                class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                                <option value="">Select a category</option>

                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->title }}{{ $category->is_active ? '' : ' (inactive)' }}
                                    </option>
                                @endforeach
                            </select>

                            @error('serviceCategoryId')
                                <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-3">
                            <label for="service-short-description" class="text-sm font-semibold text-med-navy">
                                Short description
                            </label>

                            <span class="text-[11px] text-slate-400">
                                {{ strlen($shortDescription) }}/500
                            </span>
                        </div>

                        <textarea
                            id="service-short-description"
                            wire:model="shortDescription"
                            rows="3"
                            placeholder="A short summary for service cards and listings."
                            class="mt-2 w-full resize-y border border-slate-200 bg-white px-3 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100"></textarea>

                        @error('shortDescription')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- Content --}}
            <section class="border border-slate-200 bg-white">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div>
                        <h3 class="font-bold text-med-navy">Service content</h3>
                        <p class="mt-1 text-xs text-slate-500">Use the editor to format headings, lists, links, and tables.</p>
                    </div>

                    <span class="inline-flex items-center gap-1.5 bg-sky-50 px-2.5 py-1 text-[11px] font-semibold text-med-blue">
                        <i class="ri-text"></i>
                        Rich text
                    </span>
                </div>

                <div class="p-5 sm:p-6">
                    <div wire:ignore>
                        <textarea
                            id="service-content"
                            wire:model="content"
                            rows="18"
                            class="w-full border border-slate-200 bg-white px-3 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">{{ $content }}</textarea>
                    </div>

                    @error('content')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            {{-- SEO --}}
            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                    <h3 class="font-bold text-med-navy">Search engine details</h3>
                    <p class="mt-1 text-xs text-slate-500">Optional metadata used by search engines and social previews.</p>
                </div>

                <div class="space-y-5 p-5 sm:p-6">
                    <div>
                        <label for="service-meta-title" class="text-sm font-semibold text-med-navy">
                            Meta title
                        </label>

                        <input
                            id="service-meta-title"
                            type="text"
                            wire:model="metaTitle"
                            placeholder="Defaults to the service title"
                            autocomplete="off"
                            class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                        @error('metaTitle')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-3">
                            <label for="service-meta-description" class="text-sm font-semibold text-med-navy">
                                Meta description
                            </label>

                            <span class="text-[11px] text-slate-400">
                                {{ strlen($metaDescription) }}/1000
                            </span>
                        </div>

                        <textarea
                            id="service-meta-description"
                            wire:model="metaDescription"
                            rows="4"
                            placeholder="A short summary for search results."
                            class="mt-2 w-full resize-y border border-slate-200 bg-white px-3 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100"></textarea>

                        @error('metaDescription')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="service-meta-keyword" class="text-sm font-semibold text-med-navy">
                            Meta keywords
                        </label>

                        <input
                            id="service-meta-keyword"
                            type="text"
                            wire:model="metaKeyword"
                            placeholder="e.g. dental implants, missing teeth, implant dentist"
                            autocomplete="off"
                            class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                        @error('metaKeyword')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror

                        <p class="mt-2 text-[11px] text-slate-400">
                            Separate keywords with commas.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <div class="space-y-6 lg:sticky lg:top-24 lg:self-start">
            {{-- Image --}}
            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-bold text-med-navy">Service image</h3>
                    <p class="mt-1 text-xs text-slate-500">Upload a new image, enter a link, or pick a home page image.</p>
                </div>

                <div class="space-y-4 p-5">
                    @if ($this->imagePreviewUrl())
                        <img
                            src="{{ $this->imagePreviewUrl() }}"
                            alt="Service image preview"
                            class="aspect-[16/10] w-full border border-slate-200 bg-slate-50 object-cover">
                    @else
                        <div class="grid aspect-[16/10] w-full place-items-center border-2 border-dashed border-slate-200 bg-slate-50 text-slate-300">
                            <i class="ri-image-line text-3xl"></i>
                        </div>
                    @endif

                    <label
                        for="service-image-upload"
                        class="group flex cursor-pointer flex-col items-center justify-center border-2 border-dashed border-slate-200 bg-slate-50 p-4 text-center transition hover:border-med-blue hover:bg-sky-50/60">
                        <span class="grid h-12 w-12 place-items-center bg-white text-xl text-med-blue shadow-sm">
                            <i class="ri-upload-cloud-2-line"></i>
                        </span>

                        <span class="mt-2 block text-sm font-semibold text-med-navy">
                            {{ $imageUpload ? 'Choose a different file' : 'Upload an image' }}
                        </span>

                        <span class="mt-1 block text-xs leading-5 text-slate-400">
                            JPG, PNG, WEBP, GIF or BMP up to 5 MB
                        </span>

                        <input
                            id="service-image-upload"
                            type="file"
                            wire:model="imageUpload"
                            accept="image/*"
                            class="sr-only">
                    </label>

                    <div wire:loading wire:target="imageUpload" class="flex items-center gap-2 text-xs font-medium text-med-blue">
                        <i class="ri-loader-4-line animate-spin"></i>
                        Uploading image...
                    </div>

                    @error('imageUpload')
                        <p class="text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror

                    <div class="border-t border-slate-100 pt-4">
                        <label for="service-image-link" class="text-sm font-semibold text-med-navy">
                            Image link
                        </label>

                        <input
                            id="service-image-link"
                            type="text"
                            wire:model.live.debounce.500ms="imageLink"
                            placeholder="e.g. dental/Dental-Implants.jpg"
                            autocomplete="off"
                            class="mt-2 h-10 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                        @error('imageLink')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror

                        @if ($imageLink !== '' || $imageUpload)
                            <button
                                type="button"
                                wire:click="clearImage"
                                class="mt-2 inline-flex items-center gap-1.5 text-xs font-semibold text-med-red transition hover:text-red-700">
                                <i class="ri-close-circle-line"></i>
                                Remove selected image
                            </button>
                        @endif
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <details class="group">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-2">
                                <span>
                                    <span class="block text-sm font-semibold text-med-navy">Pick a home page image</span>
                                    <span class="mt-0.5 block text-xs text-slate-500">Use the same images displayed on the home page.</span>
                                </span>

                                <i class="ri-arrow-down-s-line text-lg text-slate-400 transition group-open:rotate-180"></i>
                            </summary>

                            <div class="mt-3 grid max-h-80 grid-cols-2 gap-2 overflow-y-auto pr-1">
                                @foreach ($this->homeImages as $path => $label)
                                    <button
                                        type="button"
                                        wire:click="selectHomeImage('{{ $path }}')"
                                        title="Use {{ $label }} image"
                                        @class([
                                            'group/image overflow-hidden border bg-white text-left transition hover:border-med-blue',
                                            'border-med-blue ring-2 ring-sky-200' => $imageLink === $path,
                                            'border-slate-200' => $imageLink !== $path,
                                        ])>
                                        <img
                                            src="{{ asset($path) }}"
                                            alt="{{ $label }}"
                                            loading="lazy"
                                            class="aspect-[4/3] w-full object-cover">

                                        <span class="block truncate px-2 py-1.5 text-[10px] font-semibold text-slate-600">
                                            {{ $label }}
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                        </details>
                    </div>
                </div>
            </section>

            {{-- Visibility --}}
            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-bold text-med-navy">Visibility</h3>
                    <p class="mt-1 text-xs text-slate-500">Control whether this service is active.</p>
                </div>

                <div class="p-5">
                    <label class="flex cursor-pointer items-start gap-3 border border-slate-200 bg-slate-50/70 p-4">
                        <input
                            type="checkbox"
                            wire:model="isActive"
                            class="mt-0.5 h-4 w-4 border-slate-300 text-med-blue focus:ring-sky-200">

                        <span>
                            <span class="block text-sm font-semibold text-med-navy">Active service</span>
                            <span class="mt-0.5 block text-xs leading-5 text-slate-500">
                                Active services are available to display on the public website.
                            </span>
                        </span>
                    </label>
                </div>
            </section>
        </div>
    </form>
</div>

@assets
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
@endassets

<script>
    (() => {
        const textarea = document.getElementById('service-content');

        if (!window.tinymce || !textarea) {
            return;
        }

        const existingEditor = window.tinymce.get('service-content');

        if (existingEditor) {
            existingEditor.remove();
        }

        window.tinymce.init({
            selector: '#service-content',
            base_url: '{{ asset('tinymce') }}/',
            height: 520,
            menubar: false,
            branding: false,
            promotion: false,
            plugins: 'lists link table code fullscreen wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link table | code fullscreen',
            content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; line-height: 1.7; color: #475569; }',
            setup: (editor) => {
                editor.on('change input undo redo', () => {
                    editor.save();

                    const textarea = document.getElementById('service-content');

                    if (textarea) {
                        textarea.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                });
            },
        });

        const form = document.getElementById('service-form');

        form?.addEventListener('submit', () => {
            window.tinymce.triggerSave();
        }, true);

        document.addEventListener('livewire:navigating', () => {
            const editor = window.tinymce.get('service-content');

            if (editor) {
                editor.remove();
            }
        }, { once: true });
    })();
</script>
