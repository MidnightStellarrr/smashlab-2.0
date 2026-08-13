<template>
    <header class="hero" :style="heroStyle">
        <div class="overlay"></div>

        <!-- Navigation -->
        <Navbar v-if="showNavbar" />

        <!-- Hero Content -->
        <div class="hero-content" :class="{ 'centered': centered, 'full-width': fullWidth }">
            <div class="left-content">
                <h1 v-html="mainHeading"></h1>
            </div>

            <div class="right-content" v-if="!centered">
                <p>{{ subHeading }}</p>

                <div class="buttons">
                    <Link href="/services" class="learn-btn">
                        Explore Services
                    </Link>
                    <Link href="/book_now" class="book-btn">
                        Book Your Court
                    </Link>
                </div>
            </div>

            <!-- Centered content for inner pages -->
            <div class="centered-content" v-if="centered">
                <p>{{ subHeading }}</p>
            </div>
        </div>
    </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Home/Navbar.vue';
import { computed } from 'vue';

const props = defineProps({
    mainHeading: {
        type: String,
        default: 'Let the Smashing <br />Begin'
    },
    subHeading: {
        type: String,
        default: 'Your court is waiting. Book instantly, play like a pro, and dominate the game.'
    },
    bgImage: {
        type: String,
        default: '/images/homepage_header.png'
    },
    height: {
        type: String,
        default: '100vh'
    },
    centered: {
        type: Boolean,
        default: false
    },
    showNavbar: {
        type: Boolean,
        default: true
    },
    fullWidth: {
        type: Boolean,
        default: false
    }
});

const heroStyle = computed(() => ({
    backgroundImage: `url(${props.bgImage})`,
    height: props.height
}));
</script>

<style scoped>
.hero {
    position: relative;
    width: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
}

.overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg,
            rgba(0, 0, 0, .72),
            rgba(0, 0, 0, .35),
            rgba(16, 39, 112, .45));
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    height: calc(100% - 130px);
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 130px;
    padding: 0 110px 110px;
}

.hero-content.full-width {
    padding: 0;
    margin-top: 0;
    height: 100%;
}

/* Centered layout for inner pages */
.hero-content.centered {
    justify-content: center;
    align-items: center;
    text-align: center;
    flex-direction: column;
    padding: 0 110px 80px;
}

.centered-content {
    max-width: 800px;
}

.centered-content p {
    color: white;
    font-size: 20px;
    line-height: 1.6;
    margin-top: 10px;
    font-weight: 400;
}

.left-content h1 {
    color: white;
    font-size: 90px;
    font-weight: 600;
    line-height: 1.08;
}

.right-content {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    margin-bottom: 30px;
    align-self: flex-start;
    margin-top: 350px;
}

.right-content p {
    color: white;
    text-align: right;
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 40px;
    max-width: 400px;
    font-weight: 400;
    margin-left: auto;
}

.buttons {
    display: flex;
    gap: 22px;
}

.learn-btn,
.book-btn {
    text-decoration: none;
    padding: 0;
    width: 155px;
    height: 48px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.4s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.learn-btn {
    color: white;
    border: 2px solid white;
    background: transparent;
}

.learn-btn:hover {
    background: white;
    color: black;
    transform: translateY(-3px);
}

.book-btn {
    color: black;
    background: white;
    border: 2px solid white;
}

.book-btn:hover {
    transform: translateY(-3px);
}

@media (max-width: 1200px) {
    .hero-content { padding: 0 40px 80px; }
    .left-content h1 { font-size: 68px; }
}

@media (max-width: 900px) {
    .hero-content {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        gap: 40px;
        padding: 0 40px 60px;
    }
    .hero-content.centered {
        padding: 0 40px 40px;
    }
    .left-content h1 { font-size: 58px; }
    .right-content {
        align-items: center;
        margin-top: 0;
    }
    .right-content p {
        text-align: center;
        margin-left: 0;
    }
    .buttons { justify-content: center; }
    .centered-content p { font-size: 18px; }
}

@media (max-width: 480px) {
    .hero-content.centered {
        padding: 0 20px 40px;
    }
    .centered-content p { font-size: 16px; }
}
</style>
