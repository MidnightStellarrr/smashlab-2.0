<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Simple Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-xl font-bold text-blue-600">🏸 SmashLab</span>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ $page.props.auth.user.name }}</span>
                        <button @click="logout" class="text-red-500 hover:text-red-700">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-bold">Front Desk Dashboard</h2>
                        <p class="mt-2 text-gray-600">Welcome, {{ $page.props.auth.user.name }}!</p>
                        <p class="text-gray-600">You are logged in as front desk staff.</p>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <div class="text-sm text-blue-600">Today's Bookings</div>
                                <div class="text-2xl font-bold text-blue-800">12</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <div class="text-sm text-green-600">Check-ins</div>
                                <div class="text-2xl font-bold text-green-800">8</div>
                            </div>
                            <div class="bg-yellow-50 p-4 rounded-lg">
                                <div class="text-sm text-yellow-600">Active Courts</div>
                                <div class="text-2xl font-bold text-yellow-800">4/6</div>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg">
                                <div class="text-sm text-red-600">Walk-ins</div>
                                <div class="text-2xl font-bold text-red-800">5</div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                            <button class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">
                                <i class="fa-solid fa-user-plus"></i> Walk-in
                            </button>
                            <button class="bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition">
                                <i class="fa-solid fa-check"></i> Check-in
                            </button>
                            <button class="bg-yellow-600 text-white p-3 rounded-lg hover:bg-yellow-700 transition">
                                <i class="fa-solid fa-clock"></i> Extend
                            </button>
                            <button class="bg-purple-600 text-white p-3 rounded-lg hover:bg-purple-700 transition">
                                <i class="fa-solid fa-cart-shopping"></i> Shop
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

const logout = () => {
    router.post(route('frontdesk.logout'));
};
</script>