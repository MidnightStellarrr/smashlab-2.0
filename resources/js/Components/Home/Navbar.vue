<template>
    <nav class="navbar" ref="navbar">
        <div class="nav-container">
            <!-- Hamburger Button - LEFT SIDE -->
            <button @click="toggleMenu" class="hamburger-btn" aria-label="Toggle menu">
                <span class="hamburger-line" :class="{ active: isMenuOpen }"></span>
                <span class="hamburger-line" :class="{ active: isMenuOpen }"></span>
                <span class="hamburger-line" :class="{ active: isMenuOpen }"></span>
            </button>

            <!-- Logo -->
            <Link href="/" class="logo-link">
                <img src="/images/logo.png" class="logo" alt="Logo" />
            </Link>

            <!-- Desktop Nav Links - LEFT ALIGNED -->
            <ul class="nav-links desktop">
                <li><Link href="/">Home</Link></li>
                <li><Link href="/book_now">Book Now</Link></li>
                <li><Link href="/classes">Classes</Link></li>
                <li><Link href="/shop">Shop</Link></li>
                <li><Link href="/about_us">About Us</Link></li>
                <li><Link href="/contact">Contact</Link></li>
            </ul>

            <!-- Desktop Nav Right -->
            <div class="nav-right desktop">
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
        </div>

        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay" :class="{ open: isMenuOpen }" @click="closeMenu"></div>

        <!-- Mobile Menu Content - LEFT SIDE -->
        <div class="mobile-menu" :class="{ open: isMenuOpen }">
            <ul class="mobile-nav-links">
                <li><Link href="/" @click="closeMenu">Home</Link></li>
                <li><Link href="/book_now" @click="closeMenu">Book Now</Link></li>
                <li><Link href="/classes" @click="closeMenu">Classes</Link></li>
                <li><Link href="/shop" @click="closeMenu">Shop</Link></li>
                <li><Link href="/about_us" @click="closeMenu">About Us</Link></li>
                <li><Link href="/contact" @click="closeMenu">Contact</Link></li>
            </ul>

            <div class="mobile-nav-right">
                <!-- Dark Mode Toggle -->
                <button @click="toggleDarkMode" class="theme-btn mobile" aria-label="Toggle dark mode">
                    <i :class="isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i>
                </button>

                <template v-if="$page.props.auth.user">
                    <Link href="/cart" class="cart-btn mobile" @click="closeMenu">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count">0</span>
                    </Link>
                    
                    <Link :href="route('dashboard')" class="dashboard-btn mobile" @click="closeMenu">
                        <i class="fa-solid fa-user"></i>
                    </Link>
                    
                    <button @click="logout" class="logout-btn mobile">
                        <i class="fa-solid fa-sign-out-alt"></i> Logout
                    </button>
                </template>

                <template v-else>
                    <Link :href="route('login')" class="login-btn mobile" @click="closeMenu">Login</Link>
                    <Link :href="route('register')" class="signup-btn mobile" @click="closeMenu">Sign up</Link>
                </template>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const navbar = ref(null);
const isDark = ref(false);
const isMenuOpen = ref(false);

// ── Toggle Menu ──
const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
    if (isMenuOpen.value) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
};

const closeMenu = () => {
    isMenuOpen.value = false;
    document.body.style.overflow = '';
};

// ── Dark Mode ──
const toggleDarkMode = () => {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('smashlab-theme', isDark.value ? 'dark' : 'light');
};

// ── Logout ──
const logout = () => {
    router.post(route('logout'));
    closeMenu();
};

// ── Scroll behavior ──
const handleScroll = () => {
    const nav = navbar.value;
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
};

// ── Close menu on resize to desktop ──
const handleResize = () => {
    if (window.innerWidth > 992 && isMenuOpen.value) {
        closeMenu();
    }
};

onMounted(() => {
    const storedTheme = localStorage.getItem('smashlab-theme');
    if (storedTheme === 'dark') {
        isDark.value = true;
        document.documentElement.classList.add('dark');
    }

    window.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', handleResize);
    handleScroll();
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
    window.removeEventListener('resize', handleResize);
});
</script>

<style scoped>
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    background: transparent;
    padding: 30px 80px;
    transition: all 0.3s ease;
}

.nav-container {
    display: flex;
    align-items: center;
    width: 100%;
    gap: 20px;
}

/* ── Hamburger Button - LEFT ── */
.hamburger-btn {
    display: none;
    flex-direction: column;
    justify-content: space-between;
    width: 28px;
    height: 20px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    z-index: 1001;
    flex-shrink: 0;
}

.hamburger-line {
    width: 100%;
    height: 2px;
    background: white;
    border-radius: 2px;
    transition: all 0.3s ease;
    transform-origin: center;
}

.hamburger-line.active:nth-child(1) {
    transform: translateY(9px) rotate(45deg);
}

.hamburger-line.active:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
}

.hamburger-line.active:nth-child(3) {
    transform: translateY(-9px) rotate(-45deg);
}

/* ── Logo ── */
.logo-link {
    flex-shrink: 0;
}

.logo {
    display: block;
    width: 46px;
    height: 46px;
    object-fit: contain;
}

