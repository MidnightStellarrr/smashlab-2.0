<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Settings</h2>
        </template>

        <Head title="Settings" />

        <!-- ── Toast Notification ── -->
        <div v-if="showToast" class="fixed top-4 right-4 z-50 animate-slide-in">
            <div class="rounded-2xl px-6 py-4 shadow-lg flex items-center gap-3" :class="{
                'bg-green-500 text-white': toastType === 'success',
                'bg-red-500 text-white': toastType === 'error',
                'bg-blue-500 text-white': toastType === 'info'
            }">
                <i class="fa-solid fa-check-circle text-xl"></i>
                <span class="font-medium">{{ toastMessage }}</span>
                <button @click="showToast = false" class="ml-4 text-white/70 hover:text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" :class="settings.compactView ? 'space-y-4' : 'space-y-6'">
            <!-- ── Main Container ── -->
            <div class="rounded-2xl bg-white shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-hidden" :class="settings.compactView ? 'p-4' : ''">
                
                <!-- ── Header ── -->
                <div class="border-b border-gray-200 dark:border-gray-700" :class="settings.compactView ? 'p-4' : 'p-6'">
                    <div class="flex items-start gap-4">
                        <div class="flex flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30" :class="settings.compactView ? 'h-10 w-10' : 'h-12 w-12'">
                            <i class="fa-solid fa-gear text-blue-600 dark:text-blue-400" :class="settings.compactView ? 'text-xl' : 'text-2xl'"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-gray-800 dark:text-white" :class="settings.compactView ? 'text-xl' : 'text-2xl'">Settings</h1>
                            <p class="text-sm text-gray-600 dark:text-gray-300" :class="settings.compactView ? 'mt-0' : 'mt-1'">
                                Manage your account preferences, notifications, and privacy settings here.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ── Tabs ── -->
                <div class="flex overflow-x-auto border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50" :class="settings.compactView ? 'text-sm' : ''">
                    <button v-for="tab in tabs" :key="tab.id"
                        @click="activeTab = tab.id"
                        class="flex items-center gap-2 px-6 py-3 font-medium transition whitespace-nowrap"
                        :class="[
                            settings.compactView ? 'text-xs' : 'text-sm',
                            activeTab === tab.id
                                ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400'
                                : 'text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200'
                        ]"
                    >
                        <i :class="tab.icon"></i>
                        {{ tab.label }}
                    </button>
                </div>

                <!-- ── Tab Content ── -->
                <div :class="settings.compactView ? 'p-4' : 'p-6'">
                    <!-- Account Settings -->
                    <div v-if="activeTab === 'account'" class="space-y-4" :class="settings.compactView ? 'space-y-4' : 'space-y-6'">
                        <!-- ... Account settings content ... -->
                    </div>

                    <!-- Notification Settings -->
                    <div v-if="activeTab === 'notifications'" class="space-y-4" :class="settings.compactView ? 'space-y-4' : 'space-y-6'">
                        <!-- ... Notification settings content ... -->
                    </div>

                    <!-- Privacy Settings -->
                    <div v-if="activeTab === 'privacy'" class="space-y-4" :class="settings.compactView ? 'space-y-4' : 'space-y-6'">
                        <!-- ... Privacy settings content ... -->
                    </div>

                    <!-- Display Settings -->
                    <div v-if="activeTab === 'display'" class="space-y-4" :class="settings.compactView ? 'space-y-4' : 'space-y-6'">
                        <!-- ... Display settings content ... -->
                    </div>
                </div>
            </div>
        </div>

        <style scoped>
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .animate-slide-in { animation: slideIn 0.3s ease-out; }
        </style>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// ── State ──
const activeTab = ref('account');
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');

const tabs = [
    { id: 'account', label: 'Account', icon: 'fa-solid fa-user' },
    { id: 'notifications', label: 'Notifications', icon: 'fa-solid fa-bell' },
    { id: 'privacy', label: 'Privacy', icon: 'fa-solid fa-lock' },
    { id: 'display', label: 'Display', icon: 'fa-solid fa-display' },
];

// ── Settings State ──
const settings = reactive({
    language: 'english',
    timezone: 'asia_manila',
    emailNotifications: true,
    bookingReminders: true,
    classReminders: true,
    promotionalEmails: false,
    smsNotifications: true,
    profileVisibility: 'public',
    showEmail: false,
    showPhone: false,
    allowMessages: true,
    darkMode: false,
    compactView: false,
    fontSize: 'medium',
});

// ── Methods ──
const handleToggle = (key) => {
    settings[key] = !settings[key];
    
    if (key === 'darkMode') {
        if (settings.darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('smashlab-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('smashlab-theme', 'light');
        }
    }
};

const handleSelect = (key, value) => {
    settings[key] = value;
};

const handleSave = (section) => {
    toastMessage.value = `${section} settings saved successfully! ✅`;
    toastType.value = 'success';
    showToast.value = true;
    setTimeout(() => { showToast.value = false; }, 3000);
};

// ── Lifecycle ──
onMounted(() => {
    const storedTheme = localStorage.getItem('smashlab-theme');
    if (storedTheme === 'dark') {
        document.documentElement.classList.add('dark');
        settings.darkMode = true;
    } else {
        document.documentElement.classList.remove('dark');
        settings.darkMode = false;
    }
});
</script>