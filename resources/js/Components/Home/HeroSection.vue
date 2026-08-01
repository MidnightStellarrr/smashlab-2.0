<template>
    <header class="hero">
        <div class="overlay"></div>

        <!-- Navigation -->
        <Navbar />

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="left-content">
                <h1>Let the Smashing <br />Begin</h1>
            </div>

            <div class="right-content">
                <p>
                    Feel the rush of the game, the
                    energy of the crowd, and the thrill
                    of every smash.
                </p>

                <div class="buttons">
                    <Link href="/services" class="learn-btn">
                        Learn more
                    </Link>
                    <Link href="/book_now" class="book-btn">
                        Book now
                    </Link>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Home/Navbar.vue';
</script>

<style scoped>
.hero {
    position: relative;
    width: 100%;
    height: 100vh;
    background: url("/images/homepage_header.png") center center/cover no-repeat;
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
    height: calc(100vh - 130px);
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 130px;
    padding: 0 110px 110px;
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
    width: 135px;
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
}
</style>