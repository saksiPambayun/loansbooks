<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 h-screen sticky top-0 flex flex-col">
    <!-- Mobile Header -->
    <div
        class="md:hidden flex items-center justify-between p-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 w-full fixed top-0 z-50">
        <div class="flex items-center">
            <a href="">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>
        <button @click="open = ! open"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Content -->
    <div :class="{'translate-x-0': open, '-translate-x-full': !open}"
        class="fixed inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out z-40 w-64 bg-white dark:bg-gray-800 flex flex-col h-full border-r border-gray-100 dark:border-gray-700 pt-16 md:pt-0">

        <!-- Logo (Desktop) -->
        <div class="hidden md:flex items-center px-6 py-6 border-b border-gray-100 dark:border-gray-700">
            <a href="" class="flex items-center space-x-3">
                <x-application-logo class="block h-10 w-auto fill-current text-indigo-600" />
                <span class="text-xl font-bold text-gray-800 dark:text-white">{{ config('app.name') }}</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto pt-4 space-y-1">
            <div class="px-6 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                Menu Utama
            </div>

            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        {{ __('Dashboard') }}
                    </div>
                </x-responsive-nav-link>

                <div class="px-6 mt-6 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Administrasi
                </div>

                <x-responsive-nav-link :href="route('admin.classrooms.index')"
                    :active="request()->routeIs('admin.classrooms.*')">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        {{ __('Manajemen Kelas') }}
                    </div>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.students.index')"
                    :active="request()->routeIs('admin.students.*')">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        {{ __('Manajemen Siswa') }}
                    </div>
                </x-responsive-nav-link>

                <div class="px-6 mt-6 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Perpustakaan
                </div>

                <x-responsive-nav-link :href="route('admin.books.index')" :active="request()->routeIs('books.*')">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        {{ __('Katalog Buku') }}
                    </div>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.loans.index')" :active="request()->routeIs('admin.loans.*')">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                        {{ __('Peminjaman') }}
                    </div>
                </x-responsive-nav-link>

            @elseif(Auth::user()->isStudent())
                <x-responsive-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        {{ __('Dashboard') }}
                    </div>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('student.books.index')" :active="request()->routeIs('student.books.*')">

                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        {{ __('Katalog Buku') }}
                    </div>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('student.loans.index')" :active="request()->routeIs('student.loans.*')">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('Pinjaman Saya') }}
                    </div>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- User Profile Dropdown / Info -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-700">
            <x-dropdown align="top" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center w-full px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                        <div class="flex-1 text-left truncate">
                            <div class="font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <!-- Overlay (Mobile) -->
    <div x-show="open" @click="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>
</nav>