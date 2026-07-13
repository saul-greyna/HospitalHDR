/**
 * Servicio de gestión de consentimiento de cookies
 * Maneja el almacenamiento, validación y aplicación de preferencias de consentimiento
 */

import { getCookie, setCookie, deleteCookie, hasCookie } from './cookieService.js';
import { COOKIE_CONFIG, getDefaultConsentState, validateConsentObject } from '../data/cookieConfig.js';
import { getClientInfo } from './clientInfoService.js';

const CONSENT_COOKIE_NAME = 'cookie_consent';
const CONSENT_COOKIE_CONFIG = {
  days: 365,
  path: '/',
  secure: window.location.protocol === 'https:',
  sameSite: 'Lax',
};

/**
 * Guarda el consentimiento de cookies
 * @param {object} consent - Objeto con consentimiento {essential: true, analytics: false, ...}
 * @param {boolean} shouldLogClientInfo - Si debe guardar información del cliente
 */
export async function setConsent(consent, shouldLogClientInfo = false) {
  if (!validateConsentObject(consent)) {
    throw new Error('Objeto de consentimiento inválido');
  }

  const consentData = {
    consent,
    timestamp: new Date().toISOString(),
    version: '1.0',
  };

  // Opcionalmente, guarda información del cliente con el consentimiento
  if (shouldLogClientInfo) {
    try {
      consentData.clientInfo = await getClientInfo();
    } catch (error) {
      console.warn('No se pudo recopilar información del cliente:', error);
    }
  }

  setCookie(CONSENT_COOKIE_NAME, consentData, CONSENT_COOKIE_CONFIG);
  return consentData;
}

/**
 * Obtén el consentimiento guardado
 * @returns {object|null} - Objeto de consentimiento o null si no existe
 */
export function getConsent() {
  return getCookie(CONSENT_COOKIE_NAME);
}

/**
 * Obtén solo el estado de consentimiento (sin timestamp, clientInfo, etc.)
 * @returns {object|null}
 */
export function getConsentState() {
  const consentData = getConsent();
  return consentData ? consentData.consent : null;
}

/**
 * Verifica si el usuario ha dado su consentimiento
 * @returns {boolean}
 */
export function hasGivenConsent() {
  return hasCookie(CONSENT_COOKIE_NAME);
}

/**
 * Verifica si un tipo específico de cookie está permitido
 * @param {string} type - Tipo de cookie (essential, analytics, marketing, preferences)
 * @returns {boolean}
 */
export function isConsentGiven(type) {
  const consent = getConsentState();
  if (!consent) {
    // Si no hay consentimiento guardado, asume que solo las esenciales están permitidas
    return type === 'essential';
  }
  return consent[type] === true;
}

/**
 * Acepta todas las cookies
 * @param {boolean} shouldLogClientInfo
 */
export async function acceptAllCookies(shouldLogClientInfo = true) {
  const consent = getDefaultConsentState();
  Object.keys(consent).forEach((key) => {
    consent[key] = true;
  });
  return setConsent(consent, shouldLogClientInfo);
}

/**
 * Rechaza todas las cookies excepto las esenciales
 * @param {boolean} shouldLogClientInfo
 */
export async function rejectAllCookies(shouldLogClientInfo = true) {
  const consent = getDefaultConsentState();
  // Solo las esenciales quedan en true
  Object.keys(consent).forEach((key) => {
    if (key !== 'essential') {
      consent[key] = false;
    }
  });
  return setConsent(consent, shouldLogClientInfo);
}

/**
 * Actualiza el consentimiento de forma selectiva
 * @param {object} partialConsent - Objeto parcial con cambios {analytics: true, ...}
 * @param {boolean} shouldLogClientInfo
 */
export async function updateConsent(partialConsent, shouldLogClientInfo = false) {
  const current = getConsentState() || getDefaultConsentState();
  const updated = { ...current, ...partialConsent };
  return setConsent(updated, shouldLogClientInfo);
}

/**
 * Elimina el consentimiento guardado (resetea a estado inicial)
 */
export function removeConsent() {
  deleteCookie(CONSENT_COOKIE_NAME);
}

/**
 * Obtén un resumen del consentimiento en lenguaje natural
 * @returns {object} - {accepted: [...], rejected: [...]}
 */
export function getConsentSummary() {
  const consent = getConsentState() || getDefaultConsentState();
  const summary = {
    accepted: [],
    rejected: [],
  };

  Object.entries(consent).forEach(([type, isAccepted]) => {
    const config = COOKIE_CONFIG[type];
    if (config) {
      if (isAccepted) {
        summary.accepted.push(config.name);
      } else if (!config.required) {
        summary.rejected.push(config.name);
      }
    }
  });

  return summary;
}

/**
 * Exporta el consentimiento como JSON (para auditoría/GDPR)
 * @returns {object}
 */
export function exportConsentData() {
  const consentData = getConsent();
  if (!consentData) {
    return {
      status: 'no_consent_recorded',
      timestamp: new Date().toISOString(),
    };
  }

  return {
    status: 'consent_recorded',
    ...consentData,
  };
}

/**
 * Reinicia las preferencias a las opciones por defecto
 */
export async function resetConsentDefaults() {
  const defaultConsent = getDefaultConsentState();
  return setConsent(defaultConsent);
}
