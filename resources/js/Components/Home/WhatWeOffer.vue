<template>
    <section class="what-we-offer">
        <!-- Top Row: Heading + Description -->
        <div class="owo-top">
            <div class="owo-left">
                <span class="owo-badge">What We Offer</span>
                <h2>THE SMASH LAB <br /> EXPERIENCE</h2>
            </div>

            <div class="owo-right">
                <p>
                    Everything you need for the perfect game. From
                    finding an open court to renting a racket and grabbing
                    a drink. We handle it all.
                </p>
                <Link href="/services" class="owo-arrow-btn">
                    <i class="fa-solid fa-arrow-right"></i>
                </Link>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="offer-cards">
            <div class="offer-card court-card">
                <div class="card-overlay blue-overlay"></div>
                <div class="card-content">
                    <h3>Tournament-Grade Courts</h3>
                    <p>
                        Play on professional courts with premium
                        lighting and real-time booking.
                    </p>
                </div>
            </div>

            <div class="offer-card class-card">
                <div class="card-overlay grey-overlay"></div>
                <div class="card-content bottom">
                    <h3>Certified Pro Coaches</h3>
                    <p>
                        Learn from certified coaches — beginners to advanced.
                    </p>
                </div>
            </div>

            <div class="offer-card gear-card">
                <div class="card-overlay grey-overlay"></div>
                <div class="card-content bottom">
                    <h3>Gears and Snacks</h3>
                    <p>
                        From rackets to energy drinks, everything you need is here.
                    </p>
                </div>
            </div>

            <div class="offer-card booking-card">
                <div class="card-overlay grey-overlay"></div>
                <div class="card-content bottom">
                    <h3>Smart Booking</h3>
                    <p>
                        Book, manage, and track everything from your dashboard.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.what-we-offer {
    position: relative;
    width: 100%;
    padding: 50px 90px 60px;
    background: linear-gradient(135deg, #050814 0%, #0a1030 30%, #16327d 70%, #1f47d8 100%);
    overflow: hidden;
}

.owo-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 40px;
    margin-bottom: 50px;
}

.owo-left {
    max-width: 60%;
}

.owo-badge {
    display: inline-block;
    padding: 10px 26px;
    border: 1.5px solid rgba(255, 255, 255, 0.6);
    border-radius: 40px;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 26px;
}

.owo-left h2 {
    color: #fff;
    font-size: 65px;
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: 0.5px;
}

.owo-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 20px;
    max-width: 460px;
}

.owo-right p {
    color: rgba(255, 255, 255, 0.85);
    font-size: 16px;
    line-height: 1.6;
    text-align: right;
    margin: 0;
}

.owo-arrow-btn {
    flex-shrink: 0;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: 1.5px solid rgba(255, 255, 255, 0.6);
    background: transparent;
    color: #fff;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.owo-arrow-btn:hover {
    background: #fff;
    color: #16327d;
    transform: translateX(4px);
}

.offer-cards {
    display: grid;
    grid-template-columns: 2.3fr 1fr 1fr 1fr;
    gap: 28px;
    align-items: stretch;
}

.offer-card {
    position: relative;
    min-height: 500px;
    overflow: hidden;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.offer-card .card-overlay {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.offer-card .card-overlay.blue-overlay {
    background: rgba(31, 71, 216, 0.35);
}

.offer-card .card-overlay.grey-overlay {
    background: rgba(20, 20, 20, 0.45);
}

.offer-card .card-content {
    position: relative;
    z-index: 2;
    height: 100%;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    color: #fff;
}

.offer-card .card-content.bottom {
    justify-content: flex-end;
}

.offer-card .card-content h3 {
    font-size: 34px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 18px;
}

.offer-card .card-content p {
    font-size: 15px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
    max-width: 320px;
}

.court-card {
    background-image: url("/images/badminton_courts.jpg");
}

.class-card {
    background-image: url("/images/badminton_class.jpg");
}

.gear-card {
    background-image: url("/images/gear_and_shop.jpg");
}

.booking-card {
    background-image: url("/images/smart_booking.png");
}

/* Dark Mode */
:global(.dark) .what-we-offer {
    background: linear-gradient(135deg, #050814 0%, #0a1628 30%, #1a2a4a 70%, #1f47d8 100%);
}

@media (max-width: 1200px) {
    .what-we-offer { padding: 70px 40px 80px; }
    .owo-left h2 { font-size: 44px; }
    .offer-cards {
        grid-template-columns: 1.8fr 1fr 1fr 1fr;
        gap: 20px;
    }
    .offer-card { min-height: 420px; }
    .offer-card .card-content h3 { font-size: 26px; }
}

@media (max-width: 900px) {
    .owo-top {
        flex-direction: column;
        align-items: flex-start;
        gap: 24px;
    }
    .owo-left { max-width: 100%; }
    .owo-right {
        max-width: 100%;
        justify-content: space-between;
        width: 100%;
    }
    .owo-right p { text-align: left; }
    .offer-cards { grid-template-columns: 1fr 1fr; }
    .offer-card { min-height: 320px; }
}

@media (max-width: 600px) {
    .what-we-offer { padding: 60px 20px 60px; }
    .owo-left h2 { font-size: 32px; }
    .offer-cards { grid-template-columns: 1fr; }
    .offer-card { min-height: 280px; }
    .offer-card .card-content { padding: 28px; }
}
</style>