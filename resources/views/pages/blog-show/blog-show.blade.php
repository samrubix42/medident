@php
    $settings = $this->settings;
@endphp

<div>
    {{-- Article header --}}
    <section class="relative overflow-hidden border-b border-slate-100 bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/4 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto max-w-5xl px-5 py-10 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
            <nav class="flex flex-wrap items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                <i class="ri-arrow-right-s-line text-sm"></i>
                <a href="{{ route('blog') }}" class="transition hover:text-med-blue">Blog</a>

                @if ($post->category)
                    <i class="ri-arrow-right-s-line text-sm"></i>
                    <span class="text-slate-500">{{ $post->category->title }}</span>
                @endif
            </nav>

            @if ($post->category)
                <div class="mt-6 inline-flex items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-[10px] font-bold uppercase tracking-[0.14em] text-med-blue sm:text-xs sm:tracking-[0.16em]">
                    <i class="ri-bookmark-line text-base"></i>
                    {{ $post->category->title }}
                </div>
            @endif

            <h1 class="mt-5 max-w-4xl text-[2rem] font-bold leading-[1.15] tracking-tight text-med-navy sm:mt-6 sm:text-5xl lg:text-[3.25rem]">
                {{ $post->title }}
            </h1>

            @if ($post->excerpt() !== '')
                <p class="mt-5 max-w-3xl text-sm leading-7 text-slate-600 sm:mt-6 sm:text-base sm:leading-8">
                    {{ $post->excerpt() }}
                </p>
            @endif

            <div class="mt-7 flex flex-wrap items-center gap-x-5 gap-y-3 border-t border-slate-200 pt-5 text-xs text-slate-500 sm:text-sm">
                <span class="inline-flex items-center gap-2">
                    <span class="grid h-8 w-8 place-items-center bg-white text-med-blue shadow-sm">
                        <i class="ri-stethoscope-line text-base"></i>
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
        <div class="bg-[#f5fafc] pb-10 sm:pb-14">
            <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
                <img
                    src="{{ $post->featureImageUrl() }}"
                    alt="{{ $post->title }}"
                    fetchpriority="high"
                    class="aspect-[16/9] w-full border-[6px] border-white object-cover shadow-[0_20px_60px_rgba(18,50,74,0.12)]"
                >
            </div>
        </div>
    @endif

    {{-- Article body and sidebar --}}
    <section class="py-12 sm:py-16 lg:py-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[minmax(0,1fr)_320px] lg:gap-14 lg:px-8">

            <article class="min-w-0">
                <div class="text-[15px] leading-8 text-slate-600
                    [&_h2]:mb-3 [&_h2]:mt-9 [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:leading-tight [&_h2]:tracking-tight [&_h2]:text-med-navy
                    [&_h3]:mb-2 [&_h3]:mt-7 [&_h3]:text-xl [&_h3]:font-bold [&_h3]:text-med-navy
                    [&_p]:mb-5
                    [&_ul]:mb-5 [&_ul]:list-disc [&_ul]:space-y-2 [&_ul]:pl-5
                    [&_ol]:mb-5 [&_ol]:list-decimal [&_ol]:space-y-2 [&_ol]:pl-5
                    [&_li]:pl-1
                    [&_a]:font-semibold [&_a]:text-med-blue [&_a]:underline [&_a]:underline-offset-2 hover:[&_a]:text-sky-800
                    [&_strong]:font-semibold [&_strong]:text-med-navy
                    [&_blockquote]:my-6 [&_blockquote]:border-l-4 [&_blockquote]:border-med-blue [&_blockquote]:bg-sky-50/60 [&_blockquote]:px-5 [&_blockquote]:py-4 [&_blockquote]:text-slate-600
                    [&_hr]:my-8 [&_hr]:border-slate-200
                    [&_h2:first-child]:mt-0">
                    {!! $post->content !!}
                </div>

                <div class="mt-10 flex flex-col gap-5 border border-sky-100 bg-sky-50/60 p-5 sm:flex-row sm:items-start sm:p-6">
                    <span class="grid h-11 w-11 shrink-0 place-items-center bg-white text-xl text-med-blue shadow-sm">
                        <i class="ri-information-line"></i>
                    </span>

                    <div>
                        <h2 class="text-base font-bold text-med-navy">This article is general information</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            It is not a substitute for a personal medical or dental consultation. If you have concerns about your health, please speak with our team or another qualified healthcare professional.
                        </p>
                    </div>
                </div>

                <div class="mt-8 border-t border-slate-200 pt-6">
                    <a href="{{ route('blog') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                        <i class="ri-arrow-left-line"></i>
                        Back to all articles
                    </a>
                </div>
            </article>

            <aside class="space-y-6">
                {{-- Clinic CTA --}}
                <div class="relative overflow-hidden bg-med-navy p-6 text-white">
                    <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full border-[20px] border-white/[0.05]"></div>

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-cyan-300">
                        MediDENT Clinic
                    </p>

                    <h2 class="mt-3 text-2xl font-bold leading-tight tracking-tight">
                        Have a health concern?
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        Our team can help you understand your symptoms and arrange the right consultation.
                    </p>

                    <button type="button"
                            @click="$dispatch('open-booking-modal')"
                            class="mt-5 inline-flex w-full items-center justify-center gap-2 bg-med-red px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700">
                        Book an Appointment
                        <i class="ri-arrow-right-up-line"></i>
                    </button>

                    @if ($settings->phone)
                        <a href="{{ $settings->phoneHref() }}"
                           class="mt-3 inline-flex w-full items-center justify-center gap-2 border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            <i class="ri-phone-line"></i>
                            {{ $settings->phone }}
                        </a>
                    @endif
                </div>

                {{-- Related articles --}}
                @if ($this->relatedPosts->isNotEmpty())
                    <div class="border border-slate-200 bg-white p-5 sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-base font-bold text-med-navy">Related articles</h2>
                            <i class="ri-article-line text-lg text-med-blue"></i>
                        </div>

                        <div class="mt-5 space-y-5">
                            @foreach ($this->relatedPosts as $relatedPost)
                                <a href="{{ route('blog.show', $relatedPost->slug) }}"
                                   wire:key="related-blog-post-{{ $relatedPost->id }}"
                                   class="group flex gap-3">

                                    <span class="h-16 w-20 shrink-0 overflow-hidden border border-slate-200 bg-slate-100">
                                        @if ($relatedPost->featureImageUrl())
                                            <img
                                                src="{{ $relatedPost->featureImageUrl() }}"
                                                alt="{{ $relatedPost->title }}"
                                                loading="lazy"
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                            >
                                        @else
                                            <span class="flex h-full w-full items-center justify-center text-2xl text-sky-200">
                                                <i class="ri-article-line"></i>
                                            </span>
                                        @endif
                                    </span>

                                    <span class="min-w-0">
                                        @if ($relatedPost->category)
                                            <span class="block text-[10px] font-bold uppercase tracking-[0.12em] text-med-blue">
                                                {{ $relatedPost->category->title }}
                                            </span>
                                        @endif

                                        <span class="mt-1 line-clamp-2 block text-sm font-semibold leading-5 text-med-navy transition group-hover:text-med-blue">
                                            {{ $relatedPost->title }}
                                        </span>

                                        <span class="mt-1 block text-[11px] text-slate-400">
                                            {{ $relatedPost->created_at?->format('M d, Y') }}
                                        </span>
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        <a href="{{ route('blog') }}"
                           class="mt-5 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-xs font-semibold text-med-blue transition hover:text-sky-800">
                            View all articles
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                @endif
            </aside>
        </div>
    </section>
</div>
