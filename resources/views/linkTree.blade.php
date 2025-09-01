<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sougha — Links</title>
  <link rel="stylesheet" href="{{ asset('css/linkTree.css') }}">
  <meta name="theme-color" content="#3A2A22" />
  <!-- اختياري: خط بسيط يتماشى مع ستايل القهوة -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>

  <main class="container">

    <!-- Brand -->
    <header class="brand">
      <!-- ضع مسار الشعار الصحيح هنا -->
      <img  src="{{ asset('images/1-04.png') }}" alt="Sougha Logo" class="logo" />
      <p class="brand-tagline">From Chaos to Calm</p>
    </header>

    <!-- Links -->
    <section class="links">

      <!-- Location -->
      <a class="link-card" href="https://maps.google.com/?q=Sougha+Coffee" target="_blank" rel="noopener">
        <span class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5Z"/></svg>
        </span>
        <span class="txt">
          <strong>Location</strong>
          <em>Find us on Google Maps</em>
        </span>
      </a>

      <!-- Menu -->
      <a class="link-card" href="https://sougha.site" target="_blank" rel="noopener">
        <span class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2Zm8 1.5V8h4.5L14 3.5ZM8 12.5h8v1.5H8v-1.5Zm0 4h8v1.5H8v-1.5Zm0-8h5V10H8V8.5Z"/></svg>
        </span>
        <span class="txt">
          <strong>Menu</strong>
          <em>See Our Menu</em>
        </span>
      </a>

      <!-- Contact 1 -->
      <a class="link-card" href="tel:+97300000000">
        <span class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l1.9-1.9a1.2 1.2 0 0 1 1.2-.3c1.3.4 2.6.6 4 .6.7 0 1.3.5 1.3 1.2V20c0 .7-.6 1.3-1.3 1.3A19.3 19.3 0 0 1 3 6.3C3 5.6 3.6 5 4.3 5h2.9c.7 0 1.2.6 1.2 1.3 0 1.4.2 2.7.6 4 .1.4 0 .9-.3 1.2l-1.9 1.9Z"/></svg>
        </span>
        <span class="txt">
          <strong>Contact</strong>
          <em>+973 0000 0000</em>
        </span>
      </a>

      <!-- Instagram -->
      <a class="link-card" href="https://instagram.com/sougha" target="_blank" rel="noopener">
        <span class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7Zm5 3.5a5.5 5.5 0 1 1 0 11 5.5 5.5 0 0 1 0-11Zm0 2a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm5.25-.75a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z"/></svg>
        </span>
        <span class="txt">
          <strong>Instagram</strong>
          <em>@sougha</em>
        </span>
      </a>

      <!-- TikTok -->
      <a class="link-card" href="https://www.tiktok.com/@sougha" target="_blank" rel="noopener">
        <span class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M16.5 2a6.5 6.5 0 0 0 5.5 3.1v3.1a9.3 9.3 0 0 1-5.5-1.8v8.6a6.5 6.5 0 1 1-6.5-6.5c.3 0 .6 0 .9.1v3.2a3.4 3.4 0 1 0 2.6 3.3V2h3Z"/></svg>
        </span>
        <span class="txt">
          <strong>TikTok</strong>
          <em>@sougha</em>
        </span>
      </a>
        
        <a class="link-card" href="https://g.page/r/YOUR_GOOGLE_REVIEW_LINK" target="_blank" rel="noopener">
            <span class="icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 2.5l2.9 6 6.6.9-4.8 4.7 1.1 6.5L12 17.8l-5.8 3.1 1.1-6.5-4.8-4.7 6.6-.9L12 2.5Z"/></svg>
            </span>
            <span class="txt">
            <strong>Leave a Review</strong>
            <em>Share your experience</em>
            </span>
        </a>
       
    </section>

    <!-- Footer with tiny brand cues -->
    <footer class="footer">
      <div class="brand-icons">
        <svg viewBox="0 0 24 24" width="26" height="26" fill="var(--caramel)">
          <path d="M12 3 13.5 8.5 19 10 13.5 11.5 12 17 10.5 11.5 5 10 10.5 8.5 12 3Z"/>
        </svg>
        <svg viewBox="0 0 24 24" width="26" height="26" fill="var(--caramel)">
          <path d="M12 3 13.5 8.5 19 10 13.5 11.5 12 17 10.5 11.5 5 10 10.5 8.5 12 3Z"/>
        </svg>
        <svg viewBox="0 0 24 24" width="26" height="26" fill="var(--caramel)">
          <path d="M12 3 13.5 8.5 19 10 13.5 11.5 12 17 10.5 11.5 5 10 10.5 8.5 12 3Z"/>
        </svg>
        <svg viewBox="0 0 24 24" width="26" height="26" fill="var(--caramel)">
          <path d="M12 3 13.5 8.5 19 10 13.5 11.5 12 17 10.5 11.5 5 10 10.5 8.5 12 3Z"/>
        </svg>
      </div>
    </footer>

  </main>

</body>
</html>
