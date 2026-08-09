<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">My Classes</h2>
        </template>

        <Head title="My Classes" />

        <!-- ── Toast Notification ── -->
        <div v-if="showToast" class="fixed top-4 right-4 z-50 animate-slide-in">
            <div class="rounded-2xl px-6 py-4 shadow-lg flex items-center gap-3" :class="{
                'bg-green-500 text-white': toastType === 'success',
                'bg-yellow-500 text-white': toastType === 'warning',
                'bg-blue-500 text-white': toastType === 'info'
            }">
                <i class="fa-solid text-xl" :class="{
                    'fa-check-circle': toastType === 'success',
                    'fa-clock': toastType === 'warning',
                    'fa-info-circle': toastType === 'info'
                }"></i>
                <span class="font-medium">{{ toastMessage }}</span>
                <button @click="showToast = false" class="ml-4 text-white/70 hover:text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- ── Header Section ── -->
            <div class="mb-8 rounded-2xl bg-white shadow-sm p-6 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Your Classes</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            You are enrolled in {{ classes.filter(c => c.status === 'active').length }} active classes.
                        </p>
                    </div>
                    <Link href="/classes" class="rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                        + Enroll in New Class
                    </Link>
                </div>
            </div>

            <!-- ── Filter Tabs ── -->
            <div class="mb-8 flex flex-wrap gap-2">
                <button v-for="filter in filters" :key="filter.status"
                    @click="filterStatus = filter.status"
                    class="px-4 py-2 rounded-full text-sm font-semibold transition"
                    :class="filterStatus === filter.status
                        ? 'bg-blue-600 text-white shadow-md'
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'"
                >
                    {{ filter.label }}
                    <span class="ml-2 px-2 py-0.5 rounded-full text-xs" :class="filterStatus === filter.status
                        ? 'bg-white/20 text-white'
                        : 'bg-gray-300 text-gray-700 dark:bg-gray-600 dark:text-gray-300'">
                        {{ getStatusCount(filter.status) }}
                    </span>
                </button>
            </div>

            <!-- ── Classes Grid ── -->
            <div v-if="filteredClasses.length > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div v-for="cls in filteredClasses" :key="cls.id"
                    class="rounded-2xl bg-white shadow-sm border border-gray-200 p-6 hover:shadow-md transition dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ cls.name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ cls.coach }}</p>
                        </div>
                        <span class="rounded-full px-3 py-1 text-xs font-medium" :class="getStatusBadge(cls.status)">
                            {{ getStatusText(cls.status) }}
                        </span>
                    </div>

                    <div class="mt-4 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <i class="fa-solid fa-calendar-day w-5 text-blue-500"></i> {{ cls.schedule }}
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <i class="fa-solid fa-clock w-5 text-blue-500"></i> {{ cls.time }}
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <i class="fa-solid fa-users w-5 text-blue-500"></i> {{ cls.enrolled }} / {{ cls.maxCapacity }} enrolled
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <i class="fa-solid fa-signal w-5 text-blue-500"></i>
                            <span class="rounded-full px-2 py-0.5 text-xs font-medium" :class="getLevelBadge(cls.level)">{{ cls.level }}</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div v-if="cls.status === 'active'" class="mt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-300">Progress</span>
                            <span class="font-medium text-gray-800 dark:text-white">{{ cls.progress }}%</span>
                        </div>
                        <div class="mt-1 h-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-2 rounded-full bg-blue-600 transition-all duration-500" :style="{ width: cls.progress + '%' }"></div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 flex flex-wrap gap-3">
                        <button @click="handleViewDetails(cls)" class="rounded-full bg-blue-600 px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                            View Details
                        </button>
                        <button @click="handleViewSchedule(cls)" class="rounded-full border border-gray-300 px-4 py-1.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-calendar mr-1"></i> View Schedule
                        </button>
                        <button v-if="cls.status === 'active' || cls.status === 'upcoming'" @click="handleDropClick(cls)" class="rounded-full border border-red-300 px-4 py-1.5 text-sm font-semibold text-red-600 transition hover:bg-red-50 dark:border-red-700 dark:text-red-400 dark:hover:bg-red-900/20">
                            <i class="fa-solid fa-xmark mr-1"></i> Drop Class
                        </button>
                        <Link v-if="cls.status === 'completed'" href="#" class="rounded-full border border-purple-300 px-4 py-1.5 text-sm font-semibold text-purple-600 transition hover:bg-purple-50 dark:border-purple-700 dark:text-purple-400 dark:hover:bg-purple-900/20">
                            <i class="fa-solid fa-certificate mr-1"></i> Certificate
                        </Link>
                    </div>
                </div>
            </div>

            <!-- ── Empty State ── -->
            <div v-else class="rounded-2xl bg-white shadow-sm p-12 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <i class="fa-solid fa-filter text-5xl text-gray-400 mb-4 block"></i>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">No {{ filterStatus !== 'all' ? filterStatus : '' }} Classes</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                    {{ filterStatus === 'all' ? "You haven't enrolled in any classes yet. Start your learning journey today!" : `You don't have any ${filterStatus} classes at the moment.` }}
                </p>
                <button v-if="filterStatus !== 'all'" @click="filterStatus = 'all'" class="inline-block mt-4 rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                    View All Classes
                </button>
                <Link v-else href="/classes" class="inline-block mt-4 rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Browse Classes
                </Link>
            </div>
        </div>

        <!-- ── Modals (Details, Schedule, Drop) ── -->
        <!-- View Details Modal -->
        <div v-if="showDetailsModal && selectedClass" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto border border-gray-200 dark:border-gray-700 animate-scale-in">
                <!-- Modal content... (same as React version but converted to Vue) -->
                <div class="sticky top-0 z-10 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Class Details</h3>
                    <button @click="closeDetailsModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>
                <div class="p-6">
                    <!-- ... (copy the rest from React version) -->
                </div>
            </div>
        </div>

        <!-- View Schedule Modal -->
        <div v-if="showScheduleModal && classForSchedule" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
            <!-- ... -->
        </div>

        <!-- Drop Class Modal -->
        <div v-if="showDropModal && classToDrop" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
            <!-- ... -->
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// ── State ──
const filterStatus = ref('all');

