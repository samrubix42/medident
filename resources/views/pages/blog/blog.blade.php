<div>
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-100 bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/3 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto max-w-7xl px-5 py-12 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="inline-flex max-w-full items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.14em] text-med-blue sm:text-xs sm:tracking-[0.16em]">
                <i class="ri-article-line shrink-0 text-base"></i>
                Health Journal
            </div>

            <h1 class="mt-5 max-w-3xl text-[2rem] font-bold leading-[1.15] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.5rem]">
                Clear health guidance from our
                <span class="text-med-blue">care team.</span>
            </h1>

            <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:mt-6 sm:text-base sm:leading-8">
                Practical articles on medical care, dental health, diabetes, and everyday wellbeing, written to help you make confident decisions about your health.
            </p>

            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('services') }}"
                   class="inline-flex w-full items-center justify-center gap-2 border border-slate-300 bg-white px-5 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue sm:w-auto sm:px-6">
                    Explore our services
                    <i class="ri-arrow-right-line"></i>
                </a>

                <button type="button"
                        @click="$dispatch('open-booking-modal')"
                        class="inline-flex w-full items-center justify-center gap-2 bg-med-blue px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800 sm:w-auto sm:px-6">
                    Book an Appointment
                    <i class="ri-arrow-right-up-line text-lg"></i>
                </button>
            </div>
        </div>
    </section>

    {{-- Articles --}}
    <section class="py-12 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Latest Articles
                    </p>

                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-med-navy sm:text-4xl">
                        Read, learn, and feel prepared.
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-slate-600 sm:text-base">
                        Browse by topic or read the latest guidance from our clinic.
                    </p>
                </div>

                @if ($this->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2" aria-label="Filter articles by category">
                        <button
                            type="button"
                            wire:click="selectCategory('all')"
                            @class([
                                'border px-4 py-2 text-sm font-semibold transition',
                                'border-med-blue bg-med-blue text-white' => $category === 'all',
                                'border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue' => $category !== 'all',
                            ])>
                            All Articles
                        </button>

                        @foreach ($this->categories as $blogCategory)
                            <button
                                type="button"
                                wire:key="blog-filter-{{ $blogCategory->id }}"
                                wire:click="selectCategory(@js($blogCategory->slug))"
                                @class([
                                    'border px-4 py-2 text-sm font-semibold transition',
                                    'border-med-blue bg-med-blue text-white' => $category === $blogCategory->slug,
                                    'border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue' => $category !== $blogCategory->slug,
                                ])>
                                {{ $blogCategory->title }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($this->posts->isEmpty())
                <div class="mt-8 border border-slate-200 bg-[#f8fbfd] px-6 py-14 text-center sm:mt-10">
                    <span class="mx-auto grid h-16 w-16 place-items-center bg-white text-3xl text-med-blue shadow-sm">
                        <i class="ri-article-line"></i>
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-med-navy">No articles here yet.</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        New health articles will be published soon. Try another topic or check back later.
                    </p>

                    @if ($category !== 'all')
                        <button type="button"
                                wire:click="selectCategory('all')"
                                class="mt-5 inline-flex items-center justify-center gap-2 bg-med-blue px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                            View all articles
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    @endif
                </div>
            @else
                <div class="mt-8 grid gap-6 sm:mt-10 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($this->posts as $post)
                        <article
                            wire:key="blog-post-{{ $post->id }}"
                            class="group flex h-full flex-col overflow-hidden border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-sky-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.09)]">

                            <a href="{{ route('blog.show', $post->slug) }}"
                               class="relative block aspect-[16/10] overflow-hidden bg-slate-100"
                               aria-label="Read {{ $post->title }}">

                                @if ($post->featureImageUrl())
                                    <img
                                        src="{{ $post->featureImageUrl() }}"
                                        alt="{{ $post->title }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >
                                @else
                                    <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-sky-50 via-white to-slate-100 text-5xl text-sky-200">
                                        <i class="ri-article-line"></i>
                                    </span>
                                @endif

                                @if ($post->category)
                                    <span class="absolute left-4 top-4 bg-white/95 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.14em] text-med-blue shadow-sm backdrop-blur">
                                        {{ $post->category->title }}
                                    </span>
                                @endif
                            </a>

                            <div class="flex flex-1 flex-col p-5 sm:p-6">
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-400">
                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="ri-calendar-line text-sm"></i>
                                        {{ $post->created_at?->format('M d, Y') }}
                                    </span>

                                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>

                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="ri-time-line text-sm"></i>
                                        {{ $post->readingTime() }} min read
                                    </span>
                                </div>

                                <h3 class="mt-3 text-lg font-bold leading-snug tracking-tight text-med-navy transition group-hover:text-med-blue sm:text-xl">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                @if ($post->excerpt() !== '')
                                    <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-500">
                                        {{ $post->excerpt() }}
                                    </p>
                                @endif

                                <a href="{{ route('blog.show', $post->slug) }}"
                                   class="mt-auto inline-flex items-center gap-2 pt-5 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                                    Read article
                                    <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($this->posts->hasPages())
                    <div class="mt-10 border-t border-slate-200 pt-6">
                        {{ $this->posts->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</div>
