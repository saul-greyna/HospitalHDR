# Guía de Configuración de Cookies

Esta guía te muestra cómo integrar el sistema completo de gestión de cookies en el proyecto Hospital DR.

## 📁 Estructura de archivos creados

```
resources/js/
├── services/
│   ├── clientInfoService.js      # Recopila información del dispositivo/cliente
│   ├── cookieService.js           # Gestión básica de cookies (read, write, delete)
│   └── consentService.js          # Lógica de consentimiento y persistencia
├── composables/
│   └── useCookies.js              # Hook Vue 3 para usar cookies en componentes
├── data/
│   └── cookieConfig.js            # Configuración de tipos de cookies
└── components/
    ├── CookieBanner.vue           # Banner flotante de consentimiento
    └── CookieSettings.vue         # Página de configuración detallada

app/Http/Middleware/
└── ValidateCookieConsent.php      # Middleware Laravel para validar consentimiento
```

## 🚀 Integración en la aplicación

### 1. Registrar el plugin de cookies en `App.vue`

Edita `resources/js/App.vue`:

```vue
<script setup>
import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import { cookiePlugin } from './composables/useCookies.js'

const app = createApp(App)
  .use(router)
  .use(cookiePlugin)  // Registra el plugin de cookies
  .mount('#app')
</script>
```

O mejor, en `resources/js/app.js`:

```javascript
import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import { cookiePlugin } from './composables/useCookies.js'

createApp(App)
    .use(router)
    .use(cookiePlugin)
    .mount('#app')
```

### 2. Incluir el CookieBanner en `Main.vue` (layout principal)

Edita `resources/js/layouts/Main.vue`:

```vue
<template>
  <div>
    <Header />
    <main>
      <router-view />
    </main>
    <Footer />
    
    <!-- Banner de cookies -->
    <CookieBanner />
  </div>
</template>

<script setup>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
import CookieBanner from '../components/CookieBanner.vue'
</script>
```

### 3. (Opcional) Crear página de Configuración de Cookies

Crea una nueva ruta en `resources/js/router/index.js`:

```javascript
import CookieSettings from '../components/CookieSettings.vue'

export default createRouter({
    history: createWebHistory(),
    routes: [
        // ... otras rutas ...
        {
            path: '/privacy/cookies',
            name: 'cookie-settings',
            component: CookieSettings
        }
    ]
})
```

Agrega un link en el footer (`Footer.vue`):

```vue
<a href="/privacy/cookies" class="text-blue-600 hover:text-blue-800">
  Configuración de Cookies
</a>
```

### 4. Registrar el middleware en Laravel (opcional)

En `app/Http/Kernel.php`, registra el middleware:

```php
protected $routeMiddleware = [
    // ... otros middlewares ...
    'validate.cookie.consent' => \App\Http\Middleware\ValidateCookieConsent::class,
];
```

Luego úsalo en `routes/web.php`:

```php
// Endpoint protegido por consentimiento de analytics
Route::get('/api/analytics', function (Request $request) {
    $consent = $request->attributes->get('consent');
    return response()->json(['data' => 'Analytics data']);
})->middleware('validate.cookie.consent:analytics');

// Endpoint que requiere marketing
Route::post('/api/newsletter', function (Request $request) {
    return response()->json(['success' => true]);
})->middleware('validate.cookie.consent:marketing');
```

## 💻 Uso en componentes Vue

### Ejemplo básico: aceptar/rechazar cookies

```vue
<template>
  <button @click="handleAccept">Aceptar todas</button>
  <button @click="handleReject">Rechazar todas</button>
  <p v-if="hasUserConsented">Consentimiento otorgado</p>
</template>

<script setup>
import { useCookies } from '@/composables/useCookies'

const { acceptAll, rejectAll, hasUserConsented } = useCookies()

const handleAccept = async () => {
  await acceptAll()
  console.log('Cookies aceptadas')
}

const handleReject = async () => {
  await rejectAll()
  console.log('Cookies rechazadas')
}
</script>
```

### Ejemplo: verificar consentimiento antes de cargar analytics

```vue
<template>
  <div>
    <p v-if="analyticsEnabled">Google Analytics está activo</p>
    <p v-else>Google Analytics está deshabilitado</p>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useCookies } from '@/composables/useCookies'

const { isConsentGiven } = useCookies()

const analyticsEnabled = computed(() => isConsentGiven('analytics'))

// Carga Google Analytics solo si está permitido
if (analyticsEnabled.value) {
  // Carga el script de Google Analytics
}
</script>
```

### Ejemplo: gestionar una cookie individual

```vue
<template>
  <div>
    <p>Mi ID de usuario: {{ userId }}</p>
    <button @click="updateUserId">Cambiar ID</button>
    <button @click="clearUserId">Limpiar</button>
  </div>
</template>

<script setup>
import { useCookie } from '@/composables/useCookies'

const userIdCookie = useCookie('user_id', 'anonymous')

const userId = userIdCookie.value
const updateUserId = () => userIdCookie.set('user_' + Date.now())
const clearUserId = () => userIdCookie.remove()
</script>
```