const filters = [
    { status: 'all', label: 'All' },
    { status: 'active', label: 'Active' },
    { status: 'upcoming', label: 'Upcoming' },
    { status: 'completed', label: 'Completed' },
];

const classes = ref([
    {
        id: 1,
        name: 'Beginner Class',
        coach: 'Coach Mike',
        schedule: 'Mon/Wed/Fri',
        time: '6:00 PM - 7:30 PM',
        level: 'Beginner',
        status: 'active',
        enrolled: 12,
        maxCapacity: 20,
        progress: 65,
        description: 'Learn the fundamentals of badminton in a fun and supportive environment. No experience needed.',
        price: '₱500',
        duration: '6 Weeks',
        sessions: '1hr per session',
        features: ['No experience needed', 'All equipment provided', 'Certified coach', 'Small class size (max 8)'],
        curriculum: ['Proper Grip & Stance', 'Basic Footwork', 'Serving Techniques', 'Forehand & Backhand', 'Rallying Drills', 'Game Rules & Matches'],
    },
    {
        id: 2,
        name: 'Advanced Class',
        coach: 'Coach Alex',
        schedule: 'Weekends',
        time: '6:00 PM - 8:00 PM',
        level: 'Advanced',
        status: 'active',
        enrolled: 8,
        maxCapacity: 15,
        progress: 40,
        description: 'Elite training for competitive players. Master high-level techniques, tactics, and match play.',
        price: '₱800',
        duration: '6 Weeks',
        sessions: '1hr per session',
        features: ['Tournament experience recommended', 'Elite coaching & tactics', 'Competitive match play', 'Small class size (max 4)'],
        curriculum: ['Power Smashes & Jump Smashes', 'Deceptive Net Play', 'Advanced Footwork & Speed', 'Opponent Analysis', 'Match Strategy & Mental Toughness', 'Tournament Preparation'],
    },
    {
        id: 3,
        name: 'Intermediate Class',
        coach: 'Coach Sarah',
        schedule: 'Tue/Thu',
        time: '5:00 PM - 6:30 PM',
        level: 'Intermediate',
        status: 'completed',
        enrolled: 14,
        maxCapacity: 18,
        progress: 100,
        description: 'Take your badminton skills to the next level. Build on your fundamentals and learn advanced techniques.',
        price: '₱600',
        duration: '6 Weeks',
        sessions: '1hr per session',
        features: ['Basic skills required', 'Advanced techniques', 'Match play & strategy', 'Small class size (max 6)'],
        curriculum: ['Advanced Footwork', 'Shot Variation', 'Deceptive Net Play', 'Defensive & Offensive Tactics', 'Match Strategy', 'Competitive Match Play'],
    },
]);

// ── Computed ──
const filteredClasses = computed(() => {
    if (filterStatus.value === 'all') return classes.value;
    return classes.value.filter(c => c.status === filterStatus.value);
});

const getStatusCount = (status) => {
    if (status === 'all') return classes.value.length;
    return classes.value.filter(c => c.status === status).length;
};

// ── Helper Functions ──
const getStatusBadge = (status) => {
    const map = {
        active: 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
        completed: 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
        upcoming: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
        cancelled: 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
    };
    return map[status] || map.upcoming;
};

const getStatusText = (status) => status.charAt(0).toUpperCase() + status.slice(1);

const getLevelBadge = (level) => {
    const map = {
        Beginner: 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
        Intermediate: 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
        Advanced: 'bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300',
        'All Levels': 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
    };
    return map[level] || map.Beginner;
};

// ── Modal Handlers ──
const selectedClass = ref(null);
const showDetailsModal = ref(false);
const showScheduleModal = ref(false);
const showDropModal = ref(false);
const classToDrop = ref(null);
const classForSchedule = ref(null);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');

const handleViewDetails = (cls) => {
    selectedClass.value = cls;
    showDetailsModal.value = true;
};

const closeDetailsModal = () => {
    showDetailsModal.value = false;
    selectedClass.value = null;
};

const handleViewSchedule = (cls) => {
    classForSchedule.value = cls;
    showScheduleModal.value = true;
};

const closeScheduleModal = () => {
    showScheduleModal.value = false;
    classForSchedule.value = null;
};

const handleDropClick = (cls) => {
    classToDrop.value = cls;
    showDropModal.value = true;
};

const closeDropModal = () => {
    showDropModal.value = false;
    classToDrop.value = null;
};

const handleDropClass = () => {
    classes.value = classes.value.filter(c => c.id !== classToDrop.value.id);
    toastMessage.value = `You have successfully dropped ${classToDrop.value.name}.`;
    toastType.value = 'info';
    showToast.value = true;
    showDropModal.value = false;
    classToDrop.value = null;
    setTimeout(() => { showToast.value = false; }, 3000);
};
</script>
 <style scoped>
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes scaleIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .animate-slide-in { animation: slideIn 0.3s ease-out; }
        .animate-scale-in { animation: scaleIn 0.2s ease-out; }
        </style>