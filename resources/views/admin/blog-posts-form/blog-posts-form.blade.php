<div class="mx-auto max-w-6xl space-y-6">

    {{-- Page header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <a href="{{ route('admin.blog-posts') }}"
               wire:navigate
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 transition hover:text-med-blue">
                <i class="ri-arrow-left-line"></i>
                Back to blog posts
            </a>

            <h2 class="mt-3 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                {{ $blogPostId ? 'Edit blog post' : 'Create blog post' }}
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                {{ $blogPostId ? 'Update the article, SEO details, and publishing settings.' : 'Write a new article and publish it to the MediDENT blog.' }}
            </p>
        </div>

        <div class="flex w-fit items-center gap-2">
            <a href="{{ route('admin.blog-posts') }}"
               wire:navigate
               class="inline-flex items-center justify-center border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                Cancel
            </a>

            <button
                type="submit"
                form="blog-post-form"
                wire:loading.attr="disabled"
                wire:target="save,featureImage"
                class="inline-flex items-center justify-center gap-2 bg-med-blue px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200 disabled:cursor-not-allowed disabled:opacity-60">
                <i class="ri-loader-4-line animate-spin" wire:loading wire:target="save,featureImage"></i>
                <i class="ri-save-3-line" wire:loading.remove wire:target="save,featureImage"></i>
                <span wire:loading.remove wire:target="save,featureImage">{{ $blogPostId ? 'Save changes' : 'Create article' }}</span>
                <span wire:loading wire:target="save,featureImage">Saving...</span>
            </button>
        </div>
    </div>

    @if ($this->categories->isEmpty())
        <div class="flex flex-col gap-3 border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800 sm:flex-row sm:items-center sm:justify-between">
            <span class="inline-flex items-center gap-2">
                <i class="ri-alert-line text-lg"></i>
                Add a blog category before creating an article.
            </span>

            <a href="{{ route('admin.blog-categories') }}"
               wire:navigate
               class="inline-flex w-fit items-center gap-1.5 font-semibold text-amber-900 underline underline-offset-2">
                Manage categories
                <i class="ri-arrow-right-line"></i>
            </a>
        </div>
    @endif

    <form id="blog-post-form" wire:submit="save" class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_340px]">

        <div class="space-y-6">
            {{-- Article details --}}
            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                    <h3 class="font-bold text-med-navy">Article details</h3>
                    <p class="mt-1 text-xs text-slate-500">The title, URL slug, and category for this post.</p>
                </div>

                <div class="space-y-5 p-5 sm:p-6">
                    <div>
                        <label for="post-title" class="text-sm font-semibold text-med-navy">
                            Title
                        </label>

                        <input
                            id="post-title"
                            type="text"
                            wire:model.live.debounce.300ms="title"
                            placeholder="e.g. 5 everyday habits for better heart health"
                            autocomplete="off"
                            class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                        @error('title')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="post-slug" class="text-sm font-semibold text-med-navy">
                                Slug
                            </label>

                            <div class="mt-2 flex items-stretch">
                                <span class="inline-flex items-center border border-r-0 border-slate-200 bg-slate-50 px-3 text-xs font-medium text-slate-400">
                                    /blog/
                                </span>

                                <input
                                    id="post-slug"
                                    type="text"
                                    wire:model.live.debounce.300ms="slug"
                                    placeholder="better-heart-health"
                                    autocomplete="off"
                                    class="h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                            </div>

                            @error('slug')
                                <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="post-category" class="text-sm font-semibold text-med-navy">
                                Category
                            </label>

                            <select
                                id="post-category"
                                wire:model="categoryId"
                                class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-med-blue focus:ring-2 focus:ring-sky-100">
                                <option value="">Select a category</option>

                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->title }}{{ $category->is_active ? '' : ' (inactive)' }}
                                    </option>
                                @endforeach
                            </select>

                            @error('categoryId')
                                <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </section>

            {{-- Content --}}
            <section class="border border-slate-200 bg-white">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div>
                        <h3 class="font-bold text-med-navy">Article content</h3>
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
                            id="post-content"
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
                        <label for="post-meta-title" class="text-sm font-semibold text-med-navy">
                            Meta title
                        </label>

                        <input
                            id="post-meta-title"
                            type="text"
                            wire:model="metaTitle"
                            placeholder="Defaults to the article title"
                            autocomplete="off"
                            class="mt-2 h-11 w-full border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100">

                        @error('metaTitle')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-3">
                            <label for="post-meta-description" class="text-sm font-semibold text-med-navy">
                                Meta description
                            </label>

                            <span class="text-[11px] text-slate-400">
                                {{ strlen($metaDescription) }}/1000
                            </span>
                        </div>

                        <textarea
                            id="post-meta-description"
                            wire:model="metaDescription"
                            rows="4"
                            placeholder="A short summary for search results."
                            class="mt-2 w-full resize-y border border-slate-200 bg-white px-3 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-med-blue focus:ring-2 focus:ring-sky-100"></textarea>

                        @error('metaDescription')
                            <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="post-meta-keyword" class="text-sm font-semibold text-med-navy">
                            Meta keywords
                        </label>

                        <input
                            id="post-meta-keyword"
                            type="text"
                            wire:model="metaKeyword"
                            placeholder="e.g. heart health, blood pressure, healthy habits"
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
            {{-- Feature image --}}
            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-bold text-med-navy">Feature image</h3>
                    <p class="mt-1 text-xs text-slate-500">Shown on the blog listing and article header.</p>
                </div>

                <div class="p-5">
                    <label
                        for="post-feature-image"
                        class="group flex cursor-pointer flex-col items-center justify-center border-2 border-dashed border-slate-200 bg-slate-50 p-4 text-center transition hover:border-med-blue hover:bg-sky-50/60">

                        @if ($featureImage)
                            <img
                                src="{{ $featureImage->temporaryUrl() }}"
                                alt="Selected feature image preview"
                                class="aspect-[16/10] w-full border border-slate-200 bg-white object-cover">
                        @elseif ($currentFeatureImage)
                            <img
                                src="{{ str_starts_with($currentFeatureImage, 'http') ? $currentFeatureImage : asset($currentFeatureImage) }}"
                                alt="Current feature image preview"
                                class="aspect-[16/10] w-full border border-slate-200 bg-white object-cover">
                        @else
                            <span class="grid h-20 w-20 place-items-center bg-white text-2xl text-med-blue shadow-sm">
                                <i class="ri-image-add-line"></i>
                            </span>
                        @endif

                        <span class="mt-3 block text-sm font-semibold text-med-navy">
                            {{ $featureImage || $currentFeatureImage ? 'Choose a different image' : 'Upload a feature image' }}
                        </span>

                        <span class="mt-1 block text-xs leading-5 text-slate-400">
                            JPG, PNG, WEBP, GIF or BMP up to 5 MB
                        </span>

                        <input
                            id="post-feature-image"
                            type="file"
                            wire:model="featureImage"
                            accept="image/*"
                            class="sr-only">
                    </label>

                    <div wire:loading wire:target="featureImage" class="mt-3 flex items-center gap-2 text-xs font-medium text-med-blue">
                        <i class="ri-loader-4-line animate-spin"></i>
                        Uploading image...
                    </div>

                    @error('featureImage')
                        <p class="mt-2 text-xs font-medium text-med-red">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            {{-- Visibility --}}
            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-100 px-5 py-4">
                    <h3 class="font-bold text-med-navy">Visibility</h3>
                    <p class="mt-1 text-xs text-slate-500">Control whether this article is public.</p>
                </div>

                <div class="p-5">
                    <label class="flex cursor-pointer items-start gap-3 border border-slate-200 bg-slate-50/70 p-4">
                        <input
                            type="checkbox"
                            wire:model="isActive"
                            class="mt-0.5 h-4 w-4 border-slate-300 text-med-blue focus:ring-sky-200">

                        <span>
                            <span class="block text-sm font-semibold text-med-navy">Active article</span>
                            <span class="mt-0.5 block text-xs leading-5 text-slate-500">
                                Active articles are visible on the public blog when their category is active.
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
        const textarea = document.getElementById('post-content');

        if (!window.tinymce || !textarea) {
            return;
        }

        const existingEditor = window.tinymce.get('post-content');

        if (existingEditor) {
            existingEditor.remove();
        }

        window.tinymce.init({
            selector: '#post-content',
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

                    const textarea = document.getElementById('post-content');

                    if (textarea) {
                        textarea.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                });
            },
        });

        const form = document.getElementById('blog-post-form');

        form?.addEventListener('submit', () => {
            window.tinymce.triggerSave();
        }, true);

        document.addEventListener('livewire:navigating', () => {
            const editor = window.tinymce.get('post-content');

            if (editor) {
                editor.remove();
            }
        }, { once: true });
    })();
</script>
