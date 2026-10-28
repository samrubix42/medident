@php
    $settings = $this->settings;
@endphp

<div>
    {{-- Article header --}}
    <section class="relative overflow-hidden bg-[#FAFDFE] py-12 sm:py-16 lg:py-20 border-b border-slate-100">
        <div class="pointer-events-none absolute -top-24 right-0 h-96 w-96 rounded-full bg-sky-100/50 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/4 h-80 w-80 rounded-full bg-teal-50/50 blur-3xl"></div>

        <div class="relative mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap items-center gap-2 text-xs font-semibold text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition-colors hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                <a href="{{ route('blog') }}" class="transition-colors hover:text-med-blue">Health Journal</a>

                @if ($post->category)
                    <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                    <span class="text-med-navy">{{ $post->category->title }}</span>
                @endif
            </nav>

            @if ($post->category)
                <p class="mt-6 text-xs font-bold uppercase tracking-[0.2em] text-med-blue">
                    {{ $post->category->title }}
                </p>
            @endif

            <h1 class="mt-5 max-w-4xl text-3xl font-extrabold leading-[1.18] tracking-tight text-med-navy sm:text-5xl lg:text-[3.25rem]">
                {{ $post->title }}<span class="text-med-blue">.</span>
            </h1>

            @if ($post->excerpt() !== '')
                <p class="mt-5 max-w-3xl text-base leading-relaxed text-slate-600 sm:text-lg">
                    {{ $post->excerpt() }}
                </p>
            @endif

            <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 border-t border-slate-200/80 pt-6 text-xs sm:text-sm font-medium text-slate-500">
                <span class="inline-flex items-center gap-2 text-med-navy font-semibold">
                    <span class="grid h-8 w-8 place-items-center rounded-full bg-sky-50 text-med-blue shadow-sm">
                        <i class="ri-stethoscope-line text-sm"></i>
                    </span>
                    MediDENT Care Team
                </span>

                <span class="hidden h-4 w-px bg-slate-200 sm:block"></span>

                <span class="inline-flex items-center gap-1.5">
                    <i class="ri-calendar-line text-base text-med-blue"></i>
                    {{ $post->created_at?->format('F d, Y') }}
                </span>

                <span class="hidden h-4 w-px bg-slate-200 sm:block"></span>

                <span class="inline-flex items-center gap-1.5">
                    <i class="ri-time-line text-base text-med-blue"></i>
                    {{ $post->readingTime() }} min read
                </span>
            </div>
        </div>
    </section>

    @if ($post->featureImageUrl())
        <div class="bg-[#FAFDFE] pb-12 sm:pb-16 border-b border-slate-100">
            <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-3xl border-4 border-white shadow-[0_20px_60px_rgba(18,50,74,0.12)]">
                    <img
                        src="{{ $post->featureImageUrl() }}"
                        alt="{{ $post->title }}"
                        fetchpriority="high"
                        class="aspect-[16/9] w-full object-cover"
                    >
                </div>
            </div>
        </div>
    @endif

    {{-- Article body and sidebar --}}
    <section class="py-14 sm:py-20 lg:py-24 bg-white">
        <div class="mx-auto grid max-w-7xl gap-12 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_340px] lg:gap-14 lg:px-8">

            <article class="min-w-0">
                <div class="text-[15px] sm:text-base leading-8 text-slate-600
                    [&_h2]:mb-4 [&_h2]:mt-10 [&_h2]:text-2xl [&_h2]:font-extrabold [&_h2]:leading-tight [&_h2]:tracking-tight [&_h2]:text-med-navy sm:[&_h2]:text-3xl
                    [&_h3]:mb-3 [&_h3]:mt-8 [&_h3]:text-xl [&_h3]:font-bold [&_h3]:text-med-navy
                    [&_p]:mb-5
                    [&_ul]:mb-6 [&_ul]:list-disc [&_ul]:space-y-2 [&_ul]:pl-6
                    [&_ol]:mb-6 [&_ol]:list-decimal [&_ol]:space-y-2 [&_ol]:pl-6
                    [&_li]:pl-1
                    [&_a]:font-semibold [&_a]:text-med-blue [&_a]:underline [&_a]:underline-offset-2 hover:[&_a]:text-sky-800
                    [&_strong]:font-bold [&_strong]:text-med-navy
                    [&_blockquote]:my-8 [&_blockquote]:rounded-2xl [&_blockquote]:border-l-4 [&_blockquote]:border-med-blue [&_blockquote]:bg-sky-50/50 [&_blockquote]:p-6 [&_blockquote]:text-slate-700 [&_blockquote]:italic [&_blockquote]:shadow-sm
                    [&_hr]:my-10 [&_hr]:border-slate-100
                    [&_h2:first-child]:mt-0">
                    {!! $post->content !!}
                </div>

                {{-- Disclaimer --}}
                <div class="mt-12 flex flex-col gap-5 rounded-3xl border border-sky-100 bg-gradient-to-br from-sky-50/60 to-white p-6 sm:flex-row sm:items-start sm:p-7 shadow-sm">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-white text-xl text-med-blue shadow-sm">
                        <i class="ri-information-line"></i>
                    </span>

                    <div>
                        <h2 class="text-base font-bold text-med-navy">Clinical Information Notice</h2>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">
                            This article is provided for general health education and awareness. It is not a substitute for an in-person medical evaluation, diagnosis, or dental consultation. If you are experiencing symptoms, please contact MediDENT Multicare Clinic or your physician.
                        </p>
                    </div>
                </div>

                <div class="mt-10 border-t border-slate-100 pt-8">
                    <a href="{{ route('blog') }}"
                       class="inline-flex items-center gap-2.5 rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:bg-slate-50">
                        <i class="ri-arrow-left-line"></i>
                        <span>Back to all articles</span>
                    </a>
                </div>
            </article>

            <aside class="space-y-8">
                {{-- Clinic CTA --}}
                <div class="relative overflow-hidden rounded-3xl bg-med-navy p-7 text-white shadow-xl">
                    <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-sky-500/10 blur-2xl"></div>

                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-300">
                        MediDENT Clinic
                    </p>

                    <h2 class="mt-3 text-2xl font-extrabold leading-snug tracking-tight">
                        Have a health concern<span class="text-cyan-400">?</span>
                    </h2>

                    <p class="mt-3 text-sm leading-relaxed text-slate-300">
                        Our medical and dental teams can evaluate your symptoms and recommend an individualized treatment plan.
                    </p>

                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full bg-med-red px-6 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-red-600 hover:shadow-lg active:translate-y-0">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line text-xs"></i>
                    </button>

                    @if ($settings->phone)
                        <a href="{{ $settings->phoneHref() }}"
                           class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition-all duration-200 hover:bg-white/10">
                            <i class="ri-phone-line"></i>
                            <span>{{ $settings->phone }}</span>
                        </a>
                    @endif
                </div>

                {{-- Related articles --}}
                @if ($this->relatedPosts->isNotEmpty())
                    <div class="rounded-3xl border border-slate-100 bg-white p-6 sm:p-7 shadow-sm">
                        <div class="flex items-center justify-between gap-3 border-b border-slate-100 pb-4">
                            <h2 class="text-base font-bold text-med-navy">Related Articles</h2>
                            <i class="ri-article-line text-lg text-med-blue"></i>
                        </div>

                        <div class="mt-5 space-y-5">
                            @foreach ($this->relatedPosts as $relatedPost)
                                <a href="{{ route('blog.show', $relatedPost->slug) }}"
                                   wire:key="related-blog-post-{{ $relatedPost->id }}"
                                   class="group flex gap-4">

                                    <span class="h-16 w-20 shrink-0 overflow-hidden rounded-2xl border border-slate-100 bg-slate-100">
                                        @if ($relatedPost->featureImageUrl())
                                            <img
                                                src="{{ $relatedPost->featureImageUrl() }}"
                                                alt="{{ $relatedPost->title }}"
                                                loading="lazy"
                                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                            >
                                        @else
                                            <span class="flex h-full w-full items-center justify-center text-2xl text-sky-200">
                                                <i class="ri-article-line"></i>
                                            </span>
                                        @endif
                                    </span>

                                    <span class="min-w-0">
                                        @if ($relatedPost->category)
                                            <span class="block text-[10px] font-bold uppercase tracking-wider text-med-blue">
                                                {{ $relatedPost->category->title }}
                                            </span>
                                        @endif

                                        <span class="mt-1 line-clamp-2 block text-sm font-semibold leading-snug text-med-navy transition-colors duration-200 group-hover:text-med-blue">
                                            {{ $relatedPost->title }}
                                        </span>

                                        <span class="mt-1 block text-xs text-slate-400">
                                            {{ $relatedPost->created_at?->format('M d, Y') }}
                                        </span>
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6 border-t border-slate-100 pt-4">
                            <a href="{{ route('blog') }}"
                               class="inline-flex items-center gap-2 text-xs font-bold text-med-blue transition-colors duration-200 hover:text-sky-800">
                                <span>View all articles</span>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </section>
</div>
