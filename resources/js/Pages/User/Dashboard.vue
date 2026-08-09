<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Dashboard</h2>
        </template>

        <Head title="Dashboard" />

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- ── Welcome Section ── -->
            <div class="mb-8 rounded-2xl bg-white shadow-sm p-6 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                            Welcome back, {{ user.name }}!
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            You have {{ upcomingBookings.length }} upcoming bookings and {{ activeClasses.length }} active classes.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <Link
                            :href="route('book.now')"
                            class="rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-700"
                        >
                            Book a Court
                        </Link>
                        <Link
                            :href="route('classes')"
                            class="rounded-full border border-gray-300 px-6 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            Join a Class
                        </Link>
                    </div>
                </div>
            </div>

            <!-- ── Quick Stats ── -->
            <div class="mb-8 grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ stats.bookings }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Total Bookings</p>
                </div>
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ stats.classes }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Classes Attended</p>
                </div>
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ stats.rating }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Avg. Rating</p>
                </div>
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ stats.members }}+</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Active Members</p>
                </div>
            </div>

            <!-- ── Two Column Layout ── -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                <!-- ── Upcoming Bookings ── -->
                <div class="rounded-2xl bg-white shadow-sm p-6 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Upcoming Bookings</h2>
                        <Link
                            :href="route('mybookings')"
                            class="text-sm text-blue-600 transition hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                        >
                            View All
                        </Link>
                    </div>

                    <div v-if="upcomingBookings.length > 0" class="space-y-3">
                        <div
                            v-for="booking in upcomingBookings"
                            :key="booking.id"
                            class="flex items-center justify-between rounded-xl bg-gray-50 p-4 transition hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
                        >
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">{{ booking.court }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ booking.date }} • {{ booking.time }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ booking.players }} players
                                </p>
                            </div>
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700 dark:bg-green-900 dark:text-green-300">
                                Confirmed
                            </span>
                        </div>
                    </div>
                    <p v-else class="text-center text-gray-500 dark:text-gray-400">No upcoming bookings.</p>
                </div>

                <!-- ── Active Classes ── -->
                <div class="rounded-2xl bg-white shadow-sm p-6 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Active Classes</h2>
                        <Link
                            :href="route('myclasses')"
                            class="text-sm text-blue-600 transition hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                        >
                            View All
                        </Link>
                    </div>

                    <div v-if="activeClasses.length > 0" class="space-y-3">
                        <div
                            v-for="cls in activeClasses"
                            :key="cls.id"
                            class="flex items-center justify-between rounded-xl bg-gray-50 p-4 transition hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600"
                        >
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">{{ cls.name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ cls.coach }} • {{ cls.schedule }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ cls.time }}
                                </p>
                            </div>
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                                Active
                            </span>
                        </div>
                    </div>
                    <p v-else class="text-center text-gray-500 dark:text-gray-400">No active classes.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const user = props.auth.user;

// Sample data (replace with real data from backend)
const stats = {
    bookings: 12,
    classes: 8,
    rating: 4.8,
    members: 500,
};

const upcomingBookings = [
    { id: 1, court: 'Court 3', date: 'Today', time: '6:00 PM - 8:00 PM', players: 2 },
    { id: 2, court: 'Court 1', date: 'Tomorrow', time: '10:00 AM - 12:00 PM', players: 4 },
    { id: 3, court: 'Court 5', date: 'June 30, 2026', time: '4:00 PM - 6:00 PM', players: 6 },
];

const activeClasses = [
    { id: 1, name: 'Beginner Class', coach: 'Coach Mike', schedule: 'Mon/Wed/Fri', time: '6:00 PM' },
    { id: 2, name: 'Advanced Class', coach: 'Coach Alex', schedule: 'Weekends', time: '6:00 PM' },
];
</script>