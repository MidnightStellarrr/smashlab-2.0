<template>
    <footer class="footer">
        <div class="footer-container">
            <!-- LEFT -->
            <div class="footer-brand">
                <h2>Smash Lab</h2>
                <p>
                    Welcome to Smash Lab — where you
                    can play badminton, hit the gym,
                    or do both.
                </p>

                <div class="footer-socials">
                    <a href="https://www.tiktok.com/@smashlab" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://www.facebook.com/smashlab" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/smashlab" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                </div>

                <div class="footer-contact">
                    <p>smashlab@gmail.com</p>
                    <p>097361274809</p>
                    <p>
                        BARANGAY, Quezon St,
                        New Pandan, Panabo, 8105
                        Davao del Norte
                    </p>
                </div>
            </div>

            <!-- MAIN -->
            <div class="footer-links">
                <h4>MAIN</h4>
                <ul>
                    <li><Link href="/">Home</Link></li>
                    <li><Link href="/book_now">Book now</Link></li>
                    <li><Link href="/classes">Classes</Link></li>
                    <li><Link href="/shop">Shop</Link></li>
                    <li><Link href="/about_us">About Us</Link></li>
                </ul>
            </div>

            <!-- SUPPORT -->
            <div class="footer-links">
                <h4>SUPPORT</h4>
                <ul>
                    <li><Link href="/contact">Contact</Link></li>
                    <li><Link href="/services">FAQ</Link></li>
                </ul>
            </div>

            <!-- RIGHT -->
            <div class="footer-newsletter">
                <input type="email" placeholder="Enter e-mail address" />

                <div class="footer-buttons">
                    <Link href="/login" class="footer-login">Login</Link>
                    <Link href="/register" class="footer-signup">Sign Up</Link>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            © 2026 SmashHIT Badminton Facility — Move your way.
        </div>
    </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.footer {
    background: linear-gradient(135deg, #2450ff 0%, #0c1d73 45%, #030d3f 100%);
    color: #fff;
    padding: 90px 8% 30px;
}

.footer-container {
    max-width: 1400px;
    margin: auto;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.6fr;
    gap: 80px;
}

.footer-brand h2 {
    font-size: 60px;
    font-weight: 650;
    margin-bottom: 20px;
}

.footer-brand p {
    font-size: 16px;
    line-height: 1.45;
    color: rgba(255, 255, 255, .9);
}

.footer-socials {
    display: flex;
    gap: 24px;
    margin: 40px 0;
}

.footer-socials a {
    color: #fff;
    font-size: 20px;
    transition: .3s;
}

.footer-socials a:hover {
    transform: translateY(-4px);
}

.footer-contact {
    margin-top: 90px;
}

.footer-contact p {
    font-size: 16px;
    margin-bottom: 18px;
    line-height: 1.5;
}

.footer-links {
    margin-left: 50px;
}

.footer-links h4 {
    padding-top: 13%;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 35px;
}

.footer-links ul {
    list-style: none;
}

.footer-links li {
    margin-bottom: 24px;
}

.footer-links a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    transition: .3s;
}

.footer-links a:hover {
    opacity: .75;
}

.footer-newsletter {
    display: flex;
    flex-direction: column;
}

.footer-newsletter input {
    background: transparent;
    border: none;
    border-bottom: 2px solid rgba(255, 255, 255, .6);
    padding: 12px 0;
    color: #fff;
    font-size: 16px;
    outline: none;
}

.footer-newsletter input::placeholder {
    color: #fff;
    opacity: .8;
}

.footer-buttons {
    margin-top: 45px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 30px;
}

.footer-login {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
}

.footer-signup {
    background: #fff;
    color: #111;
    padding: 10px 40px;
    border-radius: 999px;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: .3s;
}

.footer-signup:hover {
    background: #173A8D;
    color: #fff;
}

.footer-bottom {
    margin-top: 70px;
    text-align: center;
    font-size: 16px;
    color: rgba(255, 255, 255, .85);
}

@media (max-width: 1100px) {
    .footer-container {
        grid-template-columns: 1fr 1fr;
        gap: 60px;
    }
}

@media (max-width: 768px) {
    .footer {
        padding: 70px 30px;
    }
    .footer-container {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    .footer-brand h2 { font-size: 48px; }
    .footer-contact { margin-top: 40px; }
    .footer-buttons { justify-content: flex-start; }
}
</style>