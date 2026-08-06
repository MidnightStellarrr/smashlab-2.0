<template>
    <div class="shop-page">
        <!-- Navbar -->
        <Navbar />

        <!-- Hero Section -->
        <Hero 
            main-heading="Shop"
            sub-heading="Gear up for your game — from rackets to snacks, we've got you covered."
            bg-image="/images/hero_bg.jpg"
            height="590px"
            :centered="true"
        />

        <!-- Shop Section -->
        <section class="shop-section">
            <div class="shop-container">

                <!-- Shop Controls -->
                <div class="shop-controls">
                    <!-- Search Bar -->
                    <div class="search-bar">
                        <i class="fa-solid fa-search"></i>
                        <input 
                            type="text" 
                            v-model="searchQuery"
                            placeholder="Search for products..."
                            @input="filterProducts"
                            aria-label="Search products"
                            aria-describedby="search-help"
                        >
                        <span id="search-help" class="sr-only">Type to filter products by name or description</span>
                    </div>

                    <!-- Categories -->
                    <div class="categories" role="tablist" aria-label="Product categories">
                        <button 
                            v-for="category in categories" 
                            :key="category.value"
                            class="category-btn" 
                            :class="{ active: activeCategory === category.value }"
                            @click="setCategory(category.value)"
                            role="tab"
                            :aria-selected="activeCategory === category.value"
                            :aria-label="`Filter by ${category.label}`"
                        >
                            {{ category.label }}
                        </button>
                    </div>

                    <!-- Sort -->
                    <div class="sort-container">
                        <label for="sortSelect">Sort by:</label>
                        <select 
                            id="sortSelect" 
                            v-model="sortBy" 
                            @change="sortProducts"
                            aria-label="Sort products"
                        >
                            <option v-for="option in sortOptions" :key="option.value" :value="option.value">
                                {{ option.label }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Loading State -->
                <div v-if="isLoading" class="loading-state">
                    <div class="loading-spinner"></div>
                    <p>Loading products...</p>
                </div>

                <!-- Products Grid -->
                <div v-else class="products-grid" id="productsGrid">
                    <!-- Sort Best Sellers first -->
                    <div 
                        v-for="product in sortedProducts" 
                        :key="product.id"
                        class="product-card"
                        :class="{ 'out-of-stock-card': !product.inStock }"
                        :aria-label="`${product.name} - ${product.inStock ? 'In stock' : 'Out of stock'}`"
                    >
                        <div class="product-image" :class="{ 'out-of-stock-image': !product.inStock }">
                            <img 
                                :src="product.image" 
                                :alt="product.name"
                                loading="lazy"
                                :aria-label="`Image of ${product.name}`"
                            >
                            <!-- Out of Stock Overlay -->
                            <div v-if="!product.inStock" class="out-of-stock-overlay">
                                <span class="out-of-stock-text">Out of Stock</span>
                            </div>
                            
                            <!-- Badges - Only show if in stock -->
                            <span v-if="product.inStock && product.badge" class="product-badge" :class="product.badgeClass">
                                {{ product.badge }}
                            </span>
                        </div>
                        <div class="product-info">
                            <h3>{{ product.name }}</h3>
                            <p>{{ product.description }}</p>
                            <div class="product-rating" :aria-label="`Rating: ${product.rating} out of 5 stars`">
                                <i 
                                    v-for="star in 5" 
                                    :key="star"
                                    class="fa-solid fa-star"
                                    :class="{ 
                                        'filled': star <= product.rating,
                                        'fa-regular': star > product.rating 
                                    }"
                                    :aria-hidden="true"
                                ></i>
                                <span>({{ product.reviews }} reviews)</span>
                            </div>
                            <div class="product-footer">
                                <span class="product-price">
                                    ₱{{ formatPrice(product.price) }}
                                    <span v-if="product.oldPrice" class="old-price">₱{{ formatPrice(product.oldPrice) }}</span>
                                </span>
                                <button 
                                    class="add-to-cart" 
                                    @click="addToCart(product, $event)"
                                    :disabled="!product.inStock || isLoading"
                                    :aria-label="`Add ${product.name} to cart${!product.inStock ? ' - Out of stock' : ''}`"
                                >
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- No Results Message -->
                <div v-if="!isLoading && filteredAndSortedProducts.length === 0" class="no-results">
                    <i class="fa-solid fa-search"></i>
                    <h3>No products found</h3>
                    <p>Try adjusting your search or filter.</p>
                </div>

                <!-- Error Message -->
                <div v-if="error" class="error-message">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <h3>Something went wrong</h3>
                    <p>{{ error }}</p>
                    <button @click="retryLoad" class="retry-btn">Try Again</button>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import Navbar from '@/Components/Home/Navbar.vue';
