<template>
    <section class="ready-section">
        <div class="ready-overlay"></div>

        <div class="ready-content">
            <h2>Ready to Smash?</h2>
            <p>
                Join thousands of players who book, train, <br />and
                play at Smash Lab.
            </p>
            <Link href="/book_now" class="ready-btn">
                Get Started Now
            </Link>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.ready-section {
    position: relative;
    width: 100%;
    height: 500px;
    background: url("/images/ready_to_play.jpg") center center/cover no-repeat;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.ready-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, .45);
}

.ready-content {
    position: relative;
    z-index: 2;
    max-width: 550px;
    margin-left: 9%;
    color: #fff;
}

.ready-content h2 {
    font-size: 60px;
    font-weight: 600;
    line-height: 1.05;
    margin-bottom: 28px;
}

.ready-content p {
    font-size: 16px;
    line-height: 1.5;
    color: rgba(255, 255, 255, .92);
    margin-bottom: 70px;
}

.ready-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 15px 42px;
    border-radius: 999px;
    background: #fff;
    color: #111;
    text-decoration: none;
    font-size: 16px;
    font-weight: 700;
    transition: .3s ease;
}

.ready-btn:hover {
    background: #173A8D;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(23, 58, 141, .35);
}

/* Dark Mode */
:global(.dark) .ready-overlay {
    background: rgba(0, 0, 0, 0.7);
}

:global(.dark) .ready-content h2 {
    color: #ffffff;
}

:global(.dark) .ready-content p {
    color: #d1d5db;
}

:global(.dark) .ready-btn {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .ready-btn:hover {
    background: #2a5ae8;
    box-shadow: 0 15px 35px rgba(31, 71, 216, 0.4);
}

@media (max-width: 992px) {
    .ready-section { height: 420px; }
    .ready-content { margin: 0 40px; }
    .ready-content h2 { font-size: 56px; }
    .ready-content p { font-size: 20px; margin-bottom: 45px; }
}

@media (max-width: 768px) {
    .ready-section {
        height: 380px;
        justify-content: center;
        text-align: center;
    }
    .ready-content { margin: 0 25px; }
    .ready-content h2 { font-size: 42px; }
    .ready-content p { font-size: 18px; }
    .ready-btn {
        width: 100%;
        max-width: 280px;
        font-size: 20px;
    }
}
</style>