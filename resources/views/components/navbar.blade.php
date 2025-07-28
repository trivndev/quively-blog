@php
    $signed_in = Auth::check();
@endphp
<nav class="sticky top-0 isolate z-40" x-data="{ open: false, toggle() { this.open = !this.open } }">
    <div class="bg-slate-50/70 backdrop-blur-md">
        <div class="relative mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <a href="/" class="flex items-center gap-2 text-xl font-bold text-black">
                            <x-application-logo class="size-10 fill-current text-gray-500" />
                            <span>{{ env('APP_NAME') }}</span>
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            @if ($signed_in)
                                <x-custom-nav-link class="block" href="/dashboard" :current="request()->is('dashboard') || request()->is('dashboard/*')">
                                    Dashboard
                                </x-custom-nav-link>
                            @endif
                            <x-custom-nav-link class="block" href="/blog" :current="request()->is('blog') || request()->is('/')">
                                Blog
                            </x-custom-nav-link>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="relative ml-3">
                            <div>
                                @if ($signed_in)
                                    <button type="button" @click="toggle()"
                                        class="focus:outline-hidden relative flex max-w-xs cursor-pointer items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        <img class="size-8 rounded-full" loading="lazy"
                                            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/default.png') }}"
                                            alt="{{ ucfirst(Auth::user()->name) }}'s avatar">
                                    </button>
                                    <div x-show="open" @click.outside="open = false"
                                        x-transition:enter="transition ease-out duration-100 transform"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75 transform"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="focus:outline-hidden absolute right-0 z-10 mt-2 max-w-64 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <div class="flex flex-col gap-0 border-b px-4 py-2">
                                            <p class="font-medium">{{ ucfirst(Auth::user()->name) }}</p>
                                            <p class="w-full truncate text-sm text-gray-500">{{ Auth::user()->email }}
                                            </p>
                                        </div>
                                        <div>
                                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700"
                                                role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                    class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                                    tabindex="-1" id="user-menu-item-1">Logout</a>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    @if (request()->is('login'))
                                        <a class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-200"
                                            href="{{ route('register') }}">Register</a>
                                    @elseif(request()->is('register'))
                                        <a class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-200"
                                            href="{{ route('login') }}">Login</a>
                                    @else
                                        <a class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-200"
                                            href="{{ route('login') }}">Login</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="-mr-2 flex md:hidden">
                    <button type="button" @click="toggle()" x-cloak
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-black transition duration-300 hover:bg-gray-300"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <svg :class="{ 'hidden': open, 'block': !open }" class="size-6" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg :class="{ 'block': open, 'hidden': !open }" class="size-6" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div x-cloak x-init="const handler = () => { open = false };
    window.addEventListener('scroll', handler);
    document.addEventListener('alpine:destroy', () => {
        window.removeEventListener('scroll', handler);
    });" x-show="open" @click.outside="open = false"
        x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
        class="absolute w-full rounded-b-3xl border-b-2 border-b-gray-300 bg-slate-50/70 backdrop-blur-md md:hidden"
        id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            @if ($signed_in)
                <x-custom-nav-link class="block" href="/dashboard" :current="request()->is('dashboard') || request()->is('dashboard/*')">
                    Dashboard
                </x-custom-nav-link>
            @endif
            <x-custom-nav-link class="block" href="/blog" :current="request()->is('blog') || request()->is('/')">
                Blog
            </x-custom-nav-link>
        </div>
        <div class="border-t border-gray-700/40 pb-3 pt-4">
            @if ($signed_in)
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img class="size-10 rounded-full" loading="lazy"
                            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/default.png') }}"
                            alt="{{ ucfirst(Auth::user()->name) }}'s avatar">
                    </div>
                    <div class="ml-3">
                        <div class="text-base/5 font-medium text-black">{{ ucfirst(Auth::user()->name) }}</div>
                        <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="/profile"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-200">Your
                        Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();this.closest('form').submit();"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-200">Logout</a>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 px-2">
                    <x-custom-nav-link class="block" href="/login" :current="request()->is('login')">
                        Login
                    </x-custom-nav-link>
                    <x-custom-nav-link class="block" href="/register" :current="request()->is('register')">
                        Signup
                    </x-custom-nav-link>
                </div>
            @endif
        </div>
</nav>
