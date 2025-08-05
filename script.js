// Smooth scroll to menu section when tap is clicked
document.addEventListener('DOMContentLoaded', function() {
    const tapSection = document.querySelector('.tap-section');
    const menuSection = document.getElementById('menu');
    
    if (tapSection && menuSection) {
        tapSection.addEventListener('click', function() {
            menuSection.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
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
}); 