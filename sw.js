const CACHE_NAME = 'stone-site-cache-v2';
const urlsToCache = [
  '/',
  '/index.html',
  '/sad_stones.html',
  '/funny_stones.html',
  '/weird_stones.html',
  '/feedback.html',
  '/feedback_success.php',
  '/style.css',
  '/images/main_1.jpg',
  '/images/main_2.jpg',
  '/images/main_3.jpg',
  '/images/sad_1.jpg',
  '/images/sad_2.jpg',
  '/images/sad_3.jpg',
  '/images/sad_4.jpg',
  '/images/sad_5.jpg',
  '/images/funny_1.jpg',
  '/images/funny_2.jpg',
  '/images/funny_3.jpg',
  '/images/funny_4.jpg',
  '/images/funny_5.jpg',
  '/images/weird_1.jpg',
  '/images/weird_2.jpg',
  '/images/weird_3.jpg',
  '/images/weird_4.jpg',
  '/images/weird_5.jpg'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;
        }
        
        return fetch(event.request).then(
          response => {
            if(!response || response.status !== 200 || response.type !== 'basic') {
              return response;
            }

            const responseToCache = response.clone();

            caches.open(CACHE_NAME)
              .then(cache => {
                cache.put(event.request, responseToCache);
              });

            return response;
          }
        );
      })
  );
});

self.addEventListener('activate', event => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});