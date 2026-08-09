<template>
    <Head title="Register" />

    <div
        class="flex min-h-screen w-full items-center justify-center"
        :style="{
            backgroundImage: 'linear-gradient(135deg, #0a1628 0%, #1a2a4a 50%, #2a3a6a 100%)',
            backgroundSize: 'cover',
            backgroundPosition: 'center',
            backgroundRepeat: 'no-repeat'
        }"
    >
        <div class="w-full max-w-md px-6">
            <!-- Logo -->
            <div class="mb-8 flex justify-center">
                <img src="/images/logo.png" class="h-16 w-auto" alt="SmashLab" />
            </div>

            <h1 class="mb-2 text-center text-4xl font-bold text-white">
                CREATE ACCOUNT
            </h1>

            <p class="mb-8 text-center text-sm text-gray-300">
                Register to start booking courts and managing your account.
            </p>

            <form @submit.prevent="submit" class="space-y-5">
                <!-- Full Name -->
                <div>
                    <InputLabel for="name" value="" class="hidden" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        class="w-full rounded-full border border-white/30 bg-white/10 px-6 py-3 text-white placeholder-gray-400 focus:border-white/60 focus:ring-0"
                        autocomplete="name"
                        placeholder="Full Name"
                        required
                        autofocus
                    />
                    <InputError :message="form.errors.name" class="mt-2 text-sm text-red-400" />
                </div>

                <!-- Email -->
                <div>
                    <InputLabel for="email" value="" class="hidden" />
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        class="w-full rounded-full border border-white/30 bg-white/10 px-6 py-3 text-white placeholder-gray-400 focus:border-white/60 focus:ring-0"
                        autocomplete="username"
                        placeholder="Email"
                        required
                    />
                    <InputError :message="form.errors.email" class="mt-2 text-sm text-red-400" />
                </div>

                <!-- Password -->
                <div>
                    <InputLabel for="password" value="" class="hidden" />
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        class="w-full rounded-full border border-white/30 bg-white/10 px-6 py-3 text-white placeholder-gray-400 focus:border-white/60 focus:ring-0"
                        autocomplete="new-password"
                        placeholder="Password"
                        required
                    />
                    <InputError :message="form.errors.password" class="mt-2 text-sm text-red-400" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <InputLabel for="password_confirmation" value="" class="hidden" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        class="w-full rounded-full border border-white/30 bg-white/10 px-6 py-3 text-white placeholder-gray-400 focus:border-white/60 focus:ring-0"
                        autocomplete="new-password"
                        placeholder="Confirm Password"
                        required
                    />
                    <InputError :message="form.errors.password_confirmation" class="mt-2 text-sm text-red-400" />
                </div>

                <!-- Register Button -->
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="mt-2 w-full rounded-full bg-white py-3 text-lg font-bold text-gray-900 transition hover:bg-gray-200 disabled:opacity-50"
                >
                    Register
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/20"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-transparent px-4 text-gray-400">or continue with</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="flex gap-4">
                    <button
                        type="button"
                        class="flex flex-1 items-center justify-center gap-2 rounded-full border border-white/30 bg-white/10 py-3 text-sm font-medium text-white transition hover:bg-white/20"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    <button
                        type="button"
                        class="flex flex-1 items-center justify-center gap-2 rounded-full border border-white/30 bg-white/10 py-3 text-sm font-medium text-white transition hover:bg-white/20"
                    >
                        <svg class="h-5 w-5" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </button>
                </div>

                <!-- Login Link -->
                <div class="pt-4 text-center">
                    <Link
                        :href="route('login')"
                        class="text-sm text-gray-300 transition hover:text-white"
                    >
                        Already have an account? <span class="font-semibold text-white">Login</span>
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>