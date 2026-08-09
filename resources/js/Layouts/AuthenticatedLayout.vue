<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-black">
        <!-- ── Sidebar ── -->
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 transform bg-gradient-to-b from-[#0a1628] to-[#1a2a4a] transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex h-full flex-col">
                <!-- Logo -->
                <div class="flex items-center border-b border-white/10 px-4 py-6">
                    <Link href="/" class="flex items-center gap-2">
                        <img src="/images/logo.png" class="h-12 w-auto pt-1" alt="SmashLab" />
                        <span class="text-[28px] font-bold text-white">SmashLab</span>
                    </Link>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 space-y-1 px-3 py-4 overflow-y-auto">
                    <p class="px-3 text-xs font-semibold uppercase tracking-wider text-gray-500">Main</p>
                    
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                        :class="isActive(item.href) ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white'"
                    >
                        <i :class="item.icon + ' w-5 text-center'"></i>
                        {{ item.name }}
                    </Link>

                    <div class="my-4 border-t border-white/10 -mx-3"></div>

                    <p class="px-3 text-xs font-semibold uppercase tracking-wider text-gray-500">Others</p>
                    
                    <Link
                        v-for="item in essentials"
                        :key="item.name"
                        :href="item.href"
                        class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-300 transition hover:bg-white/5 hover:text-white"
                    >
                        <i :class="item.icon + ' w-5 text-center'"></i>
                        {{ item.name }}
                    </Link>
                </nav>

                <!-- User Section with Logout -->
                <div class="border-t border-white/10 p-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white">
                            {{ user.name.charAt(0).toUpperCase() }}
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-white">{{ user.name }}</p>
                            <p class="text-xs text-gray-400">{{ user.email }}</p>
                        </div>
                    </div>
                    <!-- Logout Button -->
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="mt-3 flex w-full items-center justify-center gap-2 rounded-lg bg-white/10 px-3 py-2 text-sm font-medium text-white transition hover:bg-white/20"
                    >
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </Link>
                </div>
            </div>
        </aside>

        <!-- ── Main Content ── -->
        <div class="flex-1">
            <!-- Mobile Header -->
            <header class="border-b border-white/10 bg-white/5 backdrop-blur-sm lg:hidden">
                <div class="flex h-16 items-center justify-between px-4">
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="text-white transition hover:text-gray-300"
                    >
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <Link href="/" class="flex items-center gap-2">
                        <img src="/images/logo.png" class="h-8 w-auto" alt="SmashLab" />
                        <span class="text-lg font-bold text-white">SmashLab</span>
                    </Link>
                    <div class="w-8"></div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="min-h-screen bg-gray-100 dark:bg-black">
                <!-- Header -->
                <header v-if="$slots.header" class="border-b border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-6 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-3">
                            <slot name="header" />
                        </div>

                        <div class="flex items-center gap-3">
                            <!-- Notifications -->
                            <div class="relative">
                                <button
                                    type="button"
                                    @click="showNotifications = !showNotifications"
                                    class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-gray-700 transition hover:border-blue-400 hover:text-blue-600 dark:border-[#1a2a4a] dark:bg-[#0a1628] dark:text-[#4a7a9c] dark:hover:border-blue-400 dark:hover:text-blue-400"
                                    aria-label="Notifications"
                                >
                                    <i class="fa-solid fa-bell text-sm"></i>
                                </button>

                                <div v-if="showNotifications" class="absolute right-0 top-12 z-50 w-80 rounded-2xl border border-gray-200 bg-white p-3 shadow-xl dark:border-gray-700 dark:bg-gray-900">
                                    <div class="mb-2 flex items-center justify-between">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white">Notifications</p>
                                        <button
                                            type="button"
                                            @click="showNotifications = false"
                                            class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400"
                                        >
                                            Close
                                        </button>
                                    </div>

                                    <div class="space-y-2">
                                        <div
                                            v-for="notification in notifications"
                                            :key="notification.id"
                                            class="rounded-xl bg-gray-50 p-3 dark:bg-gray-800"
                                        >
                                            <div class="flex items-start justify-between gap-3">
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                                        {{ notification.title }}
                                                    </p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-300">
                                                        {{ notification.message }}
                                                    </p>
                                                </div>
                                                <span class="text-[10px] text-gray-500 dark:text-gray-400">
                                                    {{ notification.time }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dark Mode Toggle -->
                            <button
                                type="button"
                                @click="toggleDarkMode"
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-gray-700 transition hover:border-blue-400 hover:text-blue-600 dark:border-[#1a2a4a] dark:bg-[#0a1628] dark:text-[#4a7a9c] dark:hover:border-blue-400 dark:hover:text-blue-400"
                                aria-label="Toggle dark mode"
                            >
                                <i :class="darkMode ? 'fa-solid fa-sun' : 'fa-solid fa-moon'" class="text-sm"></i>
                            </button>

                            <!-- Profile -->
                            <Link
                                :href="route('profile.edit')"
                                class="flex items-center gap-3 rounded-full border border-gray-200 bg-white px-2 py-1.5 pr-4 transition hover:border-blue-500 hover:shadow-sm dark:border-gray-700 dark:bg-gray-800"
                            >
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white">
                                    {{ user.name.charAt(0).toUpperCase() }}
                                </div>
                                <div class="hidden text-left sm:block">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ user.name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-300">{{ user.email }}</p>
                                </div>
                            </Link>
                        </div>
                    </div>
                </header>

                <!-- Children -->
                <div class="py-8">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Mobile Overlay -->
        <div
            v-if="sidebarOpen"
            class="fixed inset-0 z-40 bg-black/50 lg:hidden"
            @click="sidebarOpen = false"
        ></div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const user = props.auth.user;

// ── State ──
const sidebarOpen = ref(false);
const showNotifications = ref(false);
const darkMode = ref(false);

// ── Navigation ──
const navigation = [
    { name: 'Dashboard', href: route('dashboard'), icon: 'fa-solid fa-chart-pie' },
    { name: 'Book Court', href: route('book.now'), icon: 'fa-solid fa-calendar-check' },
    { name: 'My Bookings', href: route('mybookings'), icon: 'fa-solid fa-bookmark' },
    { name: 'My Classes', href: route('myclasses'), icon: 'fa-solid fa-chalkboard-user' },
    { name: 'Shop', href: route('shop'), icon: 'fa-solid fa-store' },
    { name: 'Profile', href: route('profile.edit'), icon: 'fa-solid fa-user' },
];

const essentials = [
    { name: 'Homepage', href: '/', icon: 'fa-solid fa-house' },
    { name: 'Settings', href: route('settings'), icon: 'fa-solid fa-gear' },
    { name: 'Help & Support', href: route('help.support'), icon: 'fa-solid fa-circle-question' },
];

// ── Notifications ──
const notifications = [
    { id: 1, title: 'Booking confirmed', message: 'Court 3 is confirmed for today at 6:00 PM.', time: '2 min ago' },
    { id: 2, title: 'Class reminder', message: 'Your beginner class starts tomorrow at 6:00 PM.', time: '1 hour ago' },
];

// ── Methods ──
const isActive = (href) => {
    return route().current(href);
};

const toggleDarkMode = () => {
    const root = document.documentElement;
    const nextDarkMode = !darkMode.value;

    root.classList.toggle('dark', nextDarkMode);
    localStorage.setItem('smashlab-theme', nextDarkMode ? 'dark' : 'light');
    darkMode.value = nextDarkMode;
};

// ── Lifecycle ──
onMounted(() => {
    const root = document.documentElement;
    const storedTheme = localStorage.getItem('smashlab-theme');

    if (storedTheme) {
        const isDark = storedTheme === 'dark';
        root.classList.toggle('dark', isDark);
        darkMode.value = isDark;
    } else {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        root.classList.toggle('dark', prefersDark);
        darkMode.value = prefersDark;
    }
});
</script>