<template>
    <nav class="navbar" ref="navbar">
        <div class="nav-left">
            <Link href="/" class="logo-link">
                <img src="/images/logo.png" class="logo" alt="Logo" />
            </Link>

            <ul class="nav-links">
                <li><Link href="/">Home</Link></li>
                <li><Link href="/book_now">Book Now</Link></li>
                <li><Link href="/classes">Classes</Link></li>
                <li><Link href="/shop">Shop</Link></li>
                <li><Link href="/about_us">About Us</Link></li>
                <li><Link href="/contact">Contact</Link></li>
            </ul>
        </div>

        <div class="nav-right">
            <!-- Dark Mode Toggle -->
            <button @click="toggleDarkMode" class="theme-btn" aria-label="Toggle dark mode">
                <i :class="isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i>
            </button>

            <template v-if="$page.props.auth.user">
                <Link href="/cart" class="cart-btn">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count">0</span>
                </Link>
                
                <Link :href="route('dashboard')" class="dashboard-btn">
                    <i class="fa-solid fa-user"></i>
                </Link>
                
                <button @click="logout" class="logout-btn">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </button>
            </template>

            <template v-else>
                <Link :href="route('login')" class="login-btn">Login</Link>
                <Link :href="route('register')" class="signup-btn">Sign up</Link>
            </template>
        </div>
    </nav>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const navbar = ref(null);
const isDark = ref(false);

// Dark Mode
const toggleDarkMode = () => {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('smashlab-theme', isDark.value ? 'dark' : 'light');
};

// Logout
const logout = () => {
    router.post(route('logout'));
};

// Scroll behavior - just add scrolled class for background
const handleScroll = () => {
    const nav = navbar.value;
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
};

onMounted(() => {
    // Dark mode init
    const storedTheme = localStorage.getItem('smashlab-theme');
    if (storedTheme === 'dark') {
        isDark.value = true;
        document.documentElement.classList.add('dark');
    }

    window.addEventListener('scroll', handleScroll);
    handleScroll();
});
</script>

<style scoped>
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 80px; /* Consistent padding */
    background: transparent;
    /* Remove all transitions */
}

/* Scrolled state - only changes background, NOT padding */
.navbar.scrolled {
    background: rgba(10, 22, 40, 0.85);
    backdrop-filter: blur(16px);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}

/* Dark Mode Scrolled State */
:global(.dark) .navbar.scrolled {
    background: rgba(10, 22, 40, 0.92);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 45px;
}

.logo {
    display: block;
    width: 46px;
    height: 46px;
    object-fit: contain;
    /* Remove logo size transition */
}

.nav-links {
    display: flex;
    list-style: none;
    gap: 42px;
    padding: 0;
    margin: 0;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    font-weight: 400;
    transition: color 0.3s ease;
    position: relative;
    padding-bottom: 4px;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: white;
    transition: width 0.3s ease;
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.theme-btn {
    width: 45px;
    height: 45px;
    border: none;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    color: white;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.theme-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: rotate(30deg) scale(1.05);
}

.login-btn,
.signup-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 45px;
    font-size: 15px;
    padding: 0 24px;
}

.login-btn {
    min-width: 120px;
    border-radius: 40px;
    border: 2px solid rgba(255, 255, 255, 0.8);
    background: transparent;
    color: white;
}

.login-btn:hover {
    background: white;
    color: #173A8D;
    transform: translateY(-3px);
}

.signup-btn {
    min-width: 120px;
    border-radius: 40px;
    border: none;
    background: white;
    color: #173A8D;
}

.signup-btn:hover {
    background: #2a5ae8;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(31, 71, 216, 0.35);
}

.cart-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    text-decoration: none;
    transition: all 0.3s ease;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.cart-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

.cart-count {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #ef4444;
    color: white;
    font-size: 11px;
    font-weight: 700;
    min-width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    text-decoration: none;
    transition: all 0.3s ease;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.dashboard-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

.logout-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border: none;
    border-radius: 40px;
    background: rgba(255, 255, 255, 0.9);
    color: #080808;
    font-size: 14px;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
}

.logout-btn:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-3px);
}

/* Scrolled state color changes (no padding changes) */
.navbar.scrolled .nav-links a {
    color: #ffffff;
}

.navbar.scrolled .nav-links a::after {
    background: #ffffff;
}

.navbar.scrolled .theme-btn {
    background: rgba(255, 255, 255, 0.12);
    color: #ffffff;
}

.navbar.scrolled .theme-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.navbar.scrolled .login-btn {
    border-color: rgba(255, 255, 255, 0.4);
    color: #ffffff;
}

.navbar.scrolled .login-btn:hover {
    background: #ffffff;
    color: #173A8D;
}

.navbar.scrolled .signup-btn {
    background: white;
    color: #173A8D;
}

