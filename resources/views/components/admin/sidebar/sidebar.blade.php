<aside
    x-data="{ open: false }"
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

                <a href="{{ route('admin.reviews') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.reviews'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.reviews'),
                    ])>
                    <i @class([
                        'ri-star-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.reviews'),
                        'text-slate-400' => ! request()->routeIs('admin.reviews'),
                    ])></i>
                    Reviews
                </a>

                <a href="{{ route('admin.gallery-categories') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.gallery-categories'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.gallery-categories'),
                    ])>
                    <i @class([
                        'ri-gallery-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.gallery-categories'),
                        'text-slate-400' => ! request()->routeIs('admin.gallery-categories'),
                    ])></i>
                    Gallery categories
                </a>

                <a href="{{ route('admin.gallery-images') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.gallery-images'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.gallery-images'),
                    ])>
                    <i @class([
                        'ri-image-2-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.gallery-images'),
                        'text-slate-400' => ! request()->routeIs('admin.gallery-images'),
                    ])></i>
                    Gallery images
                </a>

                <a href="{{ route('admin.blog-categories') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.blog-categories'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.blog-categories'),
                    ])>
                    <i @class([
                        'ri-bookmark-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.blog-categories'),
                        'text-slate-400' => ! request()->routeIs('admin.blog-categories'),
                    ])></i>
                    Blog categories
                </a>

                <a href="{{ route('admin.blog-posts') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.blog-posts', 'admin.blog-posts.create', 'admin.blog-posts.edit'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.blog-posts', 'admin.blog-posts.create', 'admin.blog-posts.edit'),
                    ])>
                    <i @class([
                        'ri-article-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.blog-posts', 'admin.blog-posts.create', 'admin.blog-posts.edit'),
                        'text-slate-400' => ! request()->routeIs('admin.blog-posts', 'admin.blog-posts.create', 'admin.blog-posts.edit'),
                    ])></i>
                    Blog posts
                </a>

                <a href="{{ route('admin.service-categories') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.service-categories'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.service-categories'),
                    ])>
                    <i @class([
                        'ri-folders-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.service-categories'),
                        'text-slate-400' => ! request()->routeIs('admin.service-categories'),
                    ])></i>
                    Service categories
                </a>

                <a href="{{ route('admin.services') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.services', 'admin.services.create', 'admin.services.edit'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.services', 'admin.services.create', 'admin.services.edit'),
                    ])>
                    <i @class([
                        'ri-service-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.services', 'admin.services.create', 'admin.services.edit'),
                        'text-slate-400' => ! request()->routeIs('admin.services', 'admin.services.create', 'admin.services.edit'),
                    ])></i>
                    Services
                </a>

                <a href="{{ route('admin.settings') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2.5 text-sm transition',
                        'bg-sky-50 font-semibold text-med-blue' => request()->routeIs('admin.settings'),
                        'font-medium text-slate-500 hover:bg-slate-50 hover:text-med-navy' => ! request()->routeIs('admin.settings'),
                    ])>
                    <i @class([
                        'ri-settings-3-line text-lg',
                        'text-med-blue' => request()->routeIs('admin.settings'),
                        'text-slate-400' => ! request()->routeIs('admin.settings'),
                    ])></i>
                    Settings
                </a>

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
