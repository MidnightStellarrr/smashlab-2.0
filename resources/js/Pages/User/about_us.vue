<template>
    <div class="about-page">
        <!-- Navbar -->
        <Navbar />

        <!-- Hero Section -->
        <Hero 
            main-heading="About Us"
            sub-heading="Where passion meets the court — and every player finds their game."
            bg-image="/images/hero_bg.jpg"
            height="590px"
            :centered="true"
        />

        <!-- ========================================
                SECTION 2: OUR STORY
        ======================================== -->

        <section class="our-story">
            <div class="story-container">
                <!-- Left Side -->
                <div class="story-side">
                    <p>About us.</p>
                    <p>Our Team.</p>
                    <p>Values.</p>
                </div>

                <!-- Right Side -->
                <div class="story-content">
                    <h2>Our Story.</h2>

                    <p>
                        SmashHIT started with a simple observation:
                        booking a badminton court was harder than it
                        needed to be. Players had to call ahead hoping
                        a slot was available or show up only to find
                        all courts taken. Gym-goers faced the same
                        frustration — expensive memberships, long
                        contracts, and confusing policies.
                        We knew there had to be a better way.

                        So we built SmashHIT: a facility where you
                        can book a court in under a minute, pay
                        online, and just show up to play.
                        No phone calls. No guesswork. No hassle.
                    </p>

                    <br>

                    <p>
                        Today SmashHIT has grown into more than just
                        a badminton facility. We now offer a fully-equipped
                        gym designed for all skill levels and regular
                        tournaments for players who want to compete.

                        Our core belief hasn't changed:
                        fitness should be simple, affordable,
                        and built around you.

                        Whether you're booking your first court
                        or your hundredth, we're here to make every
                        experience smooth from start to finish.

                        That's our promise.

                        That's SmashHIT.
                    </p>
                </div>
            </div>
        </section>

        <!-- ========================================
                SECTION 3: MISSION & VISION
        ======================================== -->

        <section class="mission-vision">
            <!-- MISSION ROW -->
            <div class="mission-row">
                <div class="mission-text">
                    <h2>Our Mission</h2>
                    <p>
                        Our mission is to make fitness simple,
                        affordable, and accessible for everyone.
                        We remove the barriers that keep people from
                        staying active—no hidden fees, no complicated
                        booking systems, and no long-term contracts.

                        Every service we offer is built around giving
                        our members the freedom to exercise on their
                        schedule while creating a welcoming environment
                        where everyone feels encouraged to grow.

                        Because staying active should never feel like
                        a chore or a financial burden.
                    </p>
                </div>

                <div class="mission-image">
                    <img src="/images/about_us_mission.jpg" alt="Our Mission">
                </div>
            </div>

            <!-- VISION ROW -->
            <div class="vision-row">
                <div class="vision-image">
                    <img src="/images/about_us_vision.jpg" alt="Our Vision">
                </div>

                <div class="vision-text">
                    <h2>Our Vision</h2>
                    <p>
                        Our vision is to become the leading destination
                        for badminton and fitness where players of every
                        age and skill level feel welcomed, inspired, and
                        empowered.

                        We strive to build a community where beginners
                        find confidence, experienced players continue to
                        improve, and every member enjoys a modern facility
                        designed to make fitness and recreation part of
                        everyday life.
                    </p>
                </div>
            </div>
        </section>

        <!-- ========================================
                SECTION 4: STATISTICS
        ======================================== -->

        <section class="stats-section">
            <div class="stats-container">
                <div class="stat-item">
                    <h3>500+</h3>
                    <p>Active Members</p>
                </div>

                <div class="stat-item">
                    <h3>10</h3>
                    <p>Pro Coaches</p>
                </div>

                <div class="stat-item">
                    <h3>2,000+</h3>
                    <p>Monthly Bookings</p>
                </div>

                <div class="stat-item">
                    <h3>4.5</h3>
                    <p>Avg. Rating</p>
                </div>
            </div>
        </section>

        <!-- ========================================
                SECTION 5: OUR FACILITIES
        ======================================== -->

        <section class="facilities-section">
            <div class="facilities-header">
                <h2>Our Facilities</h2>
                <p>Premium courts designed for the perfect game every time.</p>
            </div>

            <div class="facilities-grid">
                <!-- Left Large -->
                <div class="facility-card large image-card">
                    <img src="/images/badminton_courts.jpg" alt="Court">
                    <div class="overlay"></div>
                    <div class="facility-content white">
                        <h3>4 Premium Courts</h3>
                        <p>Tournament-grade dimensions</p>
                    </div>
                </div>

                <!-- Small Top -->
                <div class="facility-card text-card">
                    <h3>Premium Flooring</h3>
                    <p>
                        Professional-grade rubber mats for
                        optimal grip and safety.
                    </p>
                </div>

                <!-- Middle Large -->
                <div class="facility-card tall text-card center">
                    <h3>LED Lighting</h3>
                    <p>
                        LED lighting with no glare and no
                        shadows — just clear visibility
                        for every shot.
                    </p>
                </div>

                <!-- Top Right -->
                <div class="facility-card image-card">
                    <img src="/images/locker.jpg" alt="Locker">
                    <div class="overlay"></div>
                    <div class="facility-content white">
                        <h3>Shower & Locker Rooms</h3>
                        <p>Freshen up after your games in our amenities.</p>
                    </div>
                </div>

                <!-- Bottom Left -->
                <div class="facility-card image-card">
                    <img src="/images/Climate-Controlled.jpg" alt="AC">
                    <div class="overlay"></div>
                    <div class="facility-content white">
                        <h3>Climate-Controlled</h3>
                        <p>Fully air-conditioned for your comfort.</p>
                    </div>
                </div>

                <!-- Bottom Right -->
                <div class="facility-card text-card">
                    <h3>Snacks & Drinks</h3>
                    <p>
                        Grab a drink or a snack at our shop.
                    </p>
                </div>
            </div>
        </section>

        <!-- ========================================
                SECTION 6: WHAT WE OFFER
        ======================================== -->

        <section class="what-we-offer">
            <div class="owo-top">
                <div class="owo-left">
                    <span class="owo-badge">What We Offer</span>
                    <h2>THE SMASH LAB <br> EXPERIENCE</h2>
                </div>

                <div class="owo-right">
                    <p>
                        Everything you need for the perfect game. From
                        finding an open court to renting a racket and grabbing
                        a drink. We handle it all.
                    </p>

                    <Link to="/services" class="owo-arrow-btn">
                        <i class="fa-solid fa-arrow-right"></i>
                    </Link>
                </div>
            </div>

            <div class="offer-cards">
                <div class="offer-card court-card">
                    <div class="card-overlay blue-overlay"></div>
                    <div class="card-content">
                        <h3>Premium Courts</h3>
                        <p>
                            Well-maintained courts with professional
                            flooring, tournament-grade dimensions,
                            premium lighting, and real-time online
                            booking for a seamless playing experience.
                        </p>
                    </div>
                </div>

                <div class="offer-card class-card">
                    <div class="card-overlay grey-overlay"></div>
                    <div class="card-content bottom">
                        <h3>Pro Classes</h3>
                        <p>
                            Learn from certified coaches — beginners to
                            advanced.
                        </p>
                    </div>
                </div>

                <div class="offer-card gear-card">
                    <div class="card-overlay grey-overlay"></div>
                    <div class="card-content bottom">
                        <h3>Gears and Snacks</h3>
                        <p>
                            Gears and snacks available for purchase.
                        </p>
                    </div>
                </div>

                <div class="offer-card booking-card">
                    <div class="card-overlay grey-overlay"></div>
                    <div class="card-content bottom">
                        <h3>Smart Booking</h3>
                        <p>
                            Book, manage, and track everything from
                            your dashboard.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================
                SECTION 7: TRAIN LIKE A PRO
        ======================================== -->

        <section class="train-pro">
            <div class="section-heading">
                <h2>Train Like a Pro</h2>
                <p>
                    Book your spot and start training with Smash Lab's certified coaches
                    today.
                </p>
            </div>

            <div class="train-cards">
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

                        <Link to="/classes/beginner_class" class="learn-more-btn">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </Link>
                    </div>
                </div>

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

                        <Link to="/classes/intermediate_class" class="learn-more-btn">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </Link>
                    </div>
                </div>

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

                        <Link to="/classes/advanced_class" class="learn-more-btn">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================
                SECTION 8: CTA - READY TO PLAY
        ======================================== -->

        <section class="cta-section">
            <div class="cta-overlay"></div>

            <div class="cta-content">
                <h2>Ready to Smash?</h2>

                <p>
                    Join thousands of players who book, train, <br>and
                    play at Smash Lab.
                </p>

                <Link to="/book_now" class="cta-btn">
                    Get Started Now
                </Link>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Home/Navbar.vue';
