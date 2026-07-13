/**
 * Servicio de gestión de cookies
 * Proporciona métodos para leer, escribir y eliminar cookies con opciones avanzadas
 */

/**
 * Escribe una cookie
 * @param {string} name - Nombre de la cookie
 * @param {string|object} value - Valor de la cookie
 * @param {object} options - Opciones de la cookie
 * @param {number} options.days - Días de expiración (por defecto 365)
 * @param {string} options.path - Ruta de la cookie (por defecto '/')
 * @param {string} options.domain - Dominio de la cookie
 * @param {boolean} options.secure - Cookie HTTPS only (por defecto true en producción)
 * @param {string} options.sameSite - Política SameSite (Strict, Lax, None)
 */
export function setCookie(name, value, options = {}) {
  const {
    days = 365,
    path = '/',
    domain = undefined,
    secure = window.location.protocol === 'https:',
    sameSite = 'Lax',
  } = options;

  let cookieString = `${encodeURIComponent(name)}=${encodeURIComponent(
    typeof value === 'object' ? JSON.stringify(value) : value
  )}`;

  // Fecha de expiración
  if (days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    cookieString += `; expires=${date.toUTCString()}`;
  }

  // Path
  if (path) {
    cookieString += `; path=${path}`;
  }

  // Domain
  if (domain) {
    cookieString += `; domain=${domain}`;
  }

  // Secure
  if (secure) {
    cookieString += '; secure';
  }

  // SameSite
  if (sameSite) {
    cookieString += `; samesite=${sameSite}`;
  }

  document.cookie = cookieString;
}

/**
 * Lee una cookie
 * @param {string} name - Nombre de la cookie
 * @returns {string|object|null} - Valor de la cookie o null si no existe
 */
export function getCookie(name) {
  const nameEQ = encodeURIComponent(name) + '=';
  const cookies = document.cookie.split(';');

  for (let cookie of cookies) {
    cookie = cookie.trim();
    if (cookie.indexOf(nameEQ) === 0) {
      const value = cookie.substring(nameEQ.length);
      try {
        // Intenta parsear como JSON
        return JSON.parse(decodeURIComponent(value));
      } catch (e) {
        // Si no es JSON, devuelve como string
        return decodeURIComponent(value);
      }
    }
  }

  return null;
}

/**
 * Obtén todas las cookies como un objeto
 * @returns {object} - Todas las cookies disponibles
 */
export function getAllCookies() {
  const cookies = {};
  const cookieArray = document.cookie.split(';');

  for (let cookie of cookieArray) {
    cookie = cookie.trim();
    if (cookie) {
      const [name, value] = cookie.split('=');
      try {
        cookies[decodeURIComponent(name)] = JSON.parse(decodeURIComponent(value));
      } catch (e) {
        cookies[decodeURIComponent(name)] = decodeURIComponent(value);
      }
    }
  }

  return cookies;
}

/**
 * Elimina una cookie
 * @param {string} name - Nombre de la cookie
 * @param {object} options - Opciones (path, domain)
 */
export function deleteCookie(name, options = {}) {
  const { path = '/', domain = undefined } = options;

  let cookieString = `${encodeURIComponent(name)}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=${path}`;

  if (domain) {
    cookieString += `; domain=${domain}`;
  }

  document.cookie = cookieString;
}

/**
 * Limpia todas las cookies
 * @param {array} exclude - Lista de nombres de cookies a NO eliminar
 */
export function clearAllCookies(exclude = []) {
  const cookies = document.cookie.split(';');

  for (let cookie of cookies) {
    const name = cookie.split('=')[0].trim();
    if (!exclude.includes(name)) {
      deleteCookie(name);
    }
  }
}

/**
 * Verifica si una cookie existe
 * @param {string} name - Nombre de la cookie
 * @returns {boolean}
 */
export function hasCookie(name) {
  return getCookie(name) !== null;
}

/**
 * Actualiza el valor de una cookie manteniendo sus opciones
 * @param {string} name - Nombre de la cookie
 * @param {string|object} value - Nuevo valor
 */
export function updateCookie(name, value) {
  const existing = getCookie(name);
  if (existing !== null) {
    setCookie(name, value);
  }
}

/**
 * Extiende la expiración de una cookie
 * @param {string} name - Nombre de la cookie
 * @param {number} days - Días adicionales (por defecto 365)
 */
export function extendCookieExpiration(name, days = 365) {
  const value = getCookie(name);
  if (value !== null) {
    setCookie(name, value, { days });
  }
}
