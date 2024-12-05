// Instalación del Service Worker
self.addEventListener('install', (event) => {
  console.log('Service Worker instalándose...');
  event.waitUntil(
      caches.open('cinemarte-cache-v1').then((cache) => {
          return cache.addAll([
              '/', // Asegúrate de que la raíz esté incluida
              '/index.php',
              '/productosinsert.php',
              '/css/style.css',
              '/css/bootstrap.css',
              '/app.js',
              '/manifest.json',
              '/images/logo_small.png',
              '/images/logo_small_icon_only_inverted(1).png',
              '/images/hero-bg.jpg',
              '/images/icon.png',
              '/images/Webp.net-resizeimage.png',
              '/images/Webp.net-resizeimage (1).png'
          ]);
      })
  );
  self.skipWaiting(); // Activar inmediatamente
  console.log('Service Worker instalado');
});

// Activación del Service Worker
self.addEventListener('activate', (event) => {
  console.log('Service Worker activado');
  event.waitUntil(
      caches.keys().then((cacheNames) => {
          return Promise.all(
              cacheNames.map((cacheName) => {
                  if (cacheName !== 'cinemarte-cache-v1') {
                      console.log('Cache obsoleto eliminado:', cacheName);
                      return caches.delete(cacheName); // Elimina los caches antiguos
                  }
              })
          );
      })
  );
  self.clients.claim(); // Toma control de las páginas abiertas
  console.log('Service Worker ahora controla las páginas');
});

// Manejo de las peticiones de red
self.addEventListener('fetch', (event) => {
  console.log('Interceptando petición a:', event.request.url);
  event.respondWith(
      caches.match(event.request).then((cachedResponse) => {
          if (cachedResponse) {
              return cachedResponse; // Devuelve la respuesta cacheada si existe
          }
          return fetch(event.request)
              .then((response) => {
                  if (response && response.status === 200 && response.type === 'basic') {
                      caches.open('cinemarte-cache-v1').then((cache) => {
                          cache.put(event.request, response.clone());
                      });
                  }
                  return response;
              })
              .catch((error) => {
                  console.error('Error al hacer la solicitud:', error);
                  throw error;
              });
      })
  );
});

// Manejo de notificaciones Push
self.addEventListener('push', (event) => {
  console.log('Notificación Push recibida:', event);
  const data = event.data ? event.data.json() : {};
  const title = data.title || 'Notificación';
  const body = data.body || '¡Tienes una nueva tarea!';
  const icon = '/images/icon.png';
  const badge = '/images/icon.png';

  const options = {
      body: body,
      icon: icon,
      badge: badge,
  };

  event.waitUntil(
      self.registration.showNotification(title, options)
  );
});

// Manejar clics en la notificación
self.addEventListener('notificationclick', (event) => {
  console.log('Notificación clickeada:', event);
  event.notification.close();
  event.waitUntil(
      clients.openWindow('/') // Cambia la URL si necesitas abrir otra página
  );
});
