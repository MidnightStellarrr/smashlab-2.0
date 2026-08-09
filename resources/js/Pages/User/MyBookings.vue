<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">My Bookings</h2>
        </template>

        <Head title="My Bookings" />

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
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Your Bookings</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            You have {{ bookings.filter(b => b.status === 'confirmed').length }} confirmed,
                            {{ bookings.filter(b => b.status === 'pending').length }} pending bookings.
                        </p>
                    </div>
                    <Link href="/book_now" class="rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                        + Book New Court
                    </Link>
                </div>
            </div>

            <!-- ── Stats Summary ── -->
            <div class="mb-8 grid grid-cols-2 gap-4 sm:grid-cols-5">
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ bookings.filter(b => b.status === 'confirmed').length }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Confirmed</p>
                </div>
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ bookings.filter(b => b.status === 'pending').length }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Pending</p>
                </div>
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ bookings.filter(b => b.status === 'completed').length }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Completed</p>
                </div>
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ bookings.filter(b => b.status === 'cancelled').length }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Cancelled</p>
                </div>
                <div class="rounded-2xl bg-white shadow-sm p-6 text-center border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ bookings.filter(b => b.status === 'expired').length }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Expired</p>
                </div>
            </div>

            <!-- ── Bookings List ── -->
            <div class="rounded-2xl bg-white shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Court</th>
                                <th class="px-6 py-4 text-left font-semibold">Date</th>
                                <th class="px-6 py-4 text-left font-semibold">Time</th>
                                <th class="px-6 py-4 text-left font-semibold">Players</th>
                                <th class="px-6 py-4 text-left font-semibold">Price</th>
                                <th class="px-6 py-4 text-center font-semibold">Status</th>
                                <th class="px-6 py-4 text-left font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr v-if="bookings.length > 0" v-for="booking in bookings" :key="booking.id" class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 text-gray-800 dark:text-white font-medium">
                                    {{ booking.court }}
                                    <span v-if="isAboutToExpire(booking)" class="ml-2 inline-block animate-pulse text-xs text-yellow-600 dark:text-yellow-400">
                                        ⏳ Expiring soon
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ formatDate(booking.date) }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ booking.time }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ booking.players }} {{ booking.players === 1 ? 'player' : 'players' }}</td>
                                <td class="px-6 py-4 text-gray-800 dark:text-white font-medium">{{ booking.price }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="rounded-full px-3 py-1 text-xs font-medium inline-block" :class="getStatusBadge(booking.status)">
                                            {{ getStatusText(booking.status) }}
                                        </span>
                                        <span v-if="booking.status === 'pending' && booking.expiresAt" class="text-[10px] text-gray-500 dark:text-gray-400">
                                            {{ getTimeRemaining(booking.expiresAt) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="handleViewDetails(booking)" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <i class="fa-solid fa-calendar-xmark text-4xl mb-3 block"></i>
                                    No bookings found. Start booking your first court!
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ── View Details Modal ── -->
        <div v-if="showDetailsModal && selectedBooking" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md p-6 border border-gray-200 dark:border-gray-700 animate-scale-in max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Booking Details</h3>
                    <button @click="closeDetailsModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-600 dark:text-gray-400">Court</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ selectedBooking.court }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-600 dark:text-gray-400">Date</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ formatDateLong(selectedBooking.date) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-600 dark:text-gray-400">Time</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ selectedBooking.time }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-600 dark:text-gray-400">Players</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ selectedBooking.players }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-600 dark:text-gray-400">Price</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ selectedBooking.price }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-600 dark:text-gray-400">Status</span>
                        <span class="rounded-full px-3 py-1 text-xs font-medium" :class="getStatusBadge(selectedBooking.status)">
                            {{ getStatusText(selectedBooking.status) }}
                        </span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-600 dark:text-gray-400">Booking Reference</span>
                        <span class="font-mono text-sm font-medium text-gray-800 dark:text-white">{{ selectedBooking.bookingRef || 'N/A' }}</span>
                    </div>
                    <div v-if="selectedBooking.status === 'pending' && selectedBooking.expiresAt" class="flex justify-between py-2">
                        <span class="text-gray-600 dark:text-gray-400">Time Remaining</span>
                        <span class="font-medium text-yellow-600 dark:text-yellow-400">{{ getTimeRemaining(selectedBooking.expiresAt) }}</span>
                    </div>
                    <div v-if="selectedBooking.notes" class="flex justify-between py-2">
                        <span class="text-gray-600 dark:text-gray-400">Notes</span>
                        <span class="font-medium text-gray-800 dark:text-white">{{ selectedBooking.notes }}</span>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <button @click="closeDetailsModal" class="flex-1 rounded-full bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                        Close
                    </button>
                    <button v-if="selectedBooking.status === 'pending'" @click="handleConfirmClick(selectedBooking)" class="flex-1 rounded-full bg-green-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-700">
                        <i class="fa-solid fa-check mr-2"></i> Confirm Booking
                    </button>
                    <button v-if="selectedBooking.status === 'confirmed' && canCancelBooking(selectedBooking)" @click="handleCancelClick(selectedBooking)" class="flex-1 rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">
                        <i class="fa-solid fa-xmark mr-2"></i> Cancel Booking
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Confirm Booking Modal ── -->
        <div v-if="showConfirmModal && bookingToConfirm" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md p-6 border border-gray-200 dark:border-gray-700 animate-scale-in">
                <div class="text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/30 mb-4">
                        <i class="fa-solid fa-triangle-exclamation text-2xl text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Confirm Booking</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        Are you sure you want to confirm your booking for <span class="font-semibold">{{ bookingToConfirm.court }}</span> on {{ formatDateLong(bookingToConfirm.date) }}?
                    </p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Total: {{ bookingToConfirm.price }}</p>
                    <p v-if="bookingToConfirm.expiresAt" class="mt-2 text-xs text-yellow-600 dark:text-yellow-400">
                        ⏳ This booking will expire in {{ getTimeRemaining(bookingToConfirm.expiresAt) }}
                    </p>
                </div>
                <div class="mt-6 flex gap-3">
                    <button @click="closeConfirmModal" class="flex-1 rounded-full bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                        Cancel
                    </button>
                    <button @click="handleConfirmBooking" class="flex-1 rounded-full bg-green-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-700">
                        <i class="fa-solid fa-check mr-2"></i> Confirm
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Cancel Booking Modal ── -->
        <div v-if="showCancelModal && bookingToCancel" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md p-6 border border-gray-200 dark:border-gray-700 animate-scale-in">
                <div class="text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30 mb-4">
                        <i class="fa-solid fa-circle-xmark text-2xl text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Cancel Booking</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        Are you sure you want to cancel your booking for <span class="font-semibold">{{ bookingToCancel.court }}</span> on {{ formatDateLong(bookingToCancel.date) }}?
                    </p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This action cannot be undone.</p>
                    <p v-if="bookingToCancel.cancellationDeadline" class="mt-2 text-xs text-blue-600 dark:text-blue-400">
                        ℹ️ You can cancel up to {{ Math.round((new Date(bookingToCancel.cancellationDeadline) - new Date()) / 1000 / 60) }} minutes before the booking.
                    </p>
                </div>
                <div class="mt-6 flex gap-3">
                    <button @click="closeCancelModal" class="flex-1 rounded-full bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                        Keep Booking
                    </button>
                    <button @click="handleCancelBooking" class="flex-1 rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">
                        <i class="fa-solid fa-trash mr-2"></i> Cancel Booking
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// ── State ──
const bookings = ref([
    {
        id: 1,
        court: 'Court 3',
        date: '2026-07-20',
        time: '6:00 PM - 8:00 PM',
        players: 2,
        status: 'confirmed',
        price: '$45.00',
        bookingRef: 'BK-2026-001',
        notes: 'Indoor court, near the entrance',
        createdAt: new Date(Date.now() - 1000 * 60 * 5),
        expiresAt: new Date(Date.now() + 1000 * 60 * 15),
        canCancel: true,
        cancellationDeadline: new Date(Date.now() + 1000 * 60 * 60 * 2),
    },
    {
        id: 2,
        court: 'Court 1',
        date: '2026-07-22',
        time: '10:00 AM - 12:00 PM',
        players: 4,
        status: 'pending',
        price: '$60.00',
        bookingRef: 'BK-2026-002',
        notes: 'Outdoor court, bring sunscreen',
        createdAt: new Date(Date.now() - 1000 * 60 * 2),
        expiresAt: new Date(Date.now() + 1000 * 60 * 13),
        canCancel: false,
        cancellationDeadline: null,
    },
    {
        id: 3,
        court: 'Court 5',
        date: '2026-07-25',
        time: '4:00 PM - 6:00 PM',
        players: 6,
        status: 'confirmed',
        price: '$75.00',
        bookingRef: 'BK-2026-003',
        notes: 'Premium court with night lighting',
        createdAt: new Date(Date.now() - 1000 * 60 * 30),
        expiresAt: new Date(Date.now() + 1000 * 60 * 5),
        canCancel: true,
        cancellationDeadline: new Date(Date.now() + 1000 * 60 * 60 * 1),
    },
    {
        id: 4,
        court: 'Court 2',
        date: '2026-07-18',
        time: '2:00 PM - 4:00 PM',
        players: 2,
        status: 'completed',
        price: '$45.00',
        bookingRef: 'BK-2026-004',
        notes: 'Completed successfully',
        createdAt: new Date(Date.now() - 1000 * 60 * 60 * 24),
        expiresAt: null,
        canCancel: false,
        cancellationDeadline: null,
    },
    {
        id: 5,
        court: 'Court 4',
        date: '2026-07-15',
        time: '7:00 PM - 9:00 PM',
        players: 4,
        status: 'cancelled',
        price: '$0.00',
        bookingRef: 'BK-2026-005',
        notes: 'Cancelled due to weather',
        createdAt: new Date(Date.now() - 1000 * 60 * 60 * 48),
        expiresAt: null,
        canCancel: false,
        cancellationDeadline: null,
    },
]);

