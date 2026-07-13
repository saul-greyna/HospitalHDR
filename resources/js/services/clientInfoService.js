export async function getClientInfo() {
  const info = {
    screen: `${window.screen.width}x${window.screen.height}`,
    viewport: `${window.innerWidth}x${window.innerHeight}`,
    pixelRatio: window.devicePixelRatio,
    language: navigator.language,
    languages: navigator.languages.join(', '),
    platform: navigator.userAgentData?.platform || navigator.platform,
    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
    userAgent: navigator.userAgent,
    colorDepth: screen.colorDepth,
    touch: navigator.maxTouchPoints > 0,
    memory: navigator.deviceMemory || 'unknown',
    cpu: navigator.hardwareConcurrency || 'unknown',
    timestamp: new Date().toISOString(),
  };

  // High Entropy Values (requiere user agent client hints)
  if (navigator.userAgentData) {
    try {
      const hints = await navigator.userAgentData.getHighEntropyValues([
        'platformVersion',
        'architecture',
        'model',
        'uaFullVersion',
      ]);
      Object.assign(info, hints);
    } catch (error) {
      console.warn('No se pudieron obtener High Entropy Values:', error);
      info.highEntropyError = error.message;
    }
  }

  // Información adicional
  info.cookieEnabled = navigator.cookieEnabled;
  info.doNotTrack = navigator.doNotTrack;
  info.onLine = navigator.onLine;

  return info;
}

/**
 * Obtén solo la información de dispositivo (sin User Agent, por privacidad)
 */
export function getDeviceInfo() {
  return {
    screen: `${window.screen.width}x${window.screen.height}`,
    viewport: `${window.innerWidth}x${window.innerHeight}`,
    pixelRatio: window.devicePixelRatio,
    colorDepth: screen.colorDepth,
    touch: navigator.maxTouchPoints > 0,
    memory: navigator.deviceMemory || 'unknown',
    cpu: navigator.hardwareConcurrency || 'unknown',
  };
}

/**
 * Obtén información de navegación
 */
export function getBrowserInfo() {
  return {
    language: navigator.language,
    languages: navigator.languages.join(', '),
    platform: navigator.userAgentData?.platform || navigator.platform,
    userAgent: navigator.userAgent,
    cookieEnabled: navigator.cookieEnabled,
    onLine: navigator.onLine,
  };
}

/**
 * Obtén información de zona horaria y localización
 */
export function getLocaleInfo() {
  const dateFormatter = Intl.DateTimeFormat();
  const timeFormatter = Intl.DateTimeFormat('en-US', {
    hour12: false,
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
  });

  return {
    timezone: dateFormatter.resolvedOptions().timeZone,
    locale: navigator.language,
    timestamp: new Date().toISOString(),
    currentTime: timeFormatter.format(new Date()),
  };
}
