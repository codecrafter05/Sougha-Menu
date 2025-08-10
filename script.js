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
        
        // Auto navigate to menu section after 1 second
        setTimeout(() => {
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
        }, 1000); // 1 second delay
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
    
    // Add scroll reveal animation for menu items with improved performance
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
    
    // Observe all product items with staggered animation
    const productItems = document.querySelectorAll('.product-item');
    productItems.forEach((item, index) => {
        const card = item.querySelector('.product-card');
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.3s ease ${index * 0.05}s, transform 0.3s ease ${index * 0.05}s`;
        observer.observe(card);
    });
    
    // Observe categories with improved animation
    const categories = document.querySelectorAll('.category');
    categories.forEach((category, index) => {
        category.style.opacity = '0';
        category.style.transform = 'translateY(20px)';
        category.style.transition = `opacity 0.3s ease ${index * 0.05}s, transform 0.3s ease ${index * 0.05}s`;
        observer.observe(category);
    });
    
    // Setup category filter after menu is visible
    setTimeout(() => {
        setupCategoryFilter();
    }, 4000); // After loader and hero animations
    
    // Enhanced Category filter functionality
    function setupCategoryFilter() {
        const categories = document.querySelectorAll('.category');
        const productItems = document.querySelectorAll('.product-item');
        
        categories.forEach(category => {
            category.addEventListener('click', function() {
                const selectedCategory = this.querySelector('span').textContent.toLowerCase();
                let categoryFilter = '';
                
                // Map category names to data attributes
                switch(selectedCategory) {
                    case 'hot coffee':
                        categoryFilter = 'hot-coffee';
                        break;
                    case 'non-coffee':
                        categoryFilter = 'non-coffee';
                        break;
                    case 'iced coffee':
                        categoryFilter = 'iced-coffee';
                        break;
                    case 'non-coffee iced':
                        categoryFilter = 'non-coffee-iced';
                        break;
                    case 'refresher drinks':
                        categoryFilter = 'refresher';
                        break;
                    case 'ice cream':
                        categoryFilter = 'ice-cream';
                        break;
                    default:
                        categoryFilter = 'all';
                }
                
                // Filter products with smooth animation
                let visibleItems = [];
                productItems.forEach((item, index) => {
                    const card = item.querySelector('.product-card');
                    if (categoryFilter === 'all' || card.dataset.category === categoryFilter) {
                        item.style.display = 'block';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(30px) scale(0.95)';
                        visibleItems.push({ item, card, index });
                        
                        // Staggered animation for visible items
                        setTimeout(() => {
                            card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0) scale(1)';
                        }, index * 40);
                    } else {
                        // Hide items with fade out
                        card.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(-20px) scale(0.9)';
                        
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 200);
                    }
                });
                
                // Update active category with animation
                categories.forEach(cat => {
                    cat.classList.remove('active');
                    cat.style.transition = 'all 0.2s ease';
                    cat.style.backgroundColor = '';
                    cat.style.color = '';
                    cat.style.transform = 'scale(1)';
                });
                this.classList.add('active');
                this.style.transform = 'scale(1.1)';
                

            });
        });
    }
    
    // Add responsive touch support for mobile devices
    function setupTouchSupport() {
        const productItems = document.querySelectorAll('.product-item');
        
        productItems.forEach(item => {
            const card = item.querySelector('.product-card');
            let touchStartY = 0;
            let touchEndY = 0;
            
            card.addEventListener('touchstart', function(e) {
                touchStartY = e.touches[0].clientY;
            }, { passive: true });
            
            card.addEventListener('touchend', function(e) {
                touchEndY = e.changedTouches[0].clientY;
                const touchDiff = touchStartY - touchEndY;
                
                // If swipe up, add a subtle animation
                if (touchDiff > 50) {
                    item.style.transform = 'translateY(-5px)';
                    setTimeout(() => {
                        item.style.transform = 'translateY(0)';
                    }, 200);
                }
            }, { passive: true });
        });
    }
    
    // Setup touch support after menu is visible
    setTimeout(() => {
        setupTouchSupport();
    }, 4000);
    
    // Add window resize handler for better responsive behavior
    function handleResize() {
        const isMobile = window.innerWidth <= 768;
        const productItems = document.querySelectorAll('.product-item');
        
        productItems.forEach(item => {
            const card = item.querySelector('.product-card');
            if (isMobile) {
                card.style.minHeight = 'auto';
            } else {
                card.style.minHeight = '450px';
            }
        });
    }
    
    // Call on load and resize
    handleResize();
    window.addEventListener('resize', handleResize);
    
    // Add smooth scrolling for better UX
    function smoothScrollTo(element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
    
    // Optional: Keep tap section for manual navigation if needed
    if (tapSection) {
        // Mouse events
        tapSection.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(-50%) scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        tapSection.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(-50%) scale(1)';
        });
        
        // Touch events for mobile
        tapSection.addEventListener('touchstart', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.style.transform = 'translateX(-50%) scale(0.95)';
            this.style.transition = 'transform 0.2s ease';
        }, { passive: false });
        
        tapSection.addEventListener('touchend', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.style.transform = 'translateX(-50%) scale(1)';
            
            // Manual navigation (optional)
            if (!hasNavigated) {
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
            }
        }, { passive: false });
        
        // Click event for desktop
        tapSection.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Manual navigation (optional)
            if (!hasNavigated) {
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
            }
        });
    }
}); 