import Hero from '@/Components/Home/HeroSection.vue';
import Footer from '@/Components/Home/Footer.vue';

// ── State ──
const searchQuery = ref('');
const activeCategory = ref('all');
const sortBy = ref('popular');
const isLoading = ref(true);
const error = ref(null);

// ── Categories ──
const categories = [
    { value: 'all', label: 'All' },
    { value: 'gear', label: 'Gear' },
    { value: 'snacks', label: 'Snacks' },
    { value: 'drinks', label: 'Drinks' }
];

// ── Sort Options ──
const sortOptions = [
    { value: 'popular', label: 'Most Popular' },
    { value: 'price-low', label: 'Price: Low to High' },
    { value: 'price-high', label: 'Price: High to Low' },
    { value: 'name', label: 'Name A-Z' },
    { value: 'newest', label: 'Newest Arrivals' }
];

// ── Products Data with Stock Information ──
const products = ref([
    {
        id: 1,
        name: 'Premium Racket',
        description: 'Carbon-fiber frame. Lightweight and durable. Perfect for competitive play.',
        price: 150,
        oldPrice: 200,
        rating: 5,
        reviews: 24,
        category: 'gear',
        image: '/images/badminton_gear.jpg',
        badge: 'Best Seller',
        badgeClass: '',
        stock: 10,
        inStock: true,
        createdAt: '2024-01-15'
    },
    {
        id: 2,
        name: 'Shuttlecocks Tube',
        description: 'Tournament-grade shuttlecocks. Consistent flight and durability.',
        price: 80,
        oldPrice: null,
        rating: 4.5,
        reviews: 42,
        category: 'gear',
        image: '/images/badminton_gear.jpg',
        badge: 'Sale',
        badgeClass: 'sale',
        stock: 0,
        inStock: false,
        createdAt: '2024-02-01'
    },
    {
        id: 3,
        name: 'Sports Drink',
        description: 'Electrolyte-infused drink. Stay hydrated during your game.',
        price: 60,
        oldPrice: null,
        rating: 4,
        reviews: 18,
        category: 'drinks',
        image: '/images/badminton_gear.jpg',
        badge: null,
        badgeClass: '',
        stock: 25,
        inStock: true,
        createdAt: '2024-02-15'
    },
    {
        id: 4,
        name: 'Energy Bar',
        description: 'Protein-packed energy bar. Perfect for a quick boost.',
        price: 50,
        oldPrice: null,
        rating: 4,
        reviews: 31,
        category: 'snacks',
        image: '/images/badminton_gear.jpg',
        badge: 'New',
        badgeClass: 'new',
        stock: 15,
        inStock: true,
        createdAt: '2024-03-01'
    },
    {
        id: 5,
        name: 'Standard Racket',
        description: 'Durable aluminum racket. Great for casual games and practice.',
        price: 100,
        oldPrice: null,
        rating: 4,
        reviews: 56,
        category: 'gear',
        image: '/images/badminton_gear.jpg',
        badge: null,
        badgeClass: '',
        stock: 8,
        inStock: true,
        createdAt: '2024-01-20'
    },
    {
        id: 6,
        name: 'Water Bottle',
        description: 'Refreshing purified water. Stay hydrated on the court.',
        price: 30,
        oldPrice: null,
        rating: 4,
        reviews: 78,
        category: 'drinks',
        image: '/images/badminton_gear.jpg',
        badge: null,
        badgeClass: '',
        stock: 50,
        inStock: true,
        createdAt: '2024-02-10'
    },
    {
        id: 7,
        name: 'Grip Tape',
        description: 'Premium overgrip. Anti-slip for better control.',
        price: 45,
        oldPrice: 60,
        rating: 4,
        reviews: 63,
        category: 'gear',
        image: '/images/badminton_gear.jpg',
        badge: 'Sale',
        badgeClass: 'sale',
        stock: 3,
        inStock: true,
        createdAt: '2024-02-20'
    },
    {
        id: 8,
        name: 'Snack Pack',
        description: 'Assorted crackers and nuts. Perfect for sharing.',
        price: 120,
        oldPrice: null,
        rating: 5,
        reviews: 27,
        category: 'snacks',
        image: '/images/badminton_gear.jpg',
        badge: 'New',
        badgeClass: 'new',
        stock: 12,
        inStock: true,
        createdAt: '2024-03-05'
    },
    {
        id: 9,
        name: 'Pro Series Racket',
        description: 'Tournament-grade racket with premium grip and power.',
        price: 250,
        oldPrice: null,
        rating: 5,
        reviews: 19,
        category: 'gear',
        image: '/images/badminton_gear.jpg',
        badge: 'Best Seller',
        badgeClass: '',
        stock: 5,
        inStock: true,
        createdAt: '2024-01-10'
    }
]);

