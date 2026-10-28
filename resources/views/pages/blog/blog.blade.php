<div>
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-[#FAFDFE] py-14 sm:py-20 lg:py-24 border-b border-slate-100">
        <div class="pointer-events-none absolute -top-24 right-0 h-96 w-96 rounded-full bg-sky-100/50 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/4 h-80 w-80 rounded-full bg-teal-50/50 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 rounded-full border border-sky-100 bg-white px-3.5 py-1.5 text-xs font-semibold uppercase tracking-wider text-med-blue shadow-sm">
                    <i class="ri-article-line text-sm"></i>
                    <span>Health Journal</span>
                </div>

                <h1 class="mt-6 text-3xl font-extrabold tracking-tight text-med-navy sm:text-5xl lg:text-6xl">
                    Clear health guidance from our <br class="hidden sm:inline" />
                    <span class="text-med-blue">care team<span class="text-med-red">.</span></span>
                </h1>

                <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg">
                    Practical clinical articles on general medical care, preventive dentistry, diabetes management, and everyday wellness — written to help you make confident health decisions.
                </p>

                <div class="mt-8 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                    <a href="{{ route('services') }}"
                       class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:bg-slate-50 sm:w-auto">
                        <span>Explore our services</span>
                        <i class="ri-arrow-right-line text-xs"></i>
                    </a>

                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="inline-flex w-full items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0 sm:w-auto">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Articles --}}
    <section class="py-14 sm:py-20 lg:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between border-b border-slate-100 pb-8">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Clinical Insights
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl lg:text-4xl">
                        Read, learn, and feel prepared<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-3 text-sm leading-relaxed text-slate-600 sm:text-base">
                        Browse by clinical topic or read the latest guidance from our doctors and specialists.
                    </p>
                </div>

                @if ($this->categories->isNotEmpty())
                    <div class="flex flex-wrap items-center gap-2" aria-label="Filter articles by category">
                        <button
                            type="button"
                            wire:click="selectCategory('all')"
                            @class([
                                'inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm',
                                'bg-med-navy text-white shadow-md shadow-med-navy/15 ring-2 ring-med-navy' => $category === 'all',
                                'border border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue hover:bg-slate-50' => $category !== 'all',
                            ])>
                            <span>All Articles</span>
                        </button>

                        @foreach ($this->categories as $blogCategory)
                            <button
                                type="button"
                                wire:key="blog-filter-{{ $blogCategory->id }}"
                                wire:click="selectCategory(@js($blogCategory->slug))"
                                @class([
                                    'inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm',
                                    'bg-med-navy text-white shadow-md shadow-med-navy/15 ring-2 ring-med-navy' => $category === $blogCategory->slug,
                                    'border border-slate-200 bg-white text-slate-600 hover:border-med-blue hover:text-med-blue hover:bg-slate-50' => $category !== $blogCategory->slug,
                                ])>
                                <span>{{ $blogCategory->title }}</span>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($this->posts->isEmpty())
                <div class="mt-12 rounded-3xl border border-slate-100 bg-[#FAFDFE] px-6 py-16 text-center shadow-sm">
                    <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-3xl text-med-blue shadow-sm">
                        <i class="ri-article-line"></i>
                    </span>

                    <h3 class="mt-4 text-xl font-bold text-med-navy">No articles here yet</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-slate-500">
                        New health articles will be published soon. Try exploring another topic or check back later.
                    </p>

                    @if ($category !== 'all')
                        <button type="button"
                                wire:click="selectCategory('all')"
                                class="mt-6 inline-flex items-center justify-center gap-2 rounded-full bg-med-navy px-6 py-3 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg">
                            <span>View all articles</span>
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    @endif
                </div>
            @else
                <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($this->posts as $post)
                        <article
                            wire:key="blog-post-{{ $post->id }}"
                            class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">

                            <a href="{{ route('blog.show', $post->slug) }}"
                               class="relative block aspect-[16/10] overflow-hidden bg-slate-100"
                               aria-label="Read {{ $post->title }}">

                                @if ($post->featureImageUrl())
                                    <img
                                        src="{{ $post->featureImageUrl() }}"
                                        alt="{{ $post->title }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    >
                                @else
                                    <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-sky-50 via-white to-slate-100 text-5xl text-sky-200">
                                        <i class="ri-article-line"></i>
                                    </span>
                                @endif

                                @if ($post->category)
                                    <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-med-blue shadow-sm backdrop-blur-md">
                                        {{ $post->category->title }}
                                    </span>
                                @endif
                            </a>

                            <div class="flex flex-1 flex-col p-6 sm:p-7">
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs font-medium text-slate-400">
                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="ri-calendar-line text-sm text-med-blue"></i>
                                        {{ $post->created_at?->format('M d, Y') }}
                                    </span>

                                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>

                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="ri-time-line text-sm text-med-blue"></i>
                                        {{ $post->readingTime() }} min read
                                    </span>
                                </div>

                                <h3 class="mt-3.5 text-lg font-bold leading-snug tracking-tight text-med-navy transition-colors duration-200 group-hover:text-med-blue sm:text-xl">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                @if ($post->excerpt() !== '')
                                    <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-500">
                                        {{ $post->excerpt() }}
                                    </p>
                                @endif

                                <div class="mt-auto pt-6 border-t border-slate-100">
                                    <a href="{{ route('blog.show', $post->slug) }}"
                                       class="inline-flex items-center gap-2 text-sm font-bold text-med-navy transition-colors duration-200 group-hover:text-med-blue">
                                        <span>Read article</span>
                                        <i class="ri-arrow-right-line text-med-blue transition-transform duration-200 group-hover:translate-x-1"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($this->posts->hasPages())
                    <div class="mt-12 border-t border-slate-100 pt-8">
                        {{ $this->posts->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
</div>
