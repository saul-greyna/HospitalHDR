# 🍪 Sistema de Cookies — Quick Start

Guía rápida para empezar a usar el sistema de gestión de cookies en Hospital DR.

## 📂 Archivos creados

```
resources/js/
├── services/
│   ├── clientInfoService.js      ← Recopila info del dispositivo/cliente
│   ├── cookieService.js          ← CRUD de cookies
│   └── consentService.js         ← Lógica de consentimiento
├── composables/
│   └── useCookies.js             ← Hook Vue 3
├── components/
│   ├── CookieBanner.vue          ← Banner flotante
│   └── CookieSettings.vue        ← Página de configuración
├── data/
│   └── cookieConfig.js           ← Definición de tipos de cookies
└── utils/
    └── cookieLoaders.js          ← Cargadores de scripts de terceros

app/Http/Middleware/
└── ValidateCookieConsent.php     ← Middleware Laravel
```

## ⚡ Pasos de integración (5 minutos)

### 1️⃣ Registra el plugin en `resources/js/app.js`

```javascript
import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import { cookiePlugin } from './composables/useCookies.js'

createApp(App)
    .use(router)
    .use(cookiePlugin)  // ← Agrega esta línea
    .mount('#app')
```

### 2️⃣ Importa el banner en tu layout (`resources/js/layouts/Main.vue`)

```vue
<template>
  <div>
    <Header />
    <router-view />
    <Footer />
    <CookieBanner />  <!-- ← Agrega esta línea -->
  </div>
</template>

<script setup>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
import CookieBanner from '../components/CookieBanner.vue'
</script>
```

### 3️⃣ Listo 🎉

El banner aparecerá automáticamente en la primera visita del usuario.

---

## 📖 Ejemplos rápidos

### Aceptar/rechazar todas las cookies

```vue
<template>
  <button @click="acceptAll">Aceptar</button>
  <button @click="rejectAll">Rechazar</button>
</template>

<script setup>
import { useCookies } from '@/composables/useCookies'
const { acceptAll, rejectAll } = useCookies()
</script>
```

### Verificar si un tipo de cookie está permitido

```javascript
import { useCookies } from '@/composables/useCookies'

const { isConsentGiven } = useCookies()

if (isConsentGiven('analytics')) {
  // Carga Google Analytics
}
```

### Guardar una cookie personalizada

```javascript
import { useCookie } from '@/composables/useCookies'

const myId = useCookie('my_id', 'default_value')
myId.set('new_value')
```

### Cargar Google Analytics condicionalmente

```javascript
import { loadGoogleAnalytics } from '@/utils/cookieLoaders'

// Solo carga si el usuario dio consentimiento
loadGoogleAnalytics('GA-123456789')
```

---

## 🎯 Tipos de cookies disponibles

| Tipo | Obligatoria | Descripción |
|------|-------------|-------------|
| `essential` | ✅ Sí | Autenticación, seguridad, sesión |
| `preferences` | ❌ No | Idioma, tema, accesibilidad |
| `analytics` | ❌ No | Google Analytics, Mixpanel, Hotjar |
| `marketing` | ❌ No | Facebook Pixel, Google Ads |

---

## 🔍 Obtener información del dispositivo

```javascript
import { getClientInfo } from '@/services/clientInfoService'

const info = await getClientInfo()
console.log(info)
// {
//   screen: "1920x1080",
//   viewport: "1920x1080",
//   pixelRatio: 2,
//   language: "es-MX",
//   timezone: "America/Mexico_City",
//   platform: "Win32",
//   userAgent: "Mozilla/5.0...",
//   colorDepth: 24,
//   touch: false,
//   memory: 8,
//   cpu: 8,
//   timestamp: "2024-01-15T14:30:45.123Z"
// }
```

---

## 🛡️ Datos que se guardan

Cuando el usuario da consentimiento, se crea una cookie llamada `cookie_consent` que contiene:

