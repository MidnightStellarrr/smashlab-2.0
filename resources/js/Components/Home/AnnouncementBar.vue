<template>
    <section class="announcement-bar">
        <div class="announcement-track">
            <div class="announcement-content">
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
            </div>
            <!-- Duplicate for seamless looping -->
            <div class="announcement-content">
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
                <span class="dot"></span>
                <span>Level up your game</span>
            </div>
        </div>
    </section>
</template>

<style scoped>
.announcement-bar {
    width: 100%;
    height: 52px;
    background: #173a8d;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.announcement-track {
    display: flex;
    width: max-content;
    animation: scrollRight 18s linear infinite;
}

.announcement-content {
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.announcement-content span {
    color: #fff;
    font-size: 16px;
    font-weight: 600;
}

.dot {
    width: 10px;
    height: 10px;
    background: #fff;
    border-radius: 50%;
    margin: 0 18px;
    display: inline-block;
}

.announcement-content span:not(.dot) {
    margin-right: 70px;
}

@keyframes scrollRight {
    from { transform: translateX(-50%); }
    to { transform: translateX(0); }
}

:global(.dark) .announcement-bar {
    background: #1a2a4a;
}

:global(.dark) .announcement-content span {
    color: #d1d5db;
}

:global(.dark) .dot {
    background: #4a7a9c;
}
</style>