.navbar.scrolled .signup-btn:hover {
    background: #2a5ae8;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(31, 71, 216, 0.35);
}

.navbar.scrolled .cart-btn {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
}

.navbar.scrolled .cart-btn:hover {
    background: rgba(255, 255, 255, 0.15);
}

.navbar.scrolled .dashboard-btn {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
}

.navbar.scrolled .dashboard-btn:hover {
    background: rgba(255, 255, 255, 0.15);
}

.navbar.scrolled .logout-btn {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    backdrop-filter: blur(4px);
}

.navbar.scrolled .logout-btn:hover {
    background: #ef4444;
    color: #ffffff;
}

/* Dark Mode */
:global(.dark) .nav-links a {
    color: #d1d5db;
}

:global(.dark) .nav-links a:hover {
    color: #ffffff;
}

:global(.dark) .theme-btn {
    background: #1a2a4a;
    color: #4a7a9c;
}

:global(.dark) .theme-btn:hover {
    background: #2a3a5a;
    color: #6a9abc;
}

:global(.dark) .login-btn {
    border-color: #4a7a9c;
    color: #4a7a9c;
}

:global(.dark) .login-btn:hover {
    background: #4a7a9c;
    color: #0a1628;
}

:global(.dark) .signup-btn {
    background: #4a7a9c;
    color: #0a1628;
}

:global(.dark) .signup-btn:hover {
    background: #5a8aac;
}

:global(.dark) .logout-btn {
    color: #000000;
}

:global(.dark) .logout-btn:hover {
    color: #ffffff;
}

:global(.dark) .navbar.scrolled .theme-btn {
    background: rgba(255, 255, 255, 0.08);
    color: #d1d5db;
}

:global(.dark) .navbar.scrolled .theme-btn:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
}

:global(.dark) .navbar.scrolled .login-btn {
    border-color: rgba(255, 255, 255, 0.25);
    color: #d1d5db;
}

:global(.dark) .navbar.scrolled .login-btn:hover {
    background: #1f47d8;
    color: #ffffff;
    border-color: #1f47d8;
}

:global(.dark) .navbar.scrolled .signup-btn {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .navbar.scrolled .signup-btn:hover {
    background: #2a5ae8;
}

/* Responsive */
@media (max-width: 1200px) {
    .navbar { padding: 20px 40px; }
    .nav-links { gap: 24px; }
    .nav-links a { font-size: 15px; }
}

@media (max-width: 992px) {
    .navbar {
        flex-direction: column;
        gap: 20px;
        padding: 20px 30px;
    }
    .nav-left {
        flex-direction: column;
        gap: 20px;
        width: 100%;
    }
    .nav-links {
        flex-wrap: wrap;
        justify-content: center;
        gap: 16px 24px;
    }
    .nav-links a { font-size: 14px; }
    .login-btn, .signup-btn {
        min-width: 100px;
        height: 42px;
        font-size: 14px;
        padding: 0 18px;
    }
    .cart-btn, .dashboard-btn {
        width: 42px;
        height: 42px;
        font-size: 18px;
    }
    .logout-btn { padding: 8px 16px; font-size: 13px; }
}

@media (max-width: 576px) {
    .navbar {
        padding: 16px 16px;
        gap: 16px;
    }
    .nav-left { gap: 16px; }
    .nav-links { gap: 12px 16px; }
    .nav-links a { font-size: 13px; }
    .nav-links a::after { display: none; }
    .nav-right {
        gap: 12px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .login-btn, .signup-btn {
        min-width: 80px;
        height: 38px;
        font-size: 13px;
        padding: 0 14px;
    }
    .login-btn { border-width: 1.5px; }
    .theme-btn {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }
    .logo { width: 38px; height: 38px; }
    .cart-btn, .dashboard-btn {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }
    .cart-count {
        font-size: 10px;
        min-width: 18px;
        height: 18px;
        top: -3px;
        right: -3px;
    }
    .logout-btn {
        padding: 8px 14px;
        font-size: 12px;
    }
    .logout-btn i { font-size: 12px; }
}

@media (max-width: 380px) {
    .navbar { padding: 12px 12px; }
    .nav-links { gap: 8px 12px; }
    .nav-links a { font-size: 12px; }
    .login-btn, .signup-btn {
        min-width: 70px;
        height: 34px;
        font-size: 12px;
        padding: 0 10px;
    }
    .theme-btn {
        width: 34px;
        height: 34px;
        font-size: 14px;
    }
    .logo { width: 34px; height: 34px; }
    .cart-btn, .dashboard-btn {
        width: 34px;
        height: 34px;
        font-size: 14px;
    }
    .cart-count {
        font-size: 9px;
        min-width: 16px;
        height: 16px;
        top: -2px;
        right: -2px;
    }
    .logout-btn {
        padding: 6px 10px;
        font-size: 11px;
    }
    .logout-btn i { font-size: 11px; }
}
</style>