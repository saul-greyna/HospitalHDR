/**
 * Composable de Vue 3 para manejo de cookies y consentimiento
 * Proporciona una interfaz reactiva para gestionar cookies en componentes Vue
 */

import { ref, computed, reactive, watch } from 'vue';
import * as cookieService from '../services/cookieService.js';
import * as consentService from '../services/consentService.js';
import { COOKIE_CONFIG, getDefaultConsentState } from '../data/cookieConfig.js';

/**
 * Estado global reactivo de consentimiento
 */
const globalConsentState = reactive({
  isInitialized: false,
  consent: getDefaultConsentState(),
  hasUserConsented: false,
  showBanner: false,
});

/**
 * Inicializa el estado de consentimiento desde localStorage/cookies
 */
function initializeConsent() {
  if (globalConsentState.isInitialized) return;

  const savedConsent = consentService.getConsentState();

  if (savedConsent) {
    globalConsentState.consent = savedConsent;
    globalConsentState.hasUserConsented = true;
    globalConsentState.showBanner = false;
  } else {
    globalConsentState.consent = getDefaultConsentState();
    globalConsentState.hasUserConsented = false;
    globalConsentState.showBanner = true;
  }

  globalConsentState.isInitialized = true;
}

/**
 * Hook principal para usar cookies en componentes
 */
export function useCookies() {
  // Inicializa en la primera llamada
  if (!globalConsentState.isInitialized) {
    initializeConsent();
  }

  // Referencias reactivas
  const consent = computed(() => globalConsentState.consent);
  const hasUserConsented = computed(() => globalConsentState.hasUserConsented);
  const showBanner = computed(() => globalConsentState.showBanner);
  const isInitialized = computed(() => globalConsentState.isInitialized);

  /**
   * Acepta todas las cookies
   */
  const acceptAll = async () => {
    await consentService.acceptAllCookies(true);
    globalConsentState.consent = consentService.getConsentState();
    globalConsentState.hasUserConsented = true;
    globalConsentState.showBanner = false;
    return true;
  };

  /**
   * Rechaza todas las cookies excepto esenciales
   */
  const rejectAll = async () => {
    await consentService.rejectAllCookies(true);
    globalConsentState.consent = consentService.getConsentState();
    globalConsentState.hasUserConsented = true;
    globalConsentState.showBanner = false;
    return true;
  };

  /**
   * Guarda consentimiento personalizado
   */
  const saveCustomConsent = async (customConsent) => {
    await consentService.setConsent(customConsent, true);
    globalConsentState.consent = consentService.getConsentState();
    globalConsentState.hasUserConsented = true;
    globalConsentState.showBanner = false;
    return true;
  };

  /**
   * Actualiza un tipo de cookie específico
   */
  const toggleCookieType = async (type, value) => {
    const updated = { ...globalConsentState.consent, [type]: value };
    await consentService.updateConsent(updated, false);
    globalConsentState.consent = consentService.getConsentState();
    return true;
  };

  /**
   * Verifica si un tipo de cookie está permitido
   */
  const isConsentGiven = (type) => consentService.isConsentGiven(type);

  /**
   * Muestra el banner nuevamente (para permitir cambiar preferencias)
   */
  const showConsentBanner = () => {
    globalConsentState.showBanner = true;
  };

  /**
   * Reinicia todas las preferencias
   */
  const resetConsent = async () => {
    consentService.removeConsent();
    globalConsentState.consent = getDefaultConsentState();
    globalConsentState.hasUserConsented = false;
    globalConsentState.showBanner = true;
    return true;
  };

  /**
   * Obtén un resumen del consentimiento
   */
  const getConsentSummary = () => consentService.getConsentSummary();

  /**
   * Obtén información exportable del consentimiento (para GDPR)
   */
  const exportConsentData = () => consentService.exportConsentData();

  return {
    // Estado
    consent,
    hasUserConsented,
    showBanner,
    isInitialized,

    // Métodos
    acceptAll,
    rejectAll,
    saveCustomConsent,
    toggleCookieType,
    isConsentGiven,
    showConsentBanner,
    resetConsent,
    getConsentSummary,
    exportConsentData,

    // Servicios subyacentes
    cookieService,
    consentService,
  };
}

/**
 * Hook para gestionar cookies individuales
 */
export function useCookie(name, initialValue = null) {
  const value = ref(initialValue ?? cookieService.getCookie(name));

  const set = (newValue) => {
    value.value = newValue;
    cookieService.setCookie(name, newValue);
  };

  const get = () => {
    const fresh = cookieService.getCookie(name);
    if (fresh !== null) {
      value.value = fresh;
    }
    return value.value;
  };

  const remove = () => {
    cookieService.deleteCookie(name);
    value.value = null;
  };

  const exists = () => cookieService.hasCookie(name);

  // Vigila cambios en otra pestaña/ventana
  const handleStorageChange = () => {
    const fresh = cookieService.getCookie(name);
    if (fresh !== value.value) {
      value.value = fresh;
    }
  };

  return {
    value: computed({
      get: () => value.value,
      set,
    }),
    set,
    get,
    remove,
    exists,
    handleStorageChange,
  };
}

/**
 * Hook para gestionar un grupo de cookies relacionadas
 */
export function useCookieGroup(groupName, initialState = {}) {
  const state = reactive(initialState);

  const save = () => {
    cookieService.setCookie(groupName, state);
  };

  const load = () => {
    const stored = cookieService.getCookie(groupName);
    if (stored && typeof stored === 'object') {
      Object.assign(state, stored);
    }
  };

  const clear = () => {
    cookieService.deleteCookie(groupName);
    Object.keys(state).forEach((key) => {
      state[key] = null;
    });
  };

  const reset = (newState = initialState) => {
    Object.assign(state, newState);
    save();
  };

  // Carga inicial
  load();

  // Auto-guarda cambios
  watch(state, save, { deep: true });

  return {
    state: computed(() => state),
    save,
    load,
    clear,
    reset,
  };
}

/**
 * Plugin de Vue para inyectar el composable globalmente
 */
export const cookiePlugin = {
  install(app) {
    // Inicializa consentimiento al instalar
    initializeConsent();

    // Proporciona los composables globalmente
    app.config.globalProperties.$useCookies = useCookies;
    app.config.globalProperties.$useCookie = useCookie;
    app.config.globalProperties.$cookieService = cookieService;
    app.config.globalProperties.$consentService = consentService;

    // Inyecta el estado global
    app.provide('globalConsentState', globalConsentState);
  },
};
