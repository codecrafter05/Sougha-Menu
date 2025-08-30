<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
  <!-- Primary Meta Tags -->
  <title>صوغة|  Sougha</title>
  <meta name="title" content="صوغة - أفضل كوفي شوب في مجمع الأفنيوز البحرين | Sougha - Best Coffee Shop in Avenues Mall Bahrain" />
  <meta name="description" content="استمتع بأفضل القهوة الإيطالية والحلويات الشعبية في صوغة - كوفي شوب مميز في مجمع الأفنيوز البحرين. إسبريسو، كابتشينو، لاتيه، حلويات إيطالية، قهوة عربية، مشروبات ساخنة وباردة. | Enjoy the best Italian coffee and traditional desserts at Sougha - a premium coffee shop in Avenues Mall Bahrain. Espresso, Cappuccino, Latte, Italian desserts, Arabic coffee, hot and cold beverages." />
  <meta name="keywords" content="صوغة, كوفي شوب, قهوة, إسبريسو, كابتشينو, لاتيه, حلويات إيطالية, قهوة عربية, مجمع الأفنيوز, البحرين, المنامة, مشروبات ساخنة, مشروبات باردة, قهوة مثلجة, ساندويتش, كرواسون, تشيز كيك, Sougha, coffee shop, espresso, cappuccino, latte, Italian desserts, Arabic coffee, Avenues Mall, Bahrain, Manama, hot drinks, cold drinks, iced coffee, sandwich, croissant, cheesecake" />
  <meta name="author" content="صوغة - كوفي شوب | Sougha Coffee Shop" />
  <meta name="robots" content="index, follow" />
  <meta name="language" content="Arabic, English" />
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="restaurant.cafe" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:title" content="صوغة - أفضل كوفي شوب في مجمع الأفنيوز البحرين | Sougha - Best Coffee Shop in Avenues Mall Bahrain" />
  <meta property="og:description" content="استمتع بأفضل القهوة الإيطالية والحلويات الشعبية في صوغة - كوفي شوب مميز في مجمع الأفنيوز البحرين. إسبريسو، كابتشينو، لاتيه، حلويات إيطالية، قهوة عربية، مشروبات ساخنة وباردة. | Enjoy the best Italian coffee and traditional desserts at Sougha - a premium coffee shop in Avenues Mall Bahrain. Espresso, Cappuccino, Latte, Italian desserts, Arabic coffee, hot and cold beverages." />
  <meta property="og:image" content="{{ asset('images/logo icon-01.png') }}" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:site_name" content="صوغة - كوفي شوب | Sougha Coffee Shop" />
  <meta property="og:locale" content="ar_SA" />
  
  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:url" content="{{ url()->current() }}" />
  <meta property="twitter:title" content="صوغة - أفضل كوفي شوب في مجمع الأفنيوز البحرين | Sougha - Best Coffee Shop in Avenues Mall Bahrain" />
  <meta property="twitter:description" content="استمتع بأفضل القهوة الإيطالية والحلويات الشعبية في صوغة - كوفي شوب مميز في مجمع الأفنيوز البحرين | Enjoy the best Italian coffee and traditional desserts at Sougha - a premium coffee shop in Avenues Mall Bahrain" />
  <meta property="twitter:image" content="{{ asset('images/logo icon-01.png') }}" />
  
  <!-- Additional Meta Tags -->
  <meta name="theme-color" content="#5e4636" />
  <meta name="msapplication-TileColor" content="#5e4636" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="default" />
  <meta name="apple-mobile-web-app-title" content="صوغة | Sougha" />
  <meta name="application-name" content="صوغة - كوفي شوب | Sougha Coffee Shop" />
  
  <!-- Canonical URL -->
  <link rel="canonical" href="{{ url()->current() }}" />
  
  <!-- Favicon and Icons -->
  <link rel="icon" type="image/png" href="{{ asset('images/logo icon-01.png') }}" />
  <link rel="manifest" href="{{ asset('manifest.webmanifest') }}" />
  
  <!-- Preconnect for Performance -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="loader" id="loader">
    <div class="loader-content">
      <div class="loader-logo">
        <img src="{{ asset('images/logo icon-01.png') }}" alt="صوغة - كوفي شوب في مجمع الأفنيوز البحرين | Sougha Coffee Shop in Avenues Mall Bahrain" width="300" height="300" decoding="async">
      </div>
    </div>
  </div>

  <section class="hero-section" id="hero-section">
    <div class="hero-content">
      <img src="{{ asset('images/Sougha.png') }}" alt="صوغة - أفضل كوفي شوب في مجمع الأفنيوز البحرين | Sougha - Best Coffee Shop in Avenues Mall Bahrain" class="hero-logo" width="600" height="600" decoding="async">
    </div>
  </section>

  <section class="menu-section" id="menu">
    <div class="container">
      <div class="menu-top">
        <img src="{{ asset('images/1-04.png') }}" alt="صوغة - قائمة الطعام | Sougha - Food Menu" class="header-logo" width="200" height="100" loading="lazy" decoding="async">
        <div class="lang-switch" id="lang-switch" role="group" aria-label="تبديل اللغة | Language Switch">
          <button type="button" class="lang-btn active" data-lang="en" aria-pressed="true">EN</button>
          <button type="button" class="lang-btn" data-lang="ar" aria-pressed="false">AR</button>
        </div>
      </div>

      <div class="menu-header">
        <div class="header-content">
          <div class="header-right">
            <nav class="categories" id="categories" aria-label="فئات القائمة | Menu Categories" role="tablist"></nav>
          </div>
        </div>
      </div>
      <div class="product-grid" id="product-grid"></div>
    </div>
  </section>

  <!-- Product Modal -->
  <div class="product-modal" id="product-modal">
    <div class="modal-overlay" id="modal-overlay"></div>
    <div class="modal-content">
      <button class="modal-close" id="modal-close" aria-label="إغلاق | Close">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
      <div class="modal-body">
        <div class="modal-image-container">
          <img id="modal-product-image" src="" alt="" class="modal-product-image">
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>


