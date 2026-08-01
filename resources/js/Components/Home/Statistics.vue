<template>
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <h3>500+</h3>
                <p>Active Members</p>
            </div>

            <div class="stat-item">
                <h3>10</h3>
                <p>Certified Coaches</p>
            </div>

            <div class="stat-item">
                <h3>2,000+</h3>
                <p>Monthly Bookings</p>
            </div>

            <div class="stat-item">
                <h3>4.5</h3>
                <p>Avg. Rating From Happy Players</p>
            </div>
        </div>
    </section>
</template>

<style scoped>
.stats {
    width: 100%;
    background: #16327d;
    padding: 65px 90px;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    max-width: 1500px;
    margin: 0 auto;
}

.stat-item {
    position: relative;
    text-align: center;
    padding: 0 20px;
}

.stat-item:not(:first-child)::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 1px;
    height: 64px;
    background: rgba(255, 255, 255, 0.25);
}

.stat-item h3 {
    color: #fff;
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 12px;
}

.stat-item p {
    color: rgba(255, 255, 255, 0.85);
    font-size: 17px;
    font-weight: 400;
}

/* Dark Mode */
:global(.dark) .stats {
    background: #1a2a4a;
}

:global(.dark) .stat-item h3 {
    color: #ffffff;
}

:global(.dark) .stat-item p {
    color: #9ca3af;
}

:global(.dark) .stat-item:not(:first-child)::before {
    background: rgba(255, 255, 255, 0.15);
}

@media (max-width: 1200px) {
    .stats { padding: 55px 40px; }
    .stat-item h3 { font-size: 40px; }
}

@media (max-width: 900px) {
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
        row-gap: 40px;
    }
    .stat-item:nth-child(3)::before { display: none; }
}

@media (max-width: 480px) {
    .stats { padding: 45px 24px; }
    .stats-container { grid-template-columns: 1fr; row-gap: 32px; }
    .stat-item::before { display: none; }
    .stat-item h3 { font-size: 34px; }
    .stat-item p { font-size: 15px; }
}
</style>