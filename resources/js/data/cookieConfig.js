/**
 * Configuración de tipos de cookies y su consentimiento
 * Define qué tipos de cookies se usan en el sitio y sus propósitos
 */

export const COOKIE_TYPES = {
  ESSENTIAL: 'essential',
  ANALYTICS: 'analytics',
  MARKETING: 'marketing',
  PREFERENCES: 'preferences',
};

export const COOKIE_CONFIG = {
  // Cookies esenciales (siempre activas, legalmente permitidas)
  [COOKIE_TYPES.ESSENTIAL]: {
    id: 'essential',
    name: 'Cookies Esenciales',
    description:
      'Necesarias para el funcionamiento básico del sitio. Incluyen autenticación, seguridad y preferencias de usuario.',
    category: 'essential',
    required: true,
    enabled: true,
    cookies: [
      {
        name: 'XSRF-TOKEN',
        domain: 'hospitalhdr.com',
        description: 'Token de seguridad CSRF de Laravel',
        duration: 'Sesión',
      },
      {
        name: 'laravel_session',
        domain: 'hospitalhdr.com',
        description: 'Identificador de sesión de Laravel',
        duration: '1 hora',
      },
      {
        name: 'cookie_consent',
        domain: 'hospitalhdr.com',
        description: 'Almacena tus preferencias de consentimiento',
        duration: '1 año',
      },
      {
        name: 'scroll_position',
        domain: 'hospitalhdr.com',
        description: 'Posición de scroll en el directorio médico',
        duration: 'Sesión',
      },
    ],
  },

  // Cookies de preferencias (guardar idioma, tema, etc.)
  [COOKIE_TYPES.PREFERENCES]: {
    id: 'preferences',
    name: 'Cookies de Preferencias',
    description:
      'Recuerdan tus preferencias personales como idioma, tema o zoom para personalizar tu experiencia.',
    category: 'preferences',
    required: false,
    enabled: true,
    cookies: [
      {
        name: 'lang_preference',
        domain: 'hospitalhdr.com',
        description: 'Idioma preferido del usuario',
        duration: '1 año',
      },
      {
        name: 'theme_preference',
        domain: 'hospitalhdr.com',
        description: 'Tema de interfaz preferido (claro/oscuro)',
        duration: '1 año',
      },
      {
        name: 'accessibility_settings',
        domain: 'hospitalhdr.com',
        description: 'Configuraciones de accesibilidad',
        duration: '1 año',
      },
    ],
  },

  // Cookies de análisis (Google Analytics, Mixpanel, etc.)
  [COOKIE_TYPES.ANALYTICS]: {
    id: 'analytics',
    name: 'Cookies de Análisis',
    description:
      'Nos ayudan a entender cómo usas el sitio para mejorar su rendimiento y contenido. No se usan para publicidad.',
    category: 'analytics',
    required: false,
    enabled: false,
    cookies: [
      {
        name: '_ga',
        domain: 'hospitalhdr.com',
        description: 'Google Analytics - Identificador único de usuario',
        duration: '2 años',
      },
      {
        name: '_ga_*',
        domain: 'hospitalhdr.com',
        description: 'Google Analytics - Datos de sesión',
        duration: '2 años',
      },
      {
        name: '_gid',
        domain: 'hospitalhdr.com',
        description: 'Google Analytics - Identificador de sesión',
        duration: '24 horas',
      },
    ],
  },

  // Cookies de marketing (retargeting, publicidad, etc.)
  [COOKIE_TYPES.MARKETING]: {
    id: 'marketing',
    name: 'Cookies de Marketing',
    description:
      'Utilizadas para mostrar anuncios relevantes y rastrear campañas de marketing. Requiere consentimiento explícito.',
    category: 'marketing',
    required: false,
    enabled: false,
    cookies: [
      {
        name: '_fbp',
        domain: 'hospitalhdr.com',
        description: 'Facebook Pixel - Rastreo de conversiones',
        duration: '3 meses',
      },
      {
        name: 'fr',
        domain: 'hospitalhdr.com',
        description: 'Facebook - Publicidad e identificación',
        duration: '3 meses',
      },
      {
        name: '__gads',
        domain: 'hospitalhdr.com',
        description: 'Google Ads - Rastreo de publicidad',
        duration: '2 años',
      },
    ],
  },
};

/**
 * Obtén la configuración de un tipo de cookie
 */
export function getCookieTypeConfig(type) {
  return COOKIE_CONFIG[type];
}

/**
 * Obtén todos los tipos de cookies como array
 */
export function getAllCookieTypes() {
  return Object.values(COOKIE_CONFIG);
}

/**
 * Obtén solo las cookies no esenciales
 */
export function getNonEssentialCookieTypes() {
  return getAllCookieTypes().filter((type) => !type.required);
}

/**
 * Convierte la configuración a un objeto de consentimiento
 */
export function getDefaultConsentState() {
  const consent = {};
  Object.values(COOKIE_CONFIG).forEach((config) => {
    consent[config.id] = config.enabled;
  });
  return consent;
}

/**
 * Validar un objeto de consentimiento contra la configuración
 */
export function validateConsentObject(consent) {
  const isValid =
    typeof consent === 'object' &&
    Object.keys(COOKIE_CONFIG).every((key) => key in consent);
  return isValid;
}