// ── Format Price Helper ──
const formatPrice = (price) => {
    return price.toLocaleString();
};

// ── Computed ──
const filteredAndSortedProducts = computed(() => {
    let result = [...products.value];

    // Filter by category
    if (activeCategory.value !== 'all') {
        result = result.filter(p => p.category === activeCategory.value);
    }

    // Filter by search
    if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase().trim();
        result = result.filter(p => 
            p.name.toLowerCase().includes(query) || 
            p.description.toLowerCase().includes(query)
        );
    }

    // Sort
    switch (sortBy.value) {
        case 'price-low':
            result.sort((a, b) => a.price - b.price);
            break;
        case 'price-high':
            result.sort((a, b) => b.price - a.price);
            break;
        case 'name':
            result.sort((a, b) => a.name.localeCompare(b.name));
            break;
        case 'popular':
            result.sort((a, b) => b.reviews - a.reviews);
            break;
        case 'newest':
            result.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
            break;
        default:
            break;
    }

    return result;
});

// ── Sorted Products (Best Sellers first) ──
const sortedProducts = computed(() => {
    const filtered = filteredAndSortedProducts.value;
    
    // Sort: Best Sellers first, then by rating
    return filtered.sort((a, b) => {
        // If both have Best Seller badge or both don't
        const aIsBestSeller = a.badge === 'Best Seller';
        const bIsBestSeller = b.badge === 'Best Seller';
        
        if (aIsBestSeller && !bIsBestSeller) return -1;
        if (!aIsBestSeller && bIsBestSeller) return 1;
        
        // If both are Best Sellers or both are not, sort by rating
        return b.rating - a.rating;
    });
});

// ── Methods ──
const filterProducts = () => {
    // Computed property handles this automatically
};

const setCategory = (category) => {
    activeCategory.value = category;
};

const sortProducts = () => {
    // Computed property handles this automatically
};

const addToCart = async (product, event) => {
    try {
        // Check stock
        if (!product.inStock || product.stock === 0) {
            error.value = `${product.name} is out of stock!`;
            setTimeout(() => error.value = null, 3000);
            return;
        }

        // Simulate API call
        isLoading.value = true;
        
        // Simulate network delay
        await new Promise(resolve => setTimeout(resolve, 500));

        // Show feedback on button
        const btn = event.currentTarget;
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        btn.style.background = '#22c55e';

        // Log success
        console.log('Added to cart:', product.name);

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.style.background = '';
            isLoading.value = false;
        }, 1500);

        // Here you would call your cart store
        // cartStore.addItem(product);
        
    } catch (err) {
        error.value = `Failed to add ${product.name} to cart. Please try again.`;
        console.error('Add to cart error:', err);
        isLoading.value = false;
        setTimeout(() => error.value = null, 5000);
    }
};