```json
{
  "consent": {
    "essential": true,
    "preferences": true,
    "analytics": false,
    "marketing": false
  },
  "timestamp": "2024-01-15T14:30:45.123Z",
  "version": "1.0",
  "clientInfo": {
    "screen": "1920x1080",
    "timezone": "America/Mexico_City",
    "...": "..."
  }
}
```

---

## 📱 Componentes disponibles

### `CookieBanner.vue`
- Banner flotante en la esquina inferior derecha
- 3 vistas: principal, personalizada y detallada
- Aparece automáticamente si no hay consentimiento

### `CookieSettings.vue`
- Página completa de configuración
- Detalles de cada cookie individual
- Exportar datos para auditoría GDPR
- Reset de preferencias

---

## 🚀 Carga de scripts de terceros

```javascript
import { initializeThirdPartyScripts } from '@/utils/cookieLoaders'

// En tu main App.vue o app.js
initializeThirdPartyScripts({
  googleAnalyticsId: 'GA-123456789',
  facebookPixelId: '123456789',
  hotjarSiteId: '987654',
  mixpanelToken: 'abc123',
  recaptchaKey: 'xyz789',
})
```

Cada script se carga **solo si el usuario dio consentimiento**.

---

## 🛠️ Middleware Laravel (opcional)

Protege endpoints que requieran consentimiento:

```php
// routes/web.php
Route::get('/api/analytics', fn() => response()->json([...]))
    ->middleware('validate.cookie.consent:analytics');

Route::post('/newsletter', fn() => response()->json([...]))
    ->middleware('validate.cookie.consent:marketing');
```

---

## 🎨 Personalización

### Cambiar el mensaje del banner

En `CookieBanner.vue`, busca el texto y edítalo (está hardcodeado, puede migrarse a i18n).

### Cambiar colores

En `CookieBanner.vue` y `CookieSettings.vue`, busca las clases de Tailwind:
- `bg-green-600` → verde
- `bg-blue-600` → azul
- `bg-gray-300` → gris

### Agregar nuevas cookies

En `resources/js/data/cookieConfig.js`:

```javascript
export const COOKIE_CONFIG = {
  // ... existentes
  [COOKIE_TYPES.MY_CUSTOM]: {
    id: 'my_custom',
    name: 'Mi Cookie Personalizada',
    description: 'Descripción...',
    required: false,
    enabled: false,
    cookies: [
      {
        name: 'my_cookie_name',
        domain: 'hospitalhdr.com',
        description: 'Qué hace esta cookie',
        duration: '30 días'
      }
    ]
  }
}
```

---

## 🔒 Privacy & GDPR

✅ **Consentimiento explícito** — Se guarda con timestamp  
✅ **Información del cliente** — Guardada junto con el consentimiento  
✅ **Exportar datos** — El usuario puede descargar sus datos de consentimiento  
✅ **Eliminar consentimiento** — El usuario puede resetear en cualquier momento  
✅ **Cookies esenciales permitidas** — No requieren consentimiento  

---

## ❓ Preguntas frecuentes

**P: ¿Dónde se guardan las cookies?**  
R: En el navegador del usuario, en la cookie `cookie_consent`.

**P: ¿Se envían datos al servidor?**  
R: Solo si lo implementas. El sistema es client-side por defecto, pero puedes capturar el consentimiento en el backend.

**P: ¿Funciona con GDPR?**  
R: Sí, cumple con GDPR: consentimiento previo, transparencia, derechos del usuario.

**P: ¿Cómo cambio el idioma?**  
R: Edita los strings en `CookieBanner.vue` y `CookieSettings.vue`, o integra Vue i18n.

**P: ¿Puedo usar sin el banner?**  
R: Sí, usando solo el composable `useCookies()` en tu propio componente.

---

## 📞 Soporte

Consulta `COOKIES_SETUP.md` para una guía completa.