import Hero from '@/Components/Home/HeroSection.vue';
import Footer from '@/Components/Home/Footer.vue';
</script>

<style scoped>
/* ========================================
    OUR STORY
======================================== */

.our-story {
    padding: 80px 8% 100px;
    background: #fff;
}

.story-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 200px 1fr;
    gap: 60px;
}

.story-side {
    margin-top: 90px;
}

.story-side p{
    color: #192e5d;
    font-weight: 700;
    font-size: 18px;
}

.story-content h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 20px;
}

.story-content p {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
}

/* ========================================
    MISSION & VISION
======================================== */

.mission-vision {
    padding: 80px 8% 100px;
    background: #f5f6f8;
}

.mission-row,
.vision-row {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.mission-row {
    margin-bottom: 80px;
}

.mission-text h2,
.vision-text h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 20px;
}

.mission-text p,
.vision-text p {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
}

.mission-image img,
.vision-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 20px;
}

/* ========================================
    STATISTICS
======================================== */

.stats-section {
    padding: 80px 8%;
    background: #173A8D;
}

.stats-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    text-align: center;
}

.stat-item h3 {
    font-size: 48px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 8px;
}

.stat-item p {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
}

/* ========================================
    FACILITIES
======================================== */

.facilities-section {
    padding: 80px 8% 100px;
    background: #fff;
}