const retryLoad = () => {
    loadProducts();
};

// ── Load Products ──
const loadProducts = async () => {
    try {
        isLoading.value = true;
        error.value = null;
        
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Products are already loaded in ref
        isLoading.value = false;
        
    } catch (err) {
        error.value = 'Failed to load products. Please try again.';
        console.error('Load products error:', err);
        isLoading.value = false;
    }
};

// ── Lifecycle ──
onMounted(() => {
    loadProducts();
});
</script>

<style scoped>

/*======================================
        SHOP SECTION
======================================*/

.shop-section {
    padding: 60px 8% 100px;
    background: #fff;
}

.shop-container {
    max-width: 1400px;
    margin: 0 auto;
}

/*======================================
        SHOP CONTROLS
======================================*/

.shop-controls {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
    margin-bottom: 40px;
    padding: 20px;
    background: #f5f6f8;
    border-radius: 16px;
}

/* ── Search Bar ── */

.search-bar {
    flex: 1;
    min-width: 200px;
    display: flex;
    align-items: center;
    background: #fff;
    border-radius: 40px;
    padding: 0 18px;
    border: 2px solid #e8e8e8;
    transition: border-color 0.3s ease;
}

.search-bar:focus-within {
    border-color: #173A8D;
}

.search-bar i {
    color: #888;
    font-size: 16px;
    margin-right: 12px;
}

.search-bar input {
    flex: 1;
    border: none;
    padding: 12px 0;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    outline: none;
    background: transparent;
}

.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}

/* ── Categories ── */

.categories {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.category-btn {
    padding: 8px 22px;
    border: 2px solid #e0e0e0;
    border-radius: 40px;
    background: #fff;
    color: #555;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.category-btn:hover {
    border-color: #173A8D;
    color: #173A8D;
}

.category-btn.active {
    background: #173A8D;
    border-color: #173A8D;
    color: #fff;
}

/* ── Sort ── */

.sort-container {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: auto;
}

.sort-container label {
    font-size: 14px;
    font-weight: 500;
    color: #555;
    white-space: nowrap;
}

.sort-container select {
    padding: 10px 17px 10px 16px; /* Increased right padding for arrow space */
    border: 2px solid #e0e0e0;
    border-radius: 40px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    background: #fff;
    outline: none;
    cursor: pointer;
    transition: border-color 0.3s ease;
    appearance: auto;
    -webkit-appearance: auto;
    -moz-appearance: auto;
    min-width: 150px;
}

.sort-container select:focus {
    border-color: #173A8D;
}

.sort-container select option {
    padding: 8px 16px;
}

/*======================================
        LOADING STATE
======================================*/

.loading-state {
    text-align: center;
    padding: 60px 20px;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 4px solid #e8eaed;
    border-top-color: #173A8D;
    border-radius: 50%;
    margin: 0 auto 16px;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.loading-state p {
    color: #666;
    font-size: 16px;
}

/*======================================
        PRODUCTS GRID
======================================*/

.products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
}

/*======================================
        PRODUCT CARD
======================================*/

.product-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.4s ease;
    border: 1px solid #f0f0f0;
}

.product-card:hover:not(.out-of-stock-card) {
    transform: translateY(-6px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
}

.product-card.out-of-stock-card {
    opacity: 0.7;
    cursor: not-allowed;
}

/* ── Product Image ── */

.product-image {
    position: relative;
    width: 100%;
    height: 220px;
    background: #f5f6f8;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover:not(.out-of-stock-card) .product-image img {
    transform: scale(1.05);
}

/* ── Out of Stock Overlay ── */
.out-of-stock-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    backdrop-filter: blur(2px);
}