// ── Modal States ──
const selectedBooking = ref(null);
const showDetailsModal = ref(false);
const showConfirmModal = ref(false);
const showCancelModal = ref(false);
const bookingToConfirm = ref(null);
const bookingToCancel = ref(null);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');

// ── Helper Functions ──
const formatDate = (date) => {
    return new Date(date).toLocaleDateString('en-US', {
        weekday: 'short',
        month: 'short',
        day: 'numeric',
        year: 'numeric',
    });
};

const formatDateLong = (date) => {
    return new Date(date).toLocaleDateString('en-US', {
        weekday: 'long',
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    });
};

const getStatusBadge = (status) => {
    const map = {
        confirmed: 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
        pending: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
        completed: 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
        cancelled: 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
        expired: 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
    };
    return map[status] || map.pending;
};

const getStatusText = (status) => status.charAt(0).toUpperCase() + status.slice(1);

const getTimeRemaining = (expiresAt) => {
    const now = new Date();
    const diff = new Date(expiresAt) - now;
    if (diff <= 0) return 'Expired';
    const minutes = Math.floor(diff / 1000 / 60);
    const seconds = Math.floor((diff / 1000) % 60);
    if (minutes > 0) return `${minutes}m ${seconds}s remaining`;
    return `${seconds}s remaining`;
};