### Ejemplo: grupo de cookies relacionadas

```vue
<template>
  <div>
    <p>Preferencias guardadas: {{ state }}</p>
    <button @click="updateTheme('dark')">Tema oscuro</button>
    <button @click="updateTheme('light')">Tema claro</button>
    <button @click="reset">Resetear</button>
  </div>
</template>

<script setup>
import { useCookieGroup } from '@/composables/useCookies'

const { state, reset } = useCookieGroup('preferences', {
  theme: 'light',
  language: 'es',
  sidebarCollapsed: false
})

const updateTheme = (theme) => {
  state.theme = theme
  // Se guarda automáticamente en la cookie
}
</script>
```

## 📊 Usar getClientInfo() en tu lógica

```javascript
import { getClientInfo, getDeviceInfo, getBrowserInfo } from '@/services/clientInfoService'

// Información completa del cliente
const clientInfo = await getClientInfo()
console.log(clientInfo)
/* Output:
{
  screen: "1920x1080",
  viewport: "1920x1080",
  pixelRatio: 2,
  language: "es-MX",
  languages: "es-MX, es, en-US, en",
  platform: "Win32",
  timezone: "America/Mexico_City",
  userAgent: "Mozilla/5.0...",
  colorDepth: 24,
  touch: false,
  memory: 8,
  cpu: 8,
  platformVersion: "10.0",
  architecture: "x86",
  model: "",
  timestamp: "2024-01-15T14:30:45.123Z"
}
*/

// Solo información del dispositivo (privada, sin User Agent)
const deviceInfo = getDeviceInfo()
// { screen, viewport, pixelRatio, colorDepth, touch, memory, cpu }

// Solo información del navegador
const browserInfo = getBrowserInfo()
// { language, languages, platform, userAgent, cookieEnabled, onLine }

// Información de zona horaria/localización
const localeInfo = getLocaleInfo()
// { timezone, locale, timestamp, currentTime }
```

## 🔒 Consideraciones de privacidad

1. **`getClientInfo()` recopila datos sensibles** (User Agent, pantalla, CPU) → úsalo solo con consentimiento explícito.
2. **`getDeviceInfo()` es más seguro** → usa este para estadísticas generales sin datos de identificación.
3. **Siempre cifra los datos** en tránsito (HTTPS) y almacena datos sensibles de forma segura en el backend.
4. **Cumple con GDPR/CCPA** → guarda el consentimiento con timestamp y permite a los usuarios exportar/eliminar sus datos.

## 🧪 Testing

### Test del consentimiento

```javascript
// test/cookieConsent.spec.js
import { describe, it, expect, beforeEach } from 'vitest'
import { setConsent, getConsent, isConsentGiven } from '@/services/consentService'

describe('Cookie Consent', () => {
  beforeEach(() => {
    document.cookie = 'cookie_consent=; expires=Thu, 01 Jan 1970 00:00:00 UTC;'
  })

  it('should save and retrieve consent', async () => {
    await setConsent({ essential: true, analytics: true })
    const consent = getConsent()
    expect(consent).toBeTruthy()
    expect(consent.consent.analytics).toBe(true)
  })

  it('should check if consent is given', () => {
    expect(isConsentGiven('analytics')).toBe(false) // Sin guardado previo
  })
})
```

## 📝 Notas importantes

- Las **cookies esenciales siempre están habilitadas** (`required: true`) y no se pueden desactivar.
- El banner se muestra automáticamente si no hay consentimiento guardado.
- El consentimiento se persiste en una cookie única `cookie_consent` (JSON serializado).
- Cada cookie en la configuración incluye un `duration` descriptivo para mostrar al usuario.
- El middleware de Laravel permite proteger endpoints específicos que requieran consentimiento.

## 🎨 Personalización

### Cambiar colores del banner

Edita `CookieBanner.vue` y busca las clases de Tailwind (ej: `bg-green-600`, `bg-gray-200`).

### Agregar nuevos tipos de cookies

En `resources/js/data/cookieConfig.js`, agrega a `COOKIE_CONFIG`:

```javascript
[COOKIE_TYPES.CUSTOM]: {
  id: 'custom',
  name: 'Cookies personalizadas',
  description: 'Descripción aquí',
  category: 'custom',
  required: false,
  enabled: false,
  cookies: [
    { name: 'my_cookie', domain: '...', description: '...', duration: '...' }
  ]
}
```

### Traducir a otros idiomas

Busca las strings en `CookieBanner.vue` y `CookieSettings.vue`, y crea propiedades para i18n.

## 📞 Soporte

Para dudas sobre GDPR, consulta la documentación oficial: https://gdpr-info.eu/