.out-of-stock-text {
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    padding: 12px 24px;
    border: 2px solid #fff;
    border-radius: 8px;
    background: rgba(0, 0, 0, 0.4);
}

.out-of-stock-image img {
    filter: grayscale(0.8);
}

/* ── Product Badges ── */
.product-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 4px 14px;
    border-radius: 40px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: #173A8D;
    color: #fff;
    z-index: 5;
}

.product-badge.sale {
    background: #ef4444;
}

.product-badge.new {
    background: #22c55e;
}

/* ── Product Info ── */

.product-info {
    padding: 18px 20px 20px;
}

.product-info h3 {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 6px;
}

.product-info p {
    font-size: 14px;
    color: #777;
    line-height: 1.5;
    margin-bottom: 12px;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 2px;
    margin-bottom: 14px;
}

.product-rating i {
    font-size: 14px;
    color: #f59e0b;
}

.product-rating i.fa-regular {
    color: #d1d5db;
}

.product-rating span {
    font-size: 13px;
    color: #888;
    margin-left: 6px;
}

/* ── Product Footer ── */

.product-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-price {
    font-size: 20px;
    font-weight: 700;
    color: #111;
}

.product-price .old-price {
    font-size: 14px;
    font-weight: 400;
    color: #999;
    text-decoration: line-through;
    margin-left: 8px;
}

.add-to-cart {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: #173A8D;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.add-to-cart:hover:not(:disabled) {
    background: #0f2a6b;
    transform: scale(1.05);
}

.add-to-cart:active:not(:disabled) {
    transform: scale(0.95);
}

.add-to-cart:disabled {
    background: #ccc;
    cursor: not-allowed;
    opacity: 0.6;
}

/*======================================
        NO RESULTS
======================================*/

.no-results {
    text-align: center;
    padding: 60px 20px;
    background: #f5f6f8;
    border-radius: 16px;
    margin-top: 40px;
}

.no-results i {
    font-size: 48px;
    color: #ccc;
    margin-bottom: 16px;
}

.no-results h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 8px;
}

.no-results p {
    font-size: 16px;
    color: #888;
}

/*======================================
        ERROR MESSAGE
======================================*/

.error-message {
    text-align: center;
    padding: 60px 20px;
    background: #fef2f2;
    border-radius: 16px;
    margin-top: 40px;
    border: 2px solid #fecaca;
}

.error-message i {
    font-size: 48px;
    color: #ef4444;
    margin-bottom: 16px;
}

.error-message h3 {
    font-size: 24px;
    color: #991b1b;
    margin-bottom: 8px;
}

.error-message p {
    font-size: 16px;
    color: #dc2626;
    margin-bottom: 20px;
}

.retry-btn {
    padding: 10px 32px;
    border: none;
    border-radius: 40px;
    background: #173A8D;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.retry-btn:hover {
    background: #0f2a6b;
    transform: translateY(-2px);
}

/*======================================
        DARK MODE STYLES
======================================*/

:global(.dark) .shop-section {
    background: #0a1628;
}

:global(.dark) .shop-header h2 {
    color: #ffffff;
}

:global(.dark) .shop-header p {
    color: #9ca3af;
}

:global(.dark) .shop-controls {
    background: #1a2a4a;
}

:global(.dark) .search-bar {
    background: #0a1628;
    border-color: #2a3a5a;
}

:global(.dark) .search-bar:focus-within {
    border-color: #1f47d8;
}

:global(.dark) .search-bar i {
    color: #6b7280;
}

:global(.dark) .search-bar input {
    color: #d1d5db;
}

:global(.dark) .search-bar input::placeholder {
    color: #6b7280;
}

:global(.dark) .category-btn {
    background: #0a1628;
    border-color: #2a3a5a;
    color: #9ca3af;
}

:global(.dark) .category-btn:hover {
    border-color: #1f47d8;
    color: #4a7a9c;
}

:global(.dark) .category-btn.active {
    background: #1f47d8;
    border-color: #1f47d8;
    color: #ffffff;
}

:global(.dark) .sort-container label {
    color: #9ca3af;
}

:global(.dark) .sort-container select {
    padding: 10px 45px 10px 16px; /* Same as light mode */
    background: #0a1628;
    border-color: #2a3a5a;
    color: #d1d5db;
}

:global(.dark) .sort-container select:focus {
    border-color: #1f47d8;
}

:global(.dark) .sort-container select option {
    background: #1a2a4a;
    color: #d1d5db;
}

:global(.dark) .loading-state p {
    color: #9ca3af;
}

:global(.dark) .loading-spinner {
    border-color: #2a3a5a;
    border-top-color: #1f47d8;
}

:global(.dark) .product-card {
    background: #1a2a4a;
    border-color: #2a3a5a;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

:global(.dark) .product-card:hover:not(.out-of-stock-card) {
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
}

:global(.dark) .product-card.out-of-stock-card {
    opacity: 0.5;
}

:global(.dark) .product-image {
    background: #0a1628;
}

:global(.dark) .product-badge {
    background: #1f47d8;
}

:global(.dark) .product-badge.sale {
    background: #dc2626;
}

:global(.dark) .product-badge.new {
    background: #16a34a;
}

:global(.dark) .out-of-stock-overlay {
    background: rgba(0, 0, 0, 0.7);
}

:global(.dark) .out-of-stock-text {
    color: #fff;
    border-color: #4a7a9c;
    background: rgba(0, 0, 0, 0.6);
}

:global(.dark) .product-info h3 {
    color: #ffffff;
}

:global(.dark) .product-info p {
    color: #9ca3af;
}

:global(.dark) .product-rating i.fa-regular {
    color: #4b5563;
}

:global(.dark) .product-rating span {
    color: #6b7280;
}

:global(.dark) .product-price {
    color: #ffffff;
}

:global(.dark) .product-price .old-price {
    color: #6b7280;
}

:global(.dark) .add-to-cart {
    background: #1f47d8;
}

:global(.dark) .add-to-cart:hover:not(:disabled) {
    background: #2a5ae8;
}

:global(.dark) .add-to-cart:disabled {
    background: #374151;
}

:global(.dark) .no-results {
    background: #1a2a4a;
}

:global(.dark) .no-results i {
    color: #4b5563;
}

:global(.dark) .no-results h3 {
    color: #d1d5db;
}

:global(.dark) .no-results p {
    color: #6b7280;
}

:global(.dark) .error-message {
    background: #1a1a2e;
    border-color: #7f1d1d;
}

:global(.dark) .error-message h3 {
    color: #fca5a5;
}

:global(.dark) .error-message p {
    color: #f87171;
}

:global(.dark) .retry-btn {
    background: #1f47d8;
}

:global(.dark) .retry-btn:hover {
    background: #2a5ae8;
}

/*======================================
        RESPONSIVE
======================================*/

@media (max-width: 1200px) {
    .products-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 992px) {
    .shop-controls {
        flex-direction: column;
        align-items: stretch;
    }

    .sort-container {
        margin-left: 0;
    }

    .categories {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .shop-section {
        padding: 40px 20px 60px;
    }

    .shop-header h2 {
        font-size: 32px;
    }

    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .product-image {
        height: 180px;
    }

    .product-info h3 {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .shop-controls {
        padding: 16px;
        gap: 14px;
    }

    .search-bar input {
        font-size: 14px;
    }

    .category-btn {
        padding: 6px 16px;
        font-size: 13px;
    }

    .product-image {
        height: 200px;
    }

    .product-price {
        font-size: 18px;
    }

    .sort-container {
        flex-direction: column;
        align-items: stretch;
    }

    .out-of-stock-text {
        font-size: 16px;
        padding: 8px 16px;
    }
}
</style>