/* ── Desktop Nav Links - LEFT ALIGNED ── */
.nav-links.desktop {
    display: flex;
    list-style: none;
    gap: 32px;
    padding: 0;
    margin: 0;
    flex: 1;
}

.nav-links.desktop a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    font-weight: 400;
    transition: color 0.3s ease;
    position: relative;
    padding-bottom: 4px;
}

.nav-links.desktop a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: white;
    transition: width 0.3s ease;
}

.nav-links.desktop a:hover::after {
    width: 100%;
}

/* ── Desktop Nav Right ── */
.nav-right.desktop {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-shrink: 0;
}

/* ── Scrolled state ── */
.navbar.scrolled {
    background: rgba(10, 22, 40, 0.85);
    backdrop-filter: blur(16px);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
}

:global(.dark) .navbar.scrolled {
    background: rgba(10, 22, 40, 0.92);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
}

/* ── Mobile Menu Overlay ── */
.mobile-menu-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.mobile-menu-overlay.open {
    display: block;
}

/* ── Mobile Menu - LEFT SIDE ── */
.mobile-menu {
    display: none;
    position: fixed;
    top: 0;
    left: -100%;
    width: 80%;
    max-width: 340px;
    height: 100vh;
    background: #0a1628;
    padding: 80px 30px 40px;
    z-index: 1000;
    transition: left 0.3s ease;
    overflow-y: auto;
    flex-direction: column;
    justify-content: flex-start;
    gap: 30px;
}

.mobile-menu.open {
    left: 0;
    display: flex;
}

:global(.dark) .mobile-menu {
    background: #111827;
}

.mobile-nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.mobile-nav-links li {
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}

.mobile-nav-links a {
    color: white;
    text-decoration: none;
    font-size: 20px;
    font-weight: 500;
    padding: 12px 0;
    display: block;
}

.mobile-nav-links a:hover {
    color: #4a7a9c;
}

:global(.dark) .mobile-nav-links a {
    color: #d1d5db;
}

:global(.dark) .mobile-nav-links a:hover {
    color: #6a9abc;
}

.mobile-nav-right {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-top: 10px;
}

.mobile-nav-right .theme-btn.mobile,
.mobile-nav-right .cart-btn.mobile,
.mobile-nav-right .dashboard-btn.mobile {
    width: 100%;
    height: 48px;
    justify-content: center;
    gap: 12px;
    border-radius: 40px;
    background: rgba(255, 255, 255, 0.06);
    color: white;
    font-size: 16px;
}

.mobile-nav-right .login-btn.mobile,
.mobile-nav-right .signup-btn.mobile,
.mobile-nav-right .logout-btn.mobile {
    width: 100%;
    justify-content: center;
    height: 48px;
    font-size: 16px;
}

.mobile-nav-right .login-btn.mobile {
    border-color: rgba(255, 255, 255, 0.3);
}

:global(.dark) .mobile-nav-right .theme-btn.mobile,
:global(.dark) .mobile-nav-right .cart-btn.mobile,
:global(.dark) .mobile-nav-right .dashboard-btn.mobile {
    background: rgba(255, 255, 255, 0.04);
}

/* ── Theme Button ── */
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

/* ── Buttons ── */
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
    color: white;
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

/* ── Scrolled state colors ── */
.navbar.scrolled .nav-links.desktop a {
    color: #ffffff;
}

.navbar.scrolled .nav-links.desktop a::after {
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
    color: white;
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
}

.navbar.scrolled .logout-btn:hover {
    background: #ef4444;
    color: #ffffff;
}

/* ── Dark Mode ── */
:global(.dark) .nav-links.desktop a {
    color: #d1d5db;
}

:global(.dark) .nav-links.desktop a:hover {
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

/* ── Hamburger dark mode ── */
:global(.dark) .hamburger-line {
    background: #d1d5db;
}

:global(.dark) .hamburger-line.active {
    background: #d1d5db;
}

/* ── Responsive ── */
@media (max-width: 1200px) {
    .navbar { padding: 20px 40px; }
    .nav-links.desktop { gap: 24px; }
    .nav-links.desktop a { font-size: 15px; }
}

@media (max-width: 992px) {
    .navbar {
        padding: 16px 20px;
    }

    .hamburger-btn {
        display: flex;
    }

    .nav-links.desktop {
        display: none !important;
    }

    .nav-right.desktop {
        display: none !important;
    }

    .mobile-menu {
        display: none;
    }

    .mobile-menu.open {
        display: flex;
    }

    .nav-container {
        gap: 16px;
    }
}

@media (max-width: 576px) {
    .navbar {
        padding: 12px 16px;
    }

    .logo {
        width: 38px;
        height: 38px;
    }

    .mobile-menu {
        width: 85%;
        max-width: 300px;
        padding: 70px 20px 30px;
    }

    .mobile-nav-links a {
        font-size: 18px;
    }

    .mobile-nav-right .theme-btn.mobile,
    .mobile-nav-right .cart-btn.mobile,
    .mobile-nav-right .dashboard-btn.mobile {
        height: 44px;
        font-size: 15px;
    }

    .mobile-nav-right .login-btn.mobile,
    .mobile-nav-right .signup-btn.mobile,
    .mobile-nav-right .logout-btn.mobile {
        height: 44px;
        font-size: 15px;
    }
}
</style>