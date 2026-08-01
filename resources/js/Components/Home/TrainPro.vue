<template>
    <section class="train-pro">
        <div class="section-heading">
            <h2>Train Like a Pro</h2>
            <p>
                Book your spot and start training with Smash Lab's certified coaches
                today.
            </p>
        </div>

        <div class="train-cards">
            <!-- Beginner Card -->
            <div class="train-card beginner-card">
                <div class="train-card-img"></div>
                <div class="train-card-body">
                    <div>
                        <h3>Beginner Class.</h3>
                        <p>
                            Perfect for first-timers. Learn basic
                            strokes, footwork, and game rules
                            in a supportive group setting.
                        </p>
                    </div>
                    <Link href="/classes/beginner_class" class="learn-more-btn">
                        Learn More <i class="fa-solid fa-arrow-right"></i>
                    </Link>
                </div>
            </div>

            <!-- Intermediate Card -->
            <div class="train-card intermediate-card">
                <div class="train-card-img"></div>
                <div class="train-card-body">
                    <div>
                        <h3>Intermediate Class.</h3>
                        <p>
                            Refine your techniques and learn
                            smarter plays. Perfect for players
                            ready to compete.
                        </p>
                    </div>
                    <Link href="/classes/intermediate_class" class="learn-more-btn">
                        Learn More <i class="fa-solid fa-arrow-right"></i>
                    </Link>
                </div>
            </div>

            <!-- Advanced Card -->
            <div class="train-card advanced-card">
                <div class="train-card-img"></div>
                <div class="train-card-body">
                    <div>
                        <h3>Advanced Class.</h3>
                        <p>
                            Train like a champion. Master the
                            techniques and tactics used by
                            professional players.
                        </p>
                    </div>
                    <Link href="/classes/advanced_class" class="learn-more-btn">
                        Learn More <i class="fa-solid fa-arrow-right"></i>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.train-pro {
    width: 100%;
    padding: 100px 90px 110px;
    background: #fff;
    text-align: center;
}

.train-pro .section-heading h2 {
    font-size: 58px;
    font-weight: 800;
    color: #000;
    margin-bottom: 14px;
}

.train-pro .section-heading p {
    font-size: 18px;
    color: #555;
    max-width: 560px;
    margin: 0 auto 60px;
    line-height: 1.5;
}

.train-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    max-width: 1500px;
    margin: 0 auto;
}

.train-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    text-align: left;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.train-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.train-card-img {
    position: relative;
    width: 100%;
    height: 300px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
}

.train-card-img::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(128, 128, 128, 0.6);
    transition: opacity 0.4s ease;
    z-index: 1;
}

.train-card:hover .train-card-img::after {
    opacity: 0;
}

.train-card-img {
    filter: blur(0px);
    transition: filter 0.4s ease;
}

.train-card:hover .train-card-img {
    filter: blur(0px);
}

.beginner-card .train-card-img {
    background-image: url("/images/beginner_class.jpg");
}

.intermediate-card .train-card-img {
    background-image: url("/images/intermediate_class.jpg");
}

.advanced-card .train-card-img {
    background-image: url("/images/advance_class.jpg");
}

.train-card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 28px 30px 32px;
}

.train-card-body h3 {
    font-size: 28px;
    font-weight: 700;
    color: #000;
    margin-bottom: 12px;
}

.train-card-body p {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
    max-width: 320px;
}

.learn-more-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: fit-content;
    padding: 14px 26px;
    margin-top: 26px;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 40px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.learn-more-btn i {
    font-size: 13px;
}

.learn-more-btn:hover {
    background: #1f47d8;
}

.learn-more-btn:active {
    transform: scale(0.95);
}

/* Dark Mode */
:global(.dark) .train-pro {
    background: #0a1628;
}

:global(.dark) .train-pro .section-heading h2 {
    color: #ffffff;
}

:global(.dark) .train-pro .section-heading p {
    color: #9ca3af;
}

:global(.dark) .train-card {
    background: #1a2a4a;
}

:global(.dark) .train-card-body h3 {
    color: #ffffff;
}

:global(.dark) .train-card-body p {
    color: #9ca3af;
}

:global(.dark) .learn-more-btn {
    background: #1f47d8;
}

:global(.dark) .learn-more-btn:hover {
    background: #2a5ae8;
}

@media (max-width: 1200px) {
    .train-pro { padding: 80px 40px 90px; }
    .train-pro .section-heading h2 { font-size: 44px; }
    .train-card-img { height: 260px; }
}

@media (max-width: 900px) {
    .train-cards { grid-template-columns: 1fr; }
    .train-pro .section-heading h2 { font-size: 36px; }
    .train-pro .section-heading p { font-size: 16px; }
    .train-card-img { height: 280px; }
}

@media (max-width: 480px) {
    .train-pro { padding: 60px 20px 70px; }
    .train-pro .section-heading h2 { font-size: 28px; }
    .train-card-body { padding: 22px 22px 26px; }
    .train-card-body h3 { font-size: 22px; }
    .learn-more-btn { padding: 12px 20px; font-size: 14px; }
}
</style>