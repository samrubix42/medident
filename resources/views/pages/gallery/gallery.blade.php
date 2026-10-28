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
    <section class="relative overflow-hidden bg-[#FAFDFE] py-14 sm:py-20 lg:py-24 border-b border-slate-100">
        <div class="pointer-events-none absolute -top-24 right-0 h-96 w-96 rounded-full bg-sky-100/50 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/4 h-80 w-80 rounded-full bg-teal-50/50 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <h1 class="text-3xl font-extrabold tracking-tight text-med-navy sm:text-5xl lg:text-6xl">
                    A closer look at <br class="hidden sm:inline" />
                    <span class="text-med-blue">care at MediDENT<span class="text-med-red">.</span></span>
                </h1>

                <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg">
                    Explore moments from our modern clinic, meet our doctors, and see the medical and dental care spaces that support your family's health and wellness.
                </p>

                <div class="mt-7 flex items-center gap-3 text-sm text-slate-500">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span>
                        <strong class="font-bold text-med-navy">{{ $this->categories->sum('images_count') }}</strong>
                        photos across <span class="font-semibold text-med-navy">{{ $this->categories->count() }} categories</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Grid & Filter --}}
    <section class="py-14 sm:py-20 lg:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between border-b border-slate-100 pb-8">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Visual Tour
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl lg:text-4xl">
                        Browse the gallery.
                    </h2>

                    <p class="mt-3 text-sm leading-relaxed text-slate-600 sm:text-base">
                        Filter by category to explore our state-of-the-art dental operatories, physician consultation suites, and friendly care team.
                    </p>
                </div>

                @if ($this->categories->isNotEmpty())
                    <div class="flex flex-wrap items-center gap-2" aria-label="Filter gallery by category">
                        <button
                            type="button"
                            wire:click="selectCategory('all')"
                            @class([
                                'inline-flex items-center gap-2 rounded-full px-4 py-2 sm:px-5 sm:py-2.5 text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm',
                                'bg-med-navy text-white shadow-md shadow-med-navy/15 ring-2 ring-med-navy' => $category === 'all',
                                'border border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue hover:bg-slate-50' => $category !== 'all',
                            ])>
                            <span>All</span>
                            <span @class([
                                'rounded-full px-2 py-0.5 text-[11px] font-bold',
                                'bg-white/20 text-white' => $category === 'all',
                                'bg-slate-100 text-slate-500' => $category !== 'all',
                            ])>{{ $this->categories->sum('images_count') }}</span>
                        </button>

                        @foreach ($this->categories as $galleryCategory)
                            <button
                                type="button"
                                wire:key="gallery-filter-{{ $galleryCategory->id }}"
                                wire:click="selectCategory('{{ $galleryCategory->slug }}')"
                                @class([
                                    'inline-flex items-center gap-2 rounded-full px-4 py-2 sm:px-5 sm:py-2.5 text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm',
                                    'bg-med-navy text-white shadow-md shadow-med-navy/15 ring-2 ring-med-navy' => $category === $galleryCategory->slug,
                                    'border border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue hover:bg-slate-50' => $category !== $galleryCategory->slug,
                                ])>
                                <span>{{ $galleryCategory->title }}</span>
                                <span @class([
                                    'rounded-full px-2 py-0.5 text-[11px] font-bold',
                                    'bg-white/20 text-white' => $category === $galleryCategory->slug,
                                    'bg-slate-100 text-slate-500' => $category !== $galleryCategory->slug,
                                ])>{{ $galleryCategory->images_count }}</span>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($this->images->isEmpty())
                <div class="mt-12 rounded-3xl border border-slate-100 bg-[#FAFDFE] px-6 py-16 text-center shadow-sm">
                    <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-3xl text-med-blue shadow-sm">
                        <i class="ri-image-line"></i>
                    </span>

                    <h3 class="mt-4 text-xl font-bold text-med-navy">No photos here yet.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-slate-500">
                        New gallery photos will be added soon. In the meantime, you can explore all available clinic photos.
                    </p>

                    <button type="button"
                            wire:click="selectCategory('all')"
                            class="mt-6 inline-flex items-center justify-center gap-2 rounded-full bg-med-navy px-6 py-3 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg">
                        <span>View all photos</span>
                        <i class="ri-arrow-right-line"></i>
                    </button>
                </div>
            @else
                <div class="mt-10 columns-1 gap-6 sm:columns-2 lg:columns-3">
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
                            class="group relative mb-6 block w-full break-inside-avoid overflow-hidden rounded-3xl border border-slate-100 bg-white text-left shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_25px_50px_rgba(18,50,74,0.14)]">

                            <img
                                src="{{ $image->imageUrl() }}"
                                alt="{{ $imageAlt }}"
                                loading="lazy"
                                decoding="async"
                                class="h-auto w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >

                            <span class="absolute inset-0 bg-gradient-to-t from-med-navy/90 via-med-navy/25 to-transparent opacity-80 transition-opacity duration-300 group-hover:opacity-95"></span>

                            <span class="absolute inset-x-0 bottom-0 p-5 sm:p-6">
                                @if ($image->category)
                                    <span class="block text-xs font-bold uppercase tracking-wider text-cyan-300 mb-1">
                                        {{ $image->category->title }}
                                    </span>
                                @endif

                                <span class="mt-1 flex items-end justify-between gap-3">
                                    <span class="text-base font-bold leading-tight text-white sm:text-lg">
                                        {{ $imageTitle }}
                                    </span>

                                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-white/20 text-white backdrop-blur-md transition-all duration-300 group-hover:bg-white group-hover:text-med-navy group-hover:scale-110 shadow-sm">
                                        <i class="ri-expand-diagonal-line text-sm"></i>
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
    <section class="bg-[#FAFDFE] py-14 sm:py-20 lg:py-24 border-t border-slate-100">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-med-navy px-7 py-10 sm:px-12 sm:py-14 shadow-xl">
                <div class="pointer-events-none absolute -right-20 -top-20 h-72 w-72 rounded-full bg-sky-500/10 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-20 left-10 h-72 w-72 rounded-full bg-teal-500/10 blur-3xl"></div>

                <div class="relative flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div class="max-w-2xl">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-300">
                            Ready to Experience Our Care?
                        </p>

                        <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-white sm:text-3xl lg:text-4xl">
                            Book your consultation at MediDENT<span class="text-cyan-400">.</span>
                        </h2>
                        <p class="mt-3 text-sm text-slate-300 sm:text-base leading-relaxed">
                            Visit our modern facilities, experience compassionate clinical care, and get a personalized treatment plan for you and your family.
                        </p>
                    </div>

                    <a href="{{ route('contact') }}"
                       class="inline-flex w-full shrink-0 items-center justify-center gap-2.5 rounded-full bg-med-red px-8 py-4 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-red-600 hover:shadow-lg active:translate-y-0 md:w-auto">
                        <span>Contact the Clinic</span>
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
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
            class="fixed inset-0 z-[100] flex items-center justify-center bg-med-navy/95 p-4 sm:p-8 backdrop-blur-sm">

            <button type="button"
                    @click="closeLightbox()"
                    aria-label="Close image preview"
                    class="absolute right-4 top-4 grid h-12 w-12 place-items-center rounded-full bg-white/10 text-xl text-white transition hover:bg-white/20 sm:right-6 sm:top-6">
                <i class="ri-close-line"></i>
            </button>

            <figure class="flex max-h-full max-w-6xl flex-col items-center">
                <img
                    :src="lightboxSrc"
                    :alt="lightboxAlt"
                    class="max-h-[78vh] w-auto max-w-full rounded-2xl border-4 border-white/20 object-contain shadow-2xl"
                >

                <figcaption class="mt-4 text-center text-sm font-semibold text-white" x-text="lightboxTitle"></figcaption>
                <p class="mt-1 text-center text-xs text-white/60">Click outside the image or press Esc to close.</p>
            </figure>
        </div>
    </template>
</div>

