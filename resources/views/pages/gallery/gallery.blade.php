<div
    x-data="{
        lightboxOpen: false,
        lightboxSrc: '',
        lightboxAlt: '',
        lightboxTitle: '',
        openLightbox(event) {
            const image = event.currentTarget;

            this.lightboxSrc = image.dataset.src;
            this.lightboxAlt = image.dataset.alt;
            this.lightboxTitle = image.dataset.title;
            this.lightboxOpen = true;
        },
        closeLightbox() {
            this.lightboxOpen = false;
        }
    }"
    x-effect="document.body.classList.toggle('overflow-hidden', lightboxOpen)"
    @keydown.escape.window="closeLightbox()">

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-100 bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/3 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto max-w-7xl px-5 py-12 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="inline-flex max-w-full items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.14em] text-med-blue sm:text-xs sm:tracking-[0.16em]">
                <i class="ri-gallery-line shrink-0 text-base"></i>
                Gallery
            </div>

            <h1 class="mt-5 max-w-3xl text-[2rem] font-bold leading-[1.15] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.5rem]">
                A closer look at
                <span class="text-med-blue">care at MediDENT.</span>
            </h1>

            <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:mt-6 sm:text-base sm:leading-8">
                Explore moments from our clinic, meet our doctors, and see the medical and dental care spaces that support your family's health.
            </p>

            <div class="mt-7 inline-flex items-center gap-3 border border-slate-200 bg-white px-4 py-3 text-sm text-slate-600">
                <span class="grid h-9 w-9 place-items-center bg-sky-50 text-lg text-med-blue">
                    <i class="ri-image-2-line"></i>
                </span>

                <span>
                    <strong class="font-bold text-med-navy">{{ $this->categories->sum('images_count') }}</strong>
                    photos across {{ $this->categories->count() }} categories
                </span>
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    <section class="py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Our Moments
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        Browse the gallery.
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                        Filter by category to see our clinic, doctors, physician care, and dental services.
                    </p>
                </div>

                @if ($this->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2" aria-label="Filter gallery by category">
                        <button
                            type="button"
                            wire:click="selectCategory('all')"
                            @class([
                                'inline-flex items-center gap-2 border px-4 py-2 text-sm font-semibold transition',
                                'border-med-blue bg-med-blue text-white' => $category === 'all',
                                'border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue' => $category !== 'all',
                            ])>
                            All
                            <span @class([
                                'text-xs',
                                'text-white/70' => $category === 'all',
                                'text-slate-400' => $category !== 'all',
                            ])>{{ $this->categories->sum('images_count') }}</span>
                        </button>

                        @foreach ($this->categories as $galleryCategory)
                            <button
                                type="button"
                                wire:key="gallery-filter-{{ $galleryCategory->id }}"
                                wire:click="selectCategory('{{ $galleryCategory->slug }}')"
                                @class([
                                    'inline-flex items-center gap-2 border px-4 py-2 text-sm font-semibold transition',
                                    'border-med-blue bg-med-blue text-white' => $category === $galleryCategory->slug,
                                    'border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue' => $category !== $galleryCategory->slug,
                                ])>
                                {{ $galleryCategory->title }}
                                <span @class([
                                    'text-xs',
                                    'text-white/70' => $category === $galleryCategory->slug,
                                    'text-slate-400' => $category !== $galleryCategory->slug,
                                ])>{{ $galleryCategory->images_count }}</span>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($this->images->isEmpty())
                <div class="mt-8 border border-slate-200 bg-[#f8fbfd] px-6 py-14 text-center sm:mt-10">
                    <span class="mx-auto grid h-16 w-16 place-items-center bg-white text-3xl text-med-blue shadow-sm">
                        <i class="ri-image-line"></i>
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-med-navy">No photos here yet.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        New gallery photos will be added soon. In the meantime, you can browse all our available photos.
                    </p>

                    <button type="button"
                            wire:click="selectCategory('all')"
                            class="mt-5 inline-flex items-center justify-center gap-2 bg-med-blue px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                        View all photos
                        <i class="ri-arrow-right-line"></i>
                    </button>
                </div>
            @else
                <div class="mt-8 columns-1 gap-5 sm:mt-10 sm:columns-2 lg:columns-3">
                    @foreach ($this->images as $image)
                        @php
                            $imageTitle = $image->category?->title ?? 'Gallery photo';
                            $imageAlt = $imageTitle.' at MediDENT Multicare Clinic';
                        @endphp

                        <button
                            type="button"
                            wire:key="gallery-image-{{ $image->id }}"
                            data-src="{{ $image->imageUrl() }}"
                            data-alt="{{ $imageAlt }}"
                            data-title="{{ $imageTitle }}"
                            @click="openLightbox($event)"
                            aria-label="View {{ $imageTitle }}"
                            class="group relative mb-5 block w-full break-inside-avoid overflow-hidden border border-slate-200 bg-white text-left transition duration-300 hover:border-sky-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.12)]">

                            <img
                                src="{{ $image->imageUrl() }}"
                                alt="{{ $imageAlt }}"
                                loading="lazy"
                                decoding="async"
                                class="h-auto w-full object-cover transition duration-500 group-hover:scale-105"
                            >

                            <span class="absolute inset-0 bg-gradient-to-t from-med-navy/90 via-med-navy/20 to-transparent opacity-80 transition group-hover:opacity-100"></span>

                            <span class="absolute inset-x-0 bottom-0 p-4 sm:p-5">
                                @if ($image->category)
                                    <span class="inline-flex bg-white/95 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.14em] text-med-blue">
                                        {{ $image->category->title }}
                                    </span>
                                @endif

                                <span class="mt-2 flex items-end justify-between gap-3">
                                    <span class="text-base font-bold leading-tight text-white sm:text-lg">
                                        {{ $imageTitle }}
                                    </span>

                                    <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-white/15 text-white backdrop-blur transition group-hover:bg-white group-hover:text-med-blue">
                                        <i class="ri-expand-diagonal-line"></i>
                                    </span>
                                </span>
                            </span>
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- CTA --}}
    <section class="border-t border-slate-100 bg-[#f5fafc] px-5 py-12 sm:px-6 sm:py-16 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 bg-med-navy px-6 py-8 sm:flex-row sm:items-center sm:justify-between sm:px-10">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-300">
                    Ready to visit?
                </p>

                <h2 class="mt-2 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                    Book your consultation at MediDENT.
                </h2>
            </div>

            <a href="{{ route('contact') }}"
               class="inline-flex w-full shrink-0 items-center justify-center gap-2 bg-med-red px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-red-700 sm:w-auto">
                Contact the Clinic
                <i class="ri-arrow-right-up-line"></i>
            </a>
        </div>
    </section>

    {{-- Lightbox --}}
    <template x-teleport="body">
        <div
            x-cloak
            x-show="lightboxOpen"
            x-transition.opacity.duration.200ms
            @click.self="closeLightbox()"
            role="dialog"
            aria-modal="true"
            aria-label="Gallery image preview"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-med-navy/95 p-4 sm:p-8">

            <button type="button"
                    @click="closeLightbox()"
                    aria-label="Close image preview"
                    class="absolute right-4 top-4 grid h-11 w-11 place-items-center border border-white/25 text-xl text-white transition hover:bg-white/10 sm:right-6 sm:top-6">
                <i class="ri-close-line"></i>
            </button>

            <figure class="flex max-h-full max-w-6xl flex-col items-center">
                <img
                    :src="lightboxSrc"
                    :alt="lightboxAlt"
                    class="max-h-[78vh] w-auto max-w-full border-[5px] border-white/10 object-contain shadow-2xl"
                >

                <figcaption class="mt-4 text-center text-sm font-semibold text-white" x-text="lightboxTitle"></figcaption>
                <p class="mt-1 text-center text-xs text-white/60">Click outside the image or press Esc to close.</p>
            </figure>
        </div>
    </template>
</div>
