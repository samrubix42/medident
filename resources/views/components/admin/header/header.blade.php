@php
    $user = auth()->user();
    $initials = str($user?->name ?? 'Admin')
        ->explode(' ')
        ->map(fn ($part) => str($part)->substr(0, 1)->upper())
        ->take(2)
        ->implode('');

    $pageTitle = match (true) {
        request()->routeIs('admin.dashboard') => 'Dashboard',
        default => 'Admin',
    };
@endphp

<header x-data="{ userMenuOpen: false }" class="sticky top-0 z-30 border-b border-slate-200 bg-white">
    <div class="flex h-16 items-center gap-3 px-4 sm:px-6 lg:px-8">

        {{-- Mobile toggle --}}
        <button
            type="button"
            @click="$dispatch('admin-sidebar-toggle')"
            aria-label="Open sidebar"
            class="grid h-9 w-9 shrink-0 place-items-center text-xl text-med-navy transition hover:bg-slate-50 lg:hidden">
            <i class="ri-menu-3-line"></i>
        </button>

        {{-- Page title --}}
        <h1 class="min-w-0 truncate text-sm font-semibold text-med-navy sm:text-base">
            {{ $pageTitle }}
        </h1>

        <div class="ml-auto flex items-center gap-1 sm:gap-2">

            <a href="{{ route('home') }}"
                wire:navigate
                class="hidden items-center gap-1.5 px-3 py-2 text-xs font-medium text-slate-500 transition hover:bg-slate-50 hover:text-med-navy sm:inline-flex">
                <i class="ri-external-link-line"></i>
                Website
            </a>

            <span class="hidden h-5 w-px bg-slate-200 sm:block"></span>

            {{-- User menu --}}
            <div class="relative" @click.outside="userMenuOpen = false">
                <button
                    type="button"
                    @click="userMenuOpen = !userMenuOpen"
                    :aria-expanded="userMenuOpen"
                    class="flex items-center gap-2 px-1.5 py-1.5 transition hover:bg-slate-50">

                    <span class="grid h-8 w-8 shrink-0 place-items-center bg-slate-100 text-[11px] font-semibold text-med-navy">
                        {{ $initials }}
                    </span>

                    <span class="hidden max-w-32 truncate text-xs font-medium text-slate-600 md:block">
                        {{ $user?->name ?? 'Administrator' }}
                    </span>

                    <i class="ri-arrow-down-s-line hidden text-base text-slate-400 sm:block"
                        :class="{ 'rotate-180': userMenuOpen }"></i>
                </button>

                <div
                    x-cloak
                    x-show="userMenuOpen"
                    x-transition.origin.top.right
                    class="absolute right-0 top-full mt-2 w-56 border border-slate-200 bg-white shadow-lg">

                    <div class="border-b border-slate-100 px-4 py-3">
                        <p class="truncate text-sm font-semibold text-med-navy">
                            {{ $user?->name ?? 'Administrator' }}
                        </p>
                        <p class="mt-0.5 truncate text-xs text-slate-500">
                            {{ $user?->email ?? 'admin@medidentclinic.com' }}
                        </p>
                    </div>

                    <div class="p-1.5">
                        <button
                            type="button"
                            wire:click="logout"
                            wire:loading.attr="disabled"
                            wire:target="logout"
                            class="flex w-full items-center gap-2.5 px-3 py-2 text-left text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-red-600 data-loading:opacity-60">
                            <i class="ri-logout-box-r-line text-base"></i>
                            Sign out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
