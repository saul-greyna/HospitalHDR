/**
 * Utilidades para cargar scripts de terceros condicionalmente
 * basados en el consentimiento de cookies
 */

import { isConsentGiven } from '../services/consentService.js';

/**
 * Carga Google Analytics si el usuario lo permite
 */
export function loadGoogleAnalytics(googleAnalyticsId) {
  if (!isConsentGiven('analytics')) {
    console.log('Analytics deshabilitado: sin consentimiento');
    return;
  }

  if (!googleAnalyticsId) {
    console.warn('Google Analytics ID no configurado');
    return;
  }

  // Desactiva la recopilación de datos si no hay consentimiento
  window['ga-disable-' + googleAnalyticsId] = !isConsentGiven('analytics');

  // Carga el script de Google Analytics
  const script = document.createElement('script');
  script.async = true;
  script.src = `https://www.googletagmanager.com/gtag/js?id=${googleAnalyticsId}`;
  document.head.appendChild(script);

  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', googleAnalyticsId, {
    anonymize_ip: true, // Anonimiza IPs para privacidad
    allow_google_signals: isConsentGiven('marketing'),
    allow_ad_personalization_signals: isConsentGiven('marketing'),
  });

  window.gtag = gtag;
}

/**
 * Carga Facebook Pixel si el usuario lo permite
 */
export function loadFacebookPixel(pixelId) {
  if (!isConsentGiven('marketing')) {
    console.log('Facebook Pixel deshabilitado: sin consentimiento');
    return;
  }

  if (!pixelId) {
    console.warn('Facebook Pixel ID no configurado');
    return;
  }

  const script = document.createElement('script');
  script.innerHTML = `
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '${pixelId}');
    fbq('track', 'PageView');
  `;
  document.head.appendChild(script);

  window.fbq =
    window.fbq ||
    function () {
      (window.fbq.q = window.fbq.q || []).push(arguments);
    };
}

/**
 * Carga Hotjar si el usuario lo permite
 */
export function loadHotjar(hotjarSiteId) {
  if (!isConsentGiven('analytics')) {
    console.log('Hotjar deshabilitado: sin consentimiento');
    return;
  }

  if (!hotjarSiteId) {
    console.warn('Hotjar Site ID no configurado');
    return;
  }

  window.hj =
    window.hj ||
    function () {
      (window.hj.q = window.hj.q || []).push(arguments);
    };
  window.hjSettings = { hjid: hotjarSiteId, hjsv: 6 };

  const script = document.createElement('script');
  script.async = true;
  script.src = `https://static.hotjar.com/c/hotjar-${hotjarSiteId}.js`;
  document.head.appendChild(script);
}

/**
 * Carga Mixpanel si el usuario lo permite
 */
export function loadMixpanel(mixpanelToken) {
  if (!isConsentGiven('analytics')) {
    console.log('Mixpanel deshabilitado: sin consentimiento');
    return;
  }

  if (!mixpanelToken) {
    console.warn('Mixpanel token no configurado');
    return;
  }

  window.mixpanel = window.mixpanel || [];
  window.mixpanel.push(['init', mixpanelToken]);

  const script = document.createElement('script');
  script.type = 'text/javascript';
  script.async = true;
  script.src = 'https://cdn.mxpnl.com/libs/mixpanel-latest.min.js';
  document.head.appendChild(script);
}

/**
 * Carga reCAPTCHA si el usuario lo permite (considerado no-personalizado)
 */
export function loadRecaptcha(recaptchaKey, options = {}) {
  // reCAPTCHA se considera esencial ya que es necesario para seguridad
  if (!recaptchaKey) {
    console.warn('reCAPTCHA key no configurada');
    return;
  }

  const script = document.createElement('script');
  script.src = `https://www.google.com/recaptcha/api.js?render=${recaptchaKey}`;
  script.async = true;
  script.defer = true;
  document.head.appendChild(script);

  window.grecaptcha =
    window.grecaptcha ||
    function () {
      console.warn('reCAPTCHA no está listo');
    };
}

/**
 * Carga Sentry (error tracking) si el usuario lo permite
 */
export function loadSentry(sentryDsn, environment = 'production') {
  if (!isConsentGiven('analytics')) {
    console.log('Sentry deshabilitado: sin consentimiento');
    return;
  }

  if (!sentryDsn) {
    console.warn('Sentry DSN no configurado');
    return;
  }

  const script = document.createElement('script');
  script.src = 'https://browser.sentry-cdn.com/7.0.0/bundle.min.js';
  script.integrity = 'sha384-...'; // Reemplaza con el integrity correcto
  script.crossOrigin = 'anonymous';
  script.onload = () => {
    window.Sentry.init({
      dsn: sentryDsn,
      environment: environment,
      tracesSampleRate: 0.1,
    });
  };
  document.head.appendChild(script);
}

/**
 * Servicio centralizado de carga de scripts
 * Carga todos los scripts permitidos por consentimiento
 */
export function initializeThirdPartyScripts(config = {}) {
  const {
    googleAnalyticsId = null,
    facebookPixelId = null,
    hotjarSiteId = null,
    mixpanelToken = null,
    recaptchaKey = null,
    sentryDsn = null,
  } = config;

  // Carga condicional de scripts
  if (googleAnalyticsId) {
    loadGoogleAnalytics(googleAnalyticsId);
  }

  if (facebookPixelId) {
    loadFacebookPixel(facebookPixelId);
  }

  if (hotjarSiteId) {
    loadHotjar(hotjarSiteId);
  }

  if (mixpanelToken) {
    loadMixpanel(mixpanelToken);
  }

  if (recaptchaKey) {
    loadRecaptcha(recaptchaKey);
  }

  if (sentryDsn) {
    loadSentry(sentryDsn);
  }

  console.log('Scripts de terceros cargados según consentimiento');
}

/**
 * Rastrear evento personalizado con Google Analytics
 */
export function trackEvent(eventName, eventParams = {}) {
  if (!isConsentGiven('analytics') || !window.gtag) {
    return;
  }

  window.gtag('event', eventName, eventParams);
}

/**
 * Rastrear evento con Facebook Pixel
 */
export function trackPixelEvent(eventName, eventParams = {}) {
  if (!isConsentGiven('marketing') || !window.fbq) {
    return;
  }

  window.fbq('track', eventName, eventParams);
}
