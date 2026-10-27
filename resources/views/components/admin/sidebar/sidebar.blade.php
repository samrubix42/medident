@php
    $engagementActive = request()->routeIs('admin.reviews', 'admin.inquiries');
    $servicesActive = request()->routeIs('admin.services', 'admin.services.create', 'admin.services.edit', 'admin.service-categories');
    $blogActive = request()->routeIs('admin.blog-posts', 'admin.blog-posts.create', 'admin.blog-posts.edit', 'admin.blog-categories');
    $galleryActive = request()->routeIs('admin.gallery-images', 'admin.gallery-categories');
    $websiteActive = request()->routeIs('admin.page-seos', 'admin.page-seos.create', 'admin.page-seos.edit', 'admin.settings');
@endphp

<aside
    x-data="{
        open: false,
        engagementOpen: {{ $engagementActive ? 'true' : 'false' }},
        servicesOpen: {{ $servicesActive ? 'true' : 'false' }},
        blogOpen: {{ $blogActive ? 'true' : 'false' }},
        galleryOpen: {{ $galleryActive ? 'true' : 'false' }},
        websiteOpen: {{ $websiteActive ? 'true' : 'false' }},
    }"
    @admin-sidebar-toggle.window="open = !open"
    @keydown.escape.window="open = false">

    {{-- Mobile overlay --}}
    <div
        x-cloak
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-slate-900/40 lg:hidden"
        @click="open = false"></div>

    {{-- Sidebar --}}
    <div
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-slate-200 bg-white transition-transform duration-200"
        :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

        {{-- Brand --}}
        <div class="flex h-16 shrink-0 items-center justify-between gap-3 border-b border-slate-100 px-5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5" wire:navigate>
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="MediDENT Multicare Clinic"
                    class="h-9 w-auto object-contain">

                <span>
                    <span class="block text-sm font-bold leading-none tracking-tight text-med-navy">MediDENT</span>
                    <span class="mt-1 block text-[10px] font-medium uppercase tracking-[0.16em] text-slate-400">
                        Admin
                    </span>
                </span>
            </a>

            <button
                type="button"
                @click="open = false"
                aria-label="Close sidebar"
                class="grid h-8 w-8 place-items-center text-lg text-slate-400 transition hover:bg-slate-50 hover:text-med-navy lg:hidden">
                <i class="ri-close-line"></i>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-3 py-5" aria-label="Admin navigation">
            <p class="px-3 pb-2 text-[10px] font-medium uppercase tracking-[0.16em] text-slate-400">
                Menu
            </p>

            <div class="space-y-0.5">
                <a href="{{ route('admin.dashboard') }}"
                    wire:navigate
                    @click="open = false"
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.dashboard'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.dashboard'),
                    ])>
                    <i @class([
                        'ri-dashboard-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.dashboard'),
                        'text-slate-400' => ! request()->routeIs('admin.dashboard'),
                    ])></i>
                    Dashboard
                </a>

                {{-- Patient engagement --}}
                <div>
                    <button
                        type="button"
                        @click="engagementOpen = ! engagementOpen"
                        :aria-expanded="engagementOpen"
                        aria-controls="admin-engagement-menu"
                        @class([
                            'flex w-full items-center gap-3 px-3 py-2.5 text-sm transition',
                            'bg-sky-50 font-semibold text-med-blue' => $engagementActive,
                            'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! $engagementActive,
                        ])>
                        <i @class([
                            'ri-message-3-line text-lg',
                            'text-med-blue' => $engagementActive,
                            'text-slate-400' => ! $engagementActive,
                        ])></i>
                        <span class="flex-1 text-left">Patient Engagement</span>
                        <i class="ri-arrow-down-s-line text-base transition-transform"
                           :class="engagementOpen && 'rotate-180'"></i>
                    </button>

                    <div
                        id="admin-engagement-menu"
                        x-cloak
                        x-show="engagementOpen"
                        x-transition
                        class="mt-0.5 ml-4 space-y-0.5 border-l border-slate-200 pl-3">
                        <a href="{{ route('admin.reviews') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.reviews'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.reviews'),
                            ])>
                            <i class="ri-star-line text-base"></i>
                            Reviews
                        </a>

                        <a href="{{ route('admin.inquiries') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.inquiries'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.inquiries'),
                            ])>
                            <i class="ri-mail-line text-base"></i>
                            Inquiries
                        </a>
                    </div>
                </div>

                {{-- Services --}}
                <div>
                    <button
                        type="button"
                        @click="servicesOpen = ! servicesOpen"
                        :aria-expanded="servicesOpen"
                        aria-controls="admin-services-menu"
                        @class([
                            'flex w-full items-center gap-3 px-3 py-2.5 text-sm transition',
                            'bg-sky-50 font-semibold text-med-blue' => $servicesActive,
                            'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! $servicesActive,
                        ])>
                        <i @class([
                            'ri-service-line text-lg',
                            'text-med-blue' => $servicesActive,
                            'text-slate-400' => ! $servicesActive,
                        ])></i>
                        <span class="flex-1 text-left">Services</span>
                        <i class="ri-arrow-down-s-line text-base transition-transform"
                           :class="servicesOpen && 'rotate-180'"></i>
                    </button>

                    <div
                        id="admin-services-menu"
                        x-cloak
                        x-show="servicesOpen"
                        x-transition
                        class="mt-0.5 ml-4 space-y-0.5 border-l border-slate-200 pl-3">
                        <a href="{{ route('admin.services') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.services', 'admin.services.create', 'admin.services.edit'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.services', 'admin.services.create', 'admin.services.edit'),
                            ])>
                            <i class="ri-list-check text-base"></i>
                            All services
                        </a>

                        <a href="{{ route('admin.service-categories') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.service-categories'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.service-categories'),
                            ])>
                            <i class="ri-folders-line text-base"></i>
                            Categories
                        </a>
                    </div>
                </div>

                {{-- Blog --}}
                <div>
                    <button
                        type="button"
                        @click="blogOpen = ! blogOpen"
                        :aria-expanded="blogOpen"
                        aria-controls="admin-blog-menu"
                        @class([
                            'flex w-full items-center gap-3 px-3 py-2.5 text-sm transition',
                            'bg-sky-50 font-semibold text-med-blue' => $blogActive,
                            'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! $blogActive,
                        ])>
                        <i @class([
                            'ri-article-line text-lg',
                            'text-med-blue' => $blogActive,
                            'text-slate-400' => ! $blogActive,
                        ])></i>
                        <span class="flex-1 text-left">Blog</span>
                        <i class="ri-arrow-down-s-line text-base transition-transform"
                           :class="blogOpen && 'rotate-180'"></i>
                    </button>

                    <div
                        id="admin-blog-menu"
                        x-cloak
                        x-show="blogOpen"
                        x-transition
                        class="mt-0.5 ml-4 space-y-0.5 border-l border-slate-200 pl-3">
                        <a href="{{ route('admin.blog-posts') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.blog-posts', 'admin.blog-posts.create', 'admin.blog-posts.edit'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.blog-posts', 'admin.blog-posts.create', 'admin.blog-posts.edit'),
                            ])>
                            <i class="ri-file-text-line text-base"></i>
                            Posts
                        </a>

                        <a href="{{ route('admin.blog-categories') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.blog-categories'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.blog-categories'),
                            ])>
                            <i class="ri-bookmark-line text-base"></i>
                            Categories
                        </a>
                    </div>
                </div>

                {{-- Gallery --}}
                <div>
                    <button
                        type="button"
                        @click="galleryOpen = ! galleryOpen"
                        :aria-expanded="galleryOpen"
                        aria-controls="admin-gallery-menu"
                        @class([
                            'flex w-full items-center gap-3 px-3 py-2.5 text-sm transition',
                            'bg-sky-50 font-semibold text-med-blue' => $galleryActive,
                            'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! $galleryActive,
                        ])>
                        <i @class([
                            'ri-gallery-line text-lg',
                            'text-med-blue' => $galleryActive,
                            'text-slate-400' => ! $galleryActive,
                        ])></i>
                        <span class="flex-1 text-left">Gallery</span>
                        <i class="ri-arrow-down-s-line text-base transition-transform"
                           :class="galleryOpen && 'rotate-180'"></i>
                    </button>

                    <div
                        id="admin-gallery-menu"
                        x-cloak
                        x-show="galleryOpen"
                        x-transition
                        class="mt-0.5 ml-4 space-y-0.5 border-l border-slate-200 pl-3">
                        <a href="{{ route('admin.gallery-images') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.gallery-images'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.gallery-images'),
                            ])>
                            <i class="ri-image-2-line text-base"></i>
                            Images
                        </a>

                        <a href="{{ route('admin.gallery-categories') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.gallery-categories'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.gallery-categories'),
                            ])>
                            <i class="ri-folder-image-line text-base"></i>
                            Categories
                        </a>
                    </div>
                </div>

                {{-- Website --}}
                <div>
                    <button
                        type="button"
                        @click="websiteOpen = ! websiteOpen"
                        :aria-expanded="websiteOpen"
                        aria-controls="admin-website-menu"
                        @class([
                            'flex w-full items-center gap-3 px-3 py-2.5 text-sm transition',
                            'bg-sky-50 font-semibold text-med-blue' => $websiteActive,
                            'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! $websiteActive,
                        ])>
                        <i @class([
                            'ri-global-line text-lg',
                            'text-med-blue' => $websiteActive,
                            'text-slate-400' => ! $websiteActive,
                        ])></i>
                        <span class="flex-1 text-left">Website</span>
                        <i class="ri-arrow-down-s-line text-base transition-transform"
                           :class="websiteOpen && 'rotate-180'"></i>
                    </button>

                    <div
                        id="admin-website-menu"
                        x-cloak
                        x-show="websiteOpen"
                        x-transition
                        class="mt-0.5 ml-4 space-y-0.5 border-l border-slate-200 pl-3">
                        <a href="{{ route('admin.page-seos') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.page-seos', 'admin.page-seos.create', 'admin.page-seos.edit'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.page-seos', 'admin.page-seos.create', 'admin.page-seos.edit'),
                            ])>
                            <i class="ri-seo-line text-base"></i>
                            Page SEO
                        </a>

                        <a href="{{ route('admin.settings') }}"
                            wire:navigate
                            @click="open = false"
                            @class([
                                'flex items-center gap-2.5 px-3 py-2 text-sm transition',
                                'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.settings'),
                                'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.settings'),
                            ])>
                            <i class="ri-settings-3-line text-base"></i>
                            Settings
                        </a>
                    </div>
                </div>
            </div>

            <div class="my-5 h-px bg-slate-100"></div>

            <p class="px-3 pb-2 text-[10px] font-medium uppercase tracking-[0.16em] text-slate-400">
                Coming soon
            </p>

            <div class="space-y-0.5">
                <span class="flex cursor-default items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400">
                    <i class="ri-calendar-check-line text-lg"></i>
                    Appointments
                </span>

                <span class="flex cursor-default items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400">
                    <i class="ri-user-line text-lg"></i>
                    Patients
                </span>

                <span class="flex cursor-default items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400">
                    <i class="ri-team-line text-lg"></i>
                    Doctors
                </span>
            </div>

            <div class="my-5 h-px bg-slate-100"></div>

            <a href="{{ route('home') }}"
                wire:navigate
                class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-500 transition hover:bg-slate-50 hover:text-med-navy">
                <i class="ri-global-line text-lg text-slate-400"></i>
                View website
                <i class="ri-arrow-right-up-line ml-auto text-base text-slate-300"></i>
            </a>
        </nav>

        <div class="shrink-0 border-t border-slate-100 px-5 py-4">
            <p class="text-[11px] text-slate-400">
                &copy; {{ date('Y') }} MediDENT
            </p>
        </div>
    </div>
</aside>