.facilities-header {
    text-align: center;
    margin-bottom: 50px;
}

.facilities-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 8px;
}

.facilities-header p {
    font-size: 18px;
    color: #666;
}

.facilities-grid {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    grid-template-rows: auto auto;
    gap: 20px;
}

.facility-card {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    min-height: 200px;
}

.facility-card.large {
    grid-row: span 2;
}

.facility-card.tall {
    grid-row: span 2;
}

.facility-card.image-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    inset: 0;
}

.facility-card .overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.facility-content {
    position: relative;
    z-index: 2;
    padding: 30px;
    color: #fff;
}

.facility-content h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 8px;
}

.facility-content p {
    font-size: 14px;
    opacity: 0.9;
}

.facility-card.text-card {
    background: #f5f6f8;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.facility-card.text-card h3 {
    font-size: 20px;
    font-weight: 700;
    color: #111;
    margin-bottom: 8px;
}

.facility-card.text-card p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}

.facility-card.center {
    text-align: center;
    align-items: center;
}

/* ========================================
    WHAT WE OFFER
======================================== */

.what-we-offer {
    padding: 80px 8% 100px;
    background: #f5f6f8;
}

.owo-top {
    max-width: 1400px;
    margin: 0 auto 50px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: end;
}

.owo-badge {
    display: inline-block;
    padding: 6px 20px;
    border-radius: 40px;
    background: #173A8D;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 16px;
}

.owo-left h2 {
    font-size: 48px;
    font-weight: 800;
    color: #111;
    line-height: 1.1;
}

.owo-right p {
    font-size: 16px;
    color: #666;
    line-height: 1.7;
    margin-bottom: 20px;
}

.owo-arrow-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #173A8D;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.owo-arrow-btn:hover {
    background: #0f2a6b;
    transform: translateX(4px);
}

.offer-cards {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 20px;
}

.offer-card {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    min-height: 280px;
}

.offer-card .card-overlay {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.offer-card .blue-overlay {
    background: linear-gradient(135deg, #173A8D 0%, #1f47d8 100%);
}

.offer-card .grey-overlay {
    background: #2a3a5a;
}

.offer-card .card-content {
    position: relative;
    z-index: 2;
    padding: 30px;
    color: #fff;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.offer-card .card-content.bottom {
    justify-content: flex-end;
    padding-bottom: 40px;
}

.offer-card .card-content h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 8px;
}

.offer-card .card-content p {
    font-size: 14px;
    opacity: 0.9;
    line-height: 1.6;
}

/* ========================================
    TRAIN LIKE A PRO
======================================== */

.train-pro {
    padding: 80px 8% 100px;
    background: #fff;
}

.section-heading {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 50px;
}

.section-heading h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 12px;
}

.section-heading p {
    font-size: 18px;
    color: #666;
}

.train-cards {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.train-card {
    background: #f5f6f8;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.train-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
}

.train-card-img {
    height: 200px;
    background-size: cover;
    background-position: center;
}

.beginner-card .train-card-img {
    background-image: url('/images/beginner_class.jpg');
}

.intermediate-card .train-card-img {
    background-image: url('/images/intermediate_class.jpg');
}

.advanced-card .train-card-img {
    background-image: url('/images/advanced_class.jpg');
}

.train-card-body {
    padding: 24px 28px 28px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 200px;
}

.train-card-body h3 {
    font-size: 22px;
    font-weight: 700;
    color: #111;
    margin-bottom: 8px;
}

.train-card-body p {
    font-size: 15px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 16px;
}

.learn-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #173A8D;
    font-weight: 600;
    text-decoration: none;
    font-size: 15px;
    transition: all 0.3s ease;
}

.learn-more-btn:hover {
    gap: 16px;
}

.learn-more-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.learn-more-btn:hover i {
    transform: translateX(4px);
}

/* ========================================
    CTA SECTION
======================================== */