const isAboutToExpire = (booking) => {
    if (booking.status !== 'pending' || !booking.expiresAt) return false;
    const now = new Date();
    const timeLeft = new Date(booking.expiresAt) - now;
    return timeLeft > 0 && timeLeft < 1000 * 60 * 2;
};

const canCancelBooking = (booking) => {
    if (booking.status !== 'confirmed') return false;
    if (!booking.cancellationDeadline) return true;
    return new Date(booking.cancellationDeadline) > new Date();
};

// ── Modal Handlers ──
const handleViewDetails = (booking) => {
    selectedBooking.value = booking;
    showDetailsModal.value = true;
};

const closeDetailsModal = () => {
    showDetailsModal.value = false;
    selectedBooking.value = null;
};

const handleConfirmClick = (booking) => {
    bookingToConfirm.value = booking;
    showConfirmModal.value = true;
    closeDetailsModal();
};

const handleConfirmBooking = () => {
    const index = bookings.value.findIndex(b => b.id === bookingToConfirm.value.id);
    bookings.value[index].status = 'confirmed';
    
    showToastMessage(`Booking for ${bookingToConfirm.value.court} confirmed successfully!`, 'success');
    showConfirmModal.value = false;
    bookingToConfirm.value = null;
};

const closeConfirmModal = () => {
    showConfirmModal.value = false;
    bookingToConfirm.value = null;
};

const handleCancelClick = (booking) => {
    bookingToCancel.value = booking;
    showCancelModal.value = true;
    closeDetailsModal();
};

const handleCancelBooking = () => {
    const index = bookings.value.findIndex(b => b.id === bookingToCancel.value.id);
    bookings.value[index].status = 'cancelled';
    
    showToastMessage(`Booking for ${bookingToCancel.value.court} has been cancelled.`, 'info');
    showCancelModal.value = false;
    bookingToCancel.value = null;
};

const closeCancelModal = () => {
    showCancelModal.value = false;
    bookingToCancel.value = null;
};

const showToastMessage = (message, type = 'success') => {
    toastMessage.value = message;
    toastType.value = type;
    showToast.value = true;
    setTimeout(() => { showToast.value = false; }, 3000);
};

// ── Auto-expire pending bookings ──
let intervalId = null;

onMounted(() => {
    intervalId = setInterval(() => {
        const now = new Date();
        bookings.value = bookings.value.map(booking => {
            if (booking.status === 'pending' && booking.expiresAt && new Date(booking.expiresAt) < now) {
                showToastMessage(`Booking for ${booking.court} has expired. Please book again.`, 'warning');
                return { ...booking, status: 'expired' };
            }
            return booking;
        });
    }, 10000);
});

onUnmounted(() => {
    if (intervalId) clearInterval(intervalId);
});
</script>

  <!-- ── Custom CSS ── -->
        <style scoped>
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes scaleIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-slide-in { animation: slideIn 0.3s ease-out; }
        .animate-scale-in { animation: scaleIn 0.2s ease-out; }
        .animate-pulse { animation: pulse 1.5s ease-in-out infinite; }
        </style>