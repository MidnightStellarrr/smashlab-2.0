<template>
    <GuestLayout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                
                <!-- Logo / Header -->
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">⚙️ Admin Access</h1>
                    <p class="text-gray-600">System Administrator Login</p>
                    <span class="inline-block bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-semibold mt-2">Admin Only</span>
                </div>

                <!-- Error Messages -->
                <div v-if="Object.keys(errors).length > 0" class="bg-red-50 text-red-600 p-3 rounded-md mb-4 border border-red-200">
                    <div v-for="(error, key) in errors" :key="key" class="text-sm">{{ error }}</div>
                </div>

                <!-- Login Form -->
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input 
                            v-model="form.email" 
                            type="email" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            placeholder="admin@smashlab.com"
                            required 
                            autofocus
                        />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input 
                            v-model="form.password" 
                            type="password" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            placeholder="••••••••"
                            required 
                        />
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <label class="flex items-center">
                            <input v-model="form.remember" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" />
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Logging in...' : 'Sign In' }}
                    </button>
                </form>

                <!-- Switch Links -->
                <div class="mt-4 text-center">
                    <Link :href="route('frontdesk.login')" class="text-sm text-blue-600 hover:text-blue-800">
                        ← Front Desk Login
                    </Link>
                </div>

                <div class="mt-4 text-center text-xs text-gray-500">
                    <i class="fa-solid fa-shield-halved"></i> Secure Admin Access · SmashLab
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    errors: Object,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('admin.login.post'), {
        onFinish: () => form.reset('password'),
    });
};
</script>