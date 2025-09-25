const CACHE_NAME = 'sougha-pwa-v2';
const STATIC_CACHE = 'sougha-static-v2';
const IMAGES_CACHE = 'sougha-images-v2';

const urlsToCache = [
  '/',
  '/css/style.css',
  '/js/script.js',
  '/images/logo icon-01.png',
  '/images/Sougha.png',
  '/images/1-04.png',
  '/manifest.webmanifest',
  '/api/menu'
];

const imageExtensions = ['.jpg', '.jpeg', '.png', '.webp', '.gif', '.svg'];

// Install event - cache resources
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then(function(cache) {
        console.log('Opened static cache');
        return cache.addAll(urlsToCache);
      })
      .then(function() {
        return self.skipWaiting();
      })
  );
});

// Fetch event - serve from cache when offline
self.addEventListener('fetch', function(event) {
  const request = event.request;
  const url = new URL(request.url);
  
  // Handle images with cache-first strategy
  if (isImageRequest(url.pathname)) {
    event.respondWith(
      caches.open(IMAGES_CACHE).then(function(cache) {
        return cache.match(request).then(function(response) {
          if (response) {
            return response;
          }
          return fetch(request).then(function(networkResponse) {
            cache.put(request, networkResponse.clone());
            return networkResponse;
          });
        });
      })
    );
    return;
  }
  
  // Handle API requests with network-first strategy
  if (url.pathname.startsWith('/api/')) {
    event.respondWith(
      fetch(request).then(function(response) {
        if (response.ok) {
          const responseClone = response.clone();
          caches.open(STATIC_CACHE).then(function(cache) {
            cache.put(request, responseClone);
          });
        }
        return response;
      }).catch(function() {
        return caches.match(request);
      })
    );
    return;
  }
  
  // Handle static resources with cache-first strategy
  event.respondWith(
    caches.match(request)
      .then(function(response) {
        // Return cached version if available
        if (response) {
          return response;
        }
        
        // Try to fetch from network
        return fetch(request).then(function(networkResponse) {
          // Cache successful responses
          if (networkResponse.ok) {
            const responseClone = networkResponse.clone();
            caches.open(STATIC_CACHE).then(function(cache) {
              cache.put(request, responseClone);
            });
          }
          return networkResponse;
        });
      })
  );
});

// Helper function to check if request is for an image
function isImageRequest(pathname) {
  return imageExtensions.some(function(ext) {
    return pathname.toLowerCase().includes(ext);
  });
}

// Activate event - clean up old caches
self.addEventListener('activate', function(event) {
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheName !== STATIC_CACHE && cacheName !== IMAGES_CACHE) {
            console.log('Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    }).then(function() {
      return self.clients.claim();
    })
  );
});
