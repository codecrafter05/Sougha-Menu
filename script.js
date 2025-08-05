// Loader and page animations
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById('loader');
    const heroSection = document.getElementById('hero-section');
    const menuSection = document.getElementById('menu');
    let hasNavigated = false; // Track if user has navigated
    
    // Hide loader and show hero section after 3 seconds
    setTimeout(() => {
        loader.classList.add('hidden');
        heroSection.classList.add('visible');
        
        // Remove loader from DOM after animation
        setTimeout(() => {
            loader.style.display = 'none';
        }, 800);
    }, 3000);
    
    // Prevent scroll on hero section
    function preventScroll(e) {
        if (!hasNavigated) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    }
    
    // Add scroll prevention
    document.addEventListener('wheel', preventScroll, { passive: false });
    document.addEventListener('touchmove', preventScroll, { passive: false });
    document.addEventListener('keydown', function(e) {
        if (!hasNavigated && (e.key === 'ArrowDown' || e.key === 'PageDown' || e.key === ' ')) {
            e.preventDefault();
        }
    });
    
    // Smooth scroll to menu section when tap is clicked
    const tapSection = document.querySelector('.tap-section');
    const tapText = document.querySelector('.tap-text');
    
    if (tapSection && menuSection) {
        tapSection.addEventListener('click', function() {
            hasNavigated = true;
            
            // Hide hero section with animation
            heroSection.classList.add('hidden');
            
            // Remove scroll prevention
            document.removeEventListener('wheel', preventScroll);
            document.removeEventListener('touchmove', preventScroll);
            
            // Show menu section after hero animation
            setTimeout(() => {
                menuSection.classList.add('visible');
                
                // Remove hero section and logo from DOM after animation
                setTimeout(() => {
                    heroSection.style.display = 'none';
                    const heroLogo = document.querySelector('.hero-logo');
                    if (heroLogo) {
                        heroLogo.style.display = 'none';
                    }
                }, 1000);
            }, 500);
        });
        
        // Add hover effect
        tapSection.style.cursor = 'pointer';
        tapSection.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        tapSection.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
    
    // Size selection functionality
    function setupSizeSelection() {
        const sizeButtons = document.querySelectorAll('.sizes span');
        const productCards = document.querySelectorAll('.product-card');
        
        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productCard = this.closest('.product-card');
                const imageFrame = productCard.querySelector('.image-frame img');
                const currentSrc = imageFrame.src;
                
                // Get random image number (1-4)
                const randomImage = Math.floor(Math.random() * 4) + 1;
                const newSrc = currentSrc.replace(/\d+\.png/, `${randomImage}.png`);
                
                // Instant change without any effects
                imageFrame.src = newSrc;
                
                // Instant visual feedback
                this.style.backgroundColor = 'var(--coffee)';
                this.style.color = 'white';
                
                // Reset other buttons in same card
                const otherButtons = productCard.querySelectorAll('.sizes span');
                otherButtons.forEach(btn => {
                    if (btn !== this) {
                        btn.style.backgroundColor = '';
                        btn.style.color = '';
                    }
                });
            });
        });
    }
    
    // Add scroll reveal animation for menu items
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all product cards
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Observe categories
    const categories = document.querySelectorAll('.category');
    categories.forEach((category, index) => {
        category.style.opacity = '0';
        category.style.transform = 'translateY(20px)';
        category.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
        observer.observe(category);
    });
    
    // Setup size selection after menu is visible
    setTimeout(() => {
        setupSizeSelection();
        setupCategoryFilter();
    }, 4000); // After loader and hero animations
    
    // Category filter functionality
    function setupCategoryFilter() {
        const categories = document.querySelectorAll('.category');
        const productCards = document.querySelectorAll('.product-card');
        
        categories.forEach(category => {
            category.addEventListener('click', function() {
                const selectedCategory = this.querySelector('span').textContent.toLowerCase();
                let categoryFilter = '';
                
                // Map category names to data attributes
                switch(selectedCategory) {
                    case 'drinks':
                        categoryFilter = 'drinks';
                        break;
                    case 'hot coffee':
                        categoryFilter = 'hot-coffee';
                        break;
                    case 'hot teas':
                        categoryFilter = 'hot-teas';
                        break;
                    case 'bakery':
                        categoryFilter = 'bakery';
                        break;
                    default:
                        categoryFilter = 'all';
                }
                
                // Filter products with smooth animation
                productCards.forEach((card, index) => {
                    if (categoryFilter === 'all' || card.dataset.category === categoryFilter) {
                        card.style.display = 'block';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        
                        // Staggered animation for visible cards
                        setTimeout(() => {
                            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 100);
                    } else {
                        // Hide cards with fade out
                        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(-10px)';
                        
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
                
                // Update active category with animation
                categories.forEach(cat => {
                    cat.classList.remove('active');
                    cat.style.transition = 'all 0.3s ease';
                    cat.style.backgroundColor = '';
                    cat.style.color = '';
                    cat.style.transform = 'scale(1)';
                });
                this.classList.add('active');
                this.style.transform = 'scale(1.1)';
            });
        });
    }
}); 