<template>
  <div class="rounded-lg border border-gray-200 bg-white p-6">
    <!-- Encabezado -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-900">Configuración de Cookies</h1>
      <p class="mt-2 text-gray-600">
        Controla qué tipos de cookies permitimos usar en tu navegador. Las cookies esenciales no pueden deshabilitarse
        ya que son necesarias para el funcionamiento del sitio.
      </p>
    </div>

    <!-- Estado actual del consentimiento -->
    <div v-if="consentStatus" class="mb-6 rounded-lg bg-blue-50 p-4 border border-blue-200">
      <p class="text-sm text-blue-900">
        <strong>Consentimiento registrado el:</strong> {{ formatDate(consentStatus.timestamp) }}
      </p>
      <p v-if="consentStatus.clientInfo" class="mt-1 text-xs text-blue-800">
        <strong>Dispositivo:</strong> {{ consentStatus.clientInfo.screen }} •
        {{ consentStatus.clientInfo.timezone }}
      </p>
    </div>

    <!-- Sección de cookies -->
    <div class="space-y-6">
      <div
        v-for="cookieType in cookieTypes"
        :key="cookieType.id"
        class="rounded-lg border border-gray-200 p-5 transition-all hover:shadow-md"
      >
        <!-- Encabezado del tipo de cookie -->
        <div class="flex items-start justify-between mb-4">
          <div class="flex-1">
            <div class="flex items-center gap-2">
              <h3 class="text-lg font-semibold text-gray-900">{{ cookieType.name }}</h3>
              <span
                v-if="cookieType.required"
                class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-800"
              >
                Obligatoria
              </span>
              <span
                v-else
                :class="{
                  'bg-green-100 text-green-800': localConsent[cookieType.id],
                  'bg-gray-100 text-gray-800': !localConsent[cookieType.id],
                }"
                class="inline-block rounded-full px-3 py-1 text-xs font-bold"
              >
                {{ localConsent[cookieType.id] ? 'Habilitada' : 'Deshabilitada' }}
              </span>
            </div>
            <p class="mt-2 text-sm text-gray-600">{{ cookieType.description }}</p>
          </div>

          <!-- Toggle switch -->
          <div class="ml-4 flex items-center">
            <label
              :class="{
                'opacity-50 cursor-not-allowed': cookieType.required,
              }"
              class="relative inline-flex items-center cursor-pointer"
            >
              <input
                type="checkbox"
                :checked="localConsent[cookieType.id]"
                :disabled="cookieType.required"
                @change="toggleConsent(cookieType.id)"
                class="sr-only peer"
              />
              <div
                :class="{
                  'bg-green-600 after:translate-x-full': localConsent[cookieType.id],
                  'bg-gray-300': !localConsent[cookieType.id],
                }"
                class="h-6 w-11 rounded-full bg-gray-300 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-['']"
              />
            </label>
          </div>
        </div>

        <!-- Cookies individuales -->
        <div v-if="cookieType.cookies && cookieType.cookies.length > 0" class="space-y-2">
          <button
            @click="toggleExpanded(cookieType.id)"
            class="text-xs text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1"
          >
            <span>{{ expandedTypes.includes(cookieType.id) ? '▼' : '▶' }}</span>
            {{ expandedTypes.includes(cookieType.id) ? 'Ocultar' : 'Ver' }} cookies individuales
          </button>

          <Transition name="expand">
            <div
              v-if="expandedTypes.includes(cookieType.id)"
              class="mt-4 space-y-2 border-t border-gray-200 pt-4"
            >
              <div
                v-for="cookie in cookieType.cookies"
                :key="cookie.name"
                class="rounded bg-gray-50 p-3 border border-gray-200"
              >
                <div class="flex items-start justify-between">
                  <div class="flex-1">
                    <p class="font-mono text-xs font-semibold text-gray-900">{{ cookie.name }}</p>
                    <p class="mt-1 text-xs text-gray-700">{{ cookie.description }}</p>
                    <div class="mt-2 flex items-center gap-4 text-xs text-gray-500">
                      <span><strong>Dominio:</strong> {{ cookie.domain }}</span>
                      <span><strong>Duración:</strong> {{ cookie.duration }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </Transition>
        </div>
      </div>
    </div>

    <!-- Botones de acción -->
    <div class="mt-8 flex flex-wrap gap-3 border-t border-gray-200 pt-6">
      <button
        @click="handleSave"
        class="rounded-lg bg-blue-600 px-6 py-2 text-white font-medium hover:bg-blue-700 transition-colors"
      >
        Guardar preferencias
      </button>
      <button
        @click="handleAcceptAll"
        class="rounded-lg bg-green-600 px-6 py-2 text-white font-medium hover:bg-green-700 transition-colors"
      >
        Aceptar todas
      </button>
      <button
        @click="handleRejectAll"
        class="rounded-lg border border-gray-300 px-6 py-2 text-gray-900 font-medium hover:bg-gray-50 transition-colors"
      >
        Rechazar todas (excepto esenciales)
      </button>
      <button
        @click="handleReset"
        class="rounded-lg border border-red-300 px-6 py-2 text-red-900 font-medium hover:bg-red-50 transition-colors"
      >
        Resetear
      </button>
    </div>

    <!-- Información de privacidad -->
    <div class="mt-8 rounded-lg bg-gray-50 p-4 border border-gray-200">
      <h4 class="font-semibold text-gray-900">Más información</h4>
      <ul class="mt-3 space-y-2 text-sm text-gray-700">
        <li>
          📋
          <a href="/privacy-policy" class="text-blue-600 hover:text-blue-800">Política de Privacidad</a>
        </li>
        <li>
          📄
          <a href="/terms" class="text-blue-600 hover:text-blue-800">Términos de Uso</a>
        </li>
        <li>
          ⚖️
          <a href="/legal" class="text-blue-600 hover:text-blue-800">Información Legal</a>
        </li>
        <li>
          💾 Tu datos de consentimiento pueden ser exportados para auditoría de GDPR
          <button @click="handleExport" class="ml-2 text-blue-600 hover:text-blue-800 font-medium">
            Exportar
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useCookies } from '../composables/useCookies.js';
import { COOKIE_CONFIG, getDefaultConsentState } from '../data/cookieConfig.js';

