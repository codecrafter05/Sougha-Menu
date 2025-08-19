// Loader and page animations + dynamic menu building
document.addEventListener('DOMContentLoaded', function() {
  const loader = document.getElementById('loader');
  const heroSection = document.getElementById('hero-section');
  const menuSection = document.getElementById('menu');
  const categoriesNav = document.getElementById('categories');
  const productGrid = document.getElementById('product-grid');
  let menuData = null;
  let hasNavigated = false;

  // i18n/dir support + runtime switching
  let currentLang = 'en';
  function setLanguage(lang) {
    const isArabic = lang === 'ar';
    currentLang = lang;
    document.documentElement.lang = lang;
    document.documentElement.dir = isArabic ? 'rtl' : 'ltr';
    // Re-render categories/products with current selection
    if (menuData) {
      const activeBtn = document.querySelector('.category.active');
      const activeSlug = activeBtn ? activeBtn.dataset.category : 'all';
      renderCategories([{ slug: 'all', label: { en: 'All', ar: 'الكل' }, icon: 'images/elments.png' }, ...menuData.categories]);
      setupFiltering();
      renderProductsForCategory(activeSlug);
      // sync lang buttons
      document.querySelectorAll('.lang-btn').forEach(btn => {
        const isActive = btn.dataset.lang === currentLang;
        btn.classList.toggle('active', isActive);
        btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
      });
    }
  }
  setLanguage('en');

  // Price formatter (BHD default)
  const formatPrice = (value, currency = 'BHD', locale = 'en-BH') =>
    new Intl.NumberFormat(locale, { style: 'currency', currency, minimumFractionDigits: 2 }).format(value);

  // Build categories
  function renderCategories(categories) {
    categoriesNav.innerHTML = '';
    categoriesNav.setAttribute('role', 'tablist');
    const fragment = document.createDocumentFragment();

    categories.forEach((cat, index) => {
      const button = document.createElement('button');
      button.className = 'category';
      button.type = 'button';
      button.dataset.category = cat.slug;
      button.setAttribute('role', 'tab');
      button.setAttribute('aria-selected', index === 0 ? 'true' : 'false');
      button.tabIndex = index === 0 ? 0 : -1;

      const img = document.createElement('img');
      img.src = cat.icon;
      img.alt = `${cat.label[currentLang]} Icon`;
      img.width = 55; img.height = 55; img.loading = 'lazy'; img.decoding = 'async';
      const span = document.createElement('span');
      span.textContent = cat.label[currentLang];

      button.appendChild(img);
      button.appendChild(span);
      fragment.appendChild(button);
    });
    categoriesNav.appendChild(fragment);
  }

  // Build single product card
  function createProductItem(product) {
    const item = document.createElement('div');
    item.className = 'product-item';
    const card = document.createElement('div');
    card.className = 'product-card';
    card.dataset.category = product.category;
    if (product.subcategory) card.dataset.subcategory = product.subcategory;
    const frame = document.createElement('div');
    frame.className = 'image-frame';
    const img = document.createElement('img');
    img.src = product.image;
    img.alt = product.name[currentLang];
    img.loading = 'lazy';
    img.decoding = 'async';
    img.width = 400; img.height = 280;
    frame.appendChild(img);
    const title = document.createElement('h3');
    title.textContent = product.name[currentLang];
    const price = document.createElement('p');
    price.className = 'price';
    price.textContent = formatPrice(product.price, product.currency || 'BHD');
    card.appendChild(frame);
    card.appendChild(title);
    card.appendChild(price);
    item.appendChild(card);
    return item;
  }

  // Build products grouped by subcategory (with headers in the grid)
  function renderProductsForCategory(categorySlug) {
    if (!menuData) return;
    productGrid.innerHTML = '';
    const fragment = document.createDocumentFragment();

    const categoriesToRender = categorySlug === 'all'
      ? menuData.categories
      : menuData.categories.filter(c => c.slug === categorySlug);

    categoriesToRender.forEach((cat) => {
      const subcategories = Array.isArray(cat.subcategories) && cat.subcategories.length
        ? cat.subcategories
        : [{ slug: 'default', label: { en: 'Items', ar: 'المنتجات' } }];

      subcategories.forEach((sub) => {
        const subProducts = (menuData.products || []).filter(p => p.category === cat.slug && p.subcategory === sub.slug);
        if (!subProducts.length) return;

        const header = document.createElement('div');
        header.className = 'subcategory-header';
        header.textContent = sub.label[currentLang] || sub.label.en;
        fragment.appendChild(header);

        subProducts.forEach((p) => {
          fragment.appendChild(createProductItem(p));
        });
      });
    });

    productGrid.appendChild(fragment);
    setupRevealAnimations();
    setTimeout(() => { setupTouchSupport(); }, 0);
  }

  // Filtering by rebuilding grid per category
  function setupFiltering() {
    const categoryButtons = categoriesNav.querySelectorAll('.category[role="tab"]');

    function activateCategory(slug) {
      categoryButtons.forEach(btn => {
        const isActive = btn.dataset.category === slug;
        btn.classList.toggle('active', isActive);
        btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
        btn.tabIndex = isActive ? 0 : -1;
      });
      renderProductsForCategory(slug);
    }

    // Click/keyboard handlers
    categoryButtons.forEach((btn, idx) => {
      btn.addEventListener('click', () => activateCategory(btn.dataset.category));
      btn.addEventListener('keydown', (e) => {
        const isRtl = document.documentElement.dir === 'rtl';
        let newIndex = idx;
        if (e.key === 'ArrowRight') {
          newIndex = isRtl ? idx - 1 : idx + 1;
        } else if (e.key === 'ArrowLeft') {
          newIndex = isRtl ? idx + 1 : idx - 1;
        } else if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          activateCategory(btn.dataset.category);
          return;
        } else {
          return;
        }
        e.preventDefault();
        if (newIndex < 0) newIndex = categoryButtons.length - 1;
        if (newIndex >= categoryButtons.length) newIndex = 0;
        categoryButtons[newIndex].focus();
      });
    });

    // Activate first category by default
    const first = categoryButtons[0];
    if (first) activateCategory(first.dataset.category);
  }

  // Reveal animations observer
  function setupRevealAnimations() {
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);
    document.querySelectorAll('.product-card').forEach((card, index) => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(30px)';
      card.style.transition = `opacity 0.3s ease ${index * 0.05}s, transform 0.3s ease ${index * 0.05}s`;
      observer.observe(card);
    });
    categoriesNav.querySelectorAll('.category').forEach((cat, index) => {
      cat.style.opacity = '0';
      cat.style.transform = 'translateY(20px)';
      cat.style.transition = `opacity 0.3s ease ${index * 0.05}s, transform 0.3s ease ${index * 0.05}s`;
      observer.observe(cat);
    });
  }

  // Load data and render
  async function initMenu() {
    try {
      // Prefer backend API if available, fallback to local JSON
      let data = null;
      try {
        const apiUrl = (window.PUBLIC_MENU_ENDPOINT || '/api/menu');
        const apiRes = await fetch(apiUrl, { cache: 'no-cache' });
        if (apiRes.ok) {
          data = await apiRes.json();
        }
      } catch (_) {}
      if (!data) {
        const res = await fetch('data/menu.json', { cache: 'no-cache' });
        data = await res.json();
      }
      menuData = data;
      const categories = [{ slug: 'all', label: { en: 'All', ar: 'الكل' }, icon: 'images/elments.png' }, ...data.categories];
      renderCategories(categories);
      setupRevealAnimations();
      setupFiltering();
      // wire language switch buttons
      const langSwitch = document.getElementById('lang-switch');
      if (langSwitch) {
        langSwitch.querySelectorAll('.lang-btn').forEach(btn => {
          btn.addEventListener('click', () => setLanguage(btn.dataset.lang));
        });
      }
    } catch (e) {
      console.error('Failed to load menu data', e);
    }
  }

  // Keep original loader/hero/menu transition timing
  setTimeout(() => {
    loader.classList.add('hidden');
    heroSection.classList.add('visible');
    setTimeout(() => { loader.style.display = 'none'; }, 800);
    setTimeout(() => {
      hasNavigated = true;
      heroSection.classList.add('hidden');
      setTimeout(() => {
        menuSection.classList.add('visible');
        setTimeout(() => {
          heroSection.style.display = 'none';
          const heroLogo = document.querySelector('.hero-logo');
          if (heroLogo) heroLogo.style.display = 'none';
        }, 1000);
      }, 500);
    }, 1000);
  }, 3000);

  // Prevent scroll until navigate (kept as before)
  function preventScroll(e) {
    if (!hasNavigated) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    }
  }
  document.addEventListener('wheel', preventScroll, { passive: false });
  document.addEventListener('touchmove', preventScroll, { passive: false });
  document.addEventListener('keydown', function(e) {
    if (!hasNavigated && (e.key === 'ArrowDown' || e.key === 'PageDown' || e.key === ' ')) {
      e.preventDefault();
    }
  });

  // Touch micro-interaction
  function setupTouchSupport() {
    document.querySelectorAll('.product-item').forEach(item => {
      const card = item.querySelector('.product-card');
      let touchStartY = 0;
      card.addEventListener('touchstart', (e) => { touchStartY = e.touches[0].clientY; }, { passive: true });
      card.addEventListener('touchend', (e) => {
        const touchEndY = e.changedTouches[0].clientY;
        if (touchStartY - touchEndY > 50) {
          item.style.transform = 'translateY(-5px)';
          setTimeout(() => { item.style.transform = 'translateY(0)'; }, 200);
        }
      }, { passive: true });
    });
  }

  // Initialize data-driven menu early
  initMenu().then(() => {
    setTimeout(() => { setupTouchSupport(); }, 4000);
  });
});