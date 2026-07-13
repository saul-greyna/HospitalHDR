<template>
  <Teleport to="body" v-if="showBanner">
    <div class="fixed inset-0 z-40 bg-black/50 transition-opacity" @click="showBanner = false" />
    <div
      class="fixed bottom-4 left-4 right-4 z-50 max-w-2xl rounded-lg bg-white p-6 shadow-xl md:left-auto md:right-4"
    >
      <!-- Header -->
      <div class="mb-4">
        <h2 class="text-lg font-bold text-gray-900">Gestión de Cookies</h2>
        <p class="mt-2 text-sm text-gray-600">
          Utilizamos cookies para mejorar tu experiencia en nuestro sitio. Puedes aceptar todas, rechazar todas o
          personalizar tu consentimiento.
        </p>
      </div>

      <!-- Contenido dinámico -->
      <div v-if="view === 'main'" class="space-y-3">
        <button
          @click="handleAcceptAll"
          class="w-full rounded-lg bg-green-600 px-4 py-2 text-white font-medium hover:bg-green-700 transition-colors"
        >
          Aceptar todas las cookies
        </button>
        <button
          @click="handleRejectAll"
          class="w-full rounded-lg bg-gray-200 px-4 py-2 text-gray-900 font-medium hover:bg-gray-300 transition-colors"
        >
          Rechazar todas (excepto esenciales)
        </button>
        <button
          @click="view = 'detailed'"
          class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 font-medium hover:bg-gray-50 transition-colors"
        >
          Personalizar
        </button>
      </div>

      <!-- Vista detallada -->
      <div v-if="view === 'detailed'" class="space-y-4">
        <div class="max-h-64 space-y-3 overflow-y-auto">
          <div
            v-for="cookieType in cookieTypes"
            :key="cookieType.id"
            class="rounded-lg border border-gray-200 p-4 hover:bg-gray-50 transition-colors"
          >
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <label class="flex items-center cursor-pointer">
                  <input
                    type="checkbox"
                    :checked="customConsent[cookieType.id]"
                    :disabled="cookieType.required"
                    @change="toggleCustom(cookieType.id)"
                    class="h-4 w-4 rounded border-gray-300 text-blue-600 disabled:opacity-50 cursor-pointer"
                  />
                  <span class="ml-3 font-medium text-gray-900">{{ cookieType.name }}</span>
                  <span
                    v-if="cookieType.required"
                    class="ml-2 inline-block rounded bg-red-100 px-2 py-1 text-xs font-semibold text-red-800"
                  >
                    Obligatoria
                  </span>
                </label>
                <p class="mt-1 ml-7 text-sm text-gray-600">{{ cookieType.description }}</p>

                <!-- Detalle de cookies individuales -->
                <div
                  v-if="expandedTypes.includes(cookieType.id)"
                  class="mt-3 ml-7 space-y-2 border-t border-gray-200 pt-3"
                >
                  <div
                    v-for="cookie in cookieType.cookies"
                    :key="cookie.name"
                    class="rounded bg-gray-100 p-2 text-xs text-gray-700"
                  >
                    <p class="font-semibold">{{ cookie.name }}</p>
                    <p class="text-gray-600">{{ cookie.description }}</p>
                    <p class="text-gray-500 mt-1">Duración: {{ cookie.duration }}</p>
                  </div>
                </div>

                <!-- Toggle para expandir -->
                <button
                  v-if="cookieType.cookies && cookieType.cookies.length > 0"
                  @click="toggleExpanded(cookieType.id)"
                  class="mt-2 ml-7 text-xs text-blue-600 hover:text-blue-800 font-medium"
                >
                  {{ expandedTypes.includes(cookieType.id) ? 'Ocultar detalles' : 'Ver detalles' }}
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex gap-3 border-t border-gray-200 pt-4">
          <button
            @click="view = 'main'"
            class="flex-1 rounded-lg border border-gray-300 px-4 py-2 text-gray-900 font-medium hover:bg-gray-50 transition-colors"
          >
            Atrás
          </button>
          <button
            @click="handleSaveCustom"
            class="flex-1 rounded-lg bg-blue-600 px-4 py-2 text-white font-medium hover:bg-blue-700 transition-colors"
          >
            Guardar preferencias
          </button>
        </div>
      </div>

      <!-- Footer con links -->
      <div class="mt-4 border-t border-gray-200 pt-4 text-xs text-gray-600">
        <p>
          Consulta nuestra
          <a href="/privacy-policy" class="text-blue-600 hover:text-blue-800 font-medium">Política de Privacidad</a>
          para más información sobre cómo usamos tus datos.
        </p>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useCookies } from '../composables/useCookies.js';
import { COOKIE_CONFIG, getDefaultConsentState } from '../data/cookieConfig.js';

const { showBanner, acceptAll, rejectAll, saveCustomConsent, isInitialized } = useCookies();

const view = ref('main');
const customConsent = ref(getDefaultConsentState());
const expandedTypes = ref([]);

const cookieTypes = computed(() => Object.values(COOKIE_CONFIG));

const toggleCustom = (type) => {
  if (COOKIE_CONFIG[type]?.required) return; // No permite desmarcar esenciales
  customConsent.value[type] = !customConsent.value[type];
};

const toggleExpanded = (type) => {
  if (expandedTypes.value.includes(type)) {
    expandedTypes.value = expandedTypes.value.filter((t) => t !== type);
  } else {
    expandedTypes.value.push(type);
  }
};

const handleAcceptAll = async () => {
  await acceptAll();
};

const handleRejectAll = async () => {
  await rejectAll();
};

const handleSaveCustom = async () => {
  await saveCustomConsent(customConsent.value);
  view.value = 'main';
};

onMounted(() => {
  if (isInitialized.value) {
    // Sincroniza customConsent con el estado guardado
    customConsent.value = { ...getDefaultConsentState(), ...showBanner.value };
  }
});
</script>

<style scoped>
/* Animación de entrada del banner */
@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

div:deep(.cookie-banner) {
  animation: slideUp 0.3s ease-out;
}
</style>