const { acceptAll, rejectAll, saveCustomConsent, resetConsent, exportConsentData, isInitialized } = useCookies();

const localConsent = ref(getDefaultConsentState());
const expandedTypes = ref([]);
const consentStatus = ref(null);

const cookieTypes = computed(() => Object.values(COOKIE_CONFIG));

const toggleConsent = (type) => {
  if (COOKIE_CONFIG[type]?.required) return;
  localConsent.value[type] = !localConsent.value[type];
};

const toggleExpanded = (type) => {
  if (expandedTypes.value.includes(type)) {
    expandedTypes.value = expandedTypes.value.filter((t) => t !== type);
  } else {
    expandedTypes.value.push(type);
  }
};

const handleSave = async () => {
  await saveCustomConsent(localConsent.value);
  alert('Preferencias guardadas correctamente');
};

const handleAcceptAll = async () => {
  await acceptAll();
  localConsent.value = getDefaultConsentState();
  Object.keys(localConsent.value).forEach((key) => {
    localConsent.value[key] = true;
  });
  alert('Todas las cookies han sido aceptadas');
};

const handleRejectAll = async () => {
  await rejectAll();
  localConsent.value = getDefaultConsentState();
  Object.keys(localConsent.value).forEach((key) => {
    if (key !== 'essential') {
      localConsent.value[key] = false;
    }
  });
  alert('Cookies rechazadas (excepto esenciales)');
};

const handleReset = async () => {
  if (confirm('¿Estás seguro de que deseas resetear tus preferencias?')) {
    await resetConsent();
    localConsent.value = getDefaultConsentState();
    consentStatus.value = null;
  }
};

const handleExport = () => {
  const data = exportConsentData();
  const json = JSON.stringify(data, null, 2);
  const blob = new Blob([json], { type: 'application/json' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = `cookie-consent-${new Date().toISOString().split('T')[0]}.json`;
  a.click();
  URL.revokeObjectURL(url);
};

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleString('es-MX');
};

onMounted(() => {
  if (isInitialized.value) {
    consentStatus.value = exportConsentData();
    const saved = exportConsentData();
    if (saved.status === 'consent_recorded') {
      Object.assign(localConsent.value, saved.consent);
    }
  }
});
</script>

<style scoped>
.expand-enter-active,
.expand-leave-active {
  transition: all 0.3s ease;
}

.expand-enter-from {
  opacity: 0;
  max-height: 0;
}

.expand-leave-to {
  opacity: 0;
  max-height: 0;
}
</style>