.cta-section {
    position: relative;
    width: 100%;
    height: 400px;
    background: url('/images/ready_to_play.jpg') center center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.cta-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
}

.cta-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: #fff;
    max-width: 700px;
    padding: 0 20px;
}

.cta-content h2 {
    font-size: 56px;
    font-weight: 700;
    margin-bottom: 16px;
}

.cta-content p {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
    line-height: 1.6;
}

.cta-btn {
    display: inline-block;
    padding: 16px 48px;
    border-radius: 999px;
    background: #fff;
    color: #111;
    text-decoration: none;
    font-size: 16px;
    font-weight: 700;
    transition: all 0.3s ease;
}

.cta-btn:hover {
    background: #173A8D;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(23, 58, 141, 0.35);
}

/* ========================================
    DARK MODE
======================================== */

:global(.dark) .our-story {
    background: #0a1628;
}

:global(.dark) .story-content h2 {
    color: #ffffff;
}

:global(.dark) .story-content p {
    color: #9ca3af;
}

:global(.dark) .story-side p:nth-child(1) {
    color: #4a7a9c;
}

:global(.dark) .story-side p:nth-child(2),
:global(.dark) .story-side p:nth-child(3) {
    color: #6b7280;
}

:global(.dark) .mission-vision {
    background: #0a1628;
}

:global(.dark) .mission-text h2,
:global(.dark) .vision-text h2 {
    color: #ffffff;
}

:global(.dark) .mission-text p,
:global(.dark) .vision-text p {
    color: #9ca3af;
}

:global(.dark) .facilities-section {
    background: #0a1628;
}

:global(.dark) .facilities-header h2 {
    color: #ffffff;
}

:global(.dark) .facilities-header p {
    color: #9ca3af;
}

:global(.dark) .facility-card.text-card {
    background: #1a2a4a;
}

:global(.dark) .facility-card.text-card h3 {
    color: #ffffff;
}

:global(.dark) .facility-card.text-card p {
    color: #9ca3af;
}

:global(.dark) .what-we-offer {
    background: #0a1628;
}

:global(.dark) .owo-left h2 {
    color: #ffffff;
}

:global(.dark) .owo-right p {
    color: #9ca3af;
}

:global(.dark) .train-pro {
    background: #0a1628;
}

:global(.dark) .section-heading h2 {
    color: #ffffff;
}

:global(.dark) .section-heading p {
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
    color: #4a7a9c;
}

:global(.dark) .stats-section {
    background: #1a2a4a;
}

:global(.dark) .cta-overlay {
    background: rgba(0, 0, 0, 0.7);
}

:global(.dark) .cta-btn {
    background: #1f47d8;
    color: #fff;
}

:global(.dark) .cta-btn:hover {
    background: #2a5ae8;
}

:global(.dark) .owo-arrow-btn {
    background: #1f47d8;
}

:global(.dark) .owo-arrow-btn:hover {
    background: #2a5ae8;
}

/* ========================================
    RESPONSIVE
======================================== */

@media (max-width: 992px) {
    .story-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .story-side {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .story-side p:nth-child(1) {
        font-size: 28px;
    }

    .mission-row,
    .vision-row {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .mission-row {
        margin-bottom: 50px;
    }

    .mission-image img,
    .vision-image img {
        height: 300px;
    }

    .facilities-grid {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }

    .facility-card.large {
        grid-row: span 1;
    }

    .facility-card.tall {
        grid-row: span 1;
    }

    .offer-cards {
        grid-template-columns: 1fr;
    }

    .train-cards {
        grid-template-columns: 1fr;
    }

    .owo-top {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .stats-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .our-story {
        padding: 60px 5%;
    }

    .mission-vision {
        padding: 60px 5%;
    }

    .stats-section {
        padding: 60px 5%;
    }

    .facilities-section {
        padding: 60px 5%;
    }

    .what-we-offer {
        padding: 60px 5%;
    }

    .train-pro {
        padding: 60px 5%;
    }

    .story-content h2,
    .mission-text h2,
    .vision-text h2,
    .facilities-header h2,
    .section-heading h2 {
        font-size: 32px;
    }

    .owo-left h2 {
        font-size: 36px;
    }

    .stats-container {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .stat-item h3 {
        font-size: 32px;
    }

    .cta-content h2 {
        font-size: 36px;
    }

    .cta-section {
        height: 350px;
    }
}

@media (max-width: 480px) {
    .stats-container {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .stat-item h3 {
        font-size: 28px;
    }

    .owo-left h2 {
        font-size: 28px;
    }

    .cta-content h2 {
        font-size: 28px;
    }

    .cta-content p {
        font-size: 15px;
    }

    .cta-btn {
        padding: 12px 32px;
        font-size: 14px;
    }
}
</style>