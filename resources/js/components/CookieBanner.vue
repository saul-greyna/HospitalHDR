<template>
  <Teleport to="body" v-if="showBanner">
    <div class="fixed inset-0 z-40 transition-opacity bg-black/50" @click="showBanner = false" />
    <div class="fixed z-50 max-w-2xl p-6 bg-white rounded-lg shadow-xl bottom-4 left-4 right-4 md:left-auto md:right-4">
      <header class="mb-4">
        <h2 class="text-lg font-bold text-gray-900">Gestión de Cookies</h2>
        <p class="mt-2 text-sm text-gray-600">
          Utilizamos cookies para mejorar tu experiencia en nuestro sitio. Puedes aceptar todas, rechazar todas o
          personalizar tu consentimiento.
        </p>
      </header>
      <article v-if="view === 'main'" class="space-y-3">
        <button @click="handleAcceptAll"
          class="w-full px-4 py-2 font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
          Aceptar todas las cookies
        </button>
        <button @click="handleRejectAll"
          class="w-full px-4 py-2 font-medium text-gray-900 transition-colors bg-gray-200 rounded-lg hover:bg-gray-300">
          Rechazar todas (excepto esenciales)
        </button>
        <button @click="view = 'detailed'"
          class="w-full px-4 py-2 font-medium text-gray-900 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50">
          Personalizar
        </button>
      </article>
      <ul v-if="view === 'detailed'" class="space-y-4">
        <div class="space-y-3 overflow-y-auto max-h-64">
          <div v-for="cookieType in cookieTypes" :key="cookieType.id"
            class="p-4 transition-colors border border-gray-200 rounded-lg hover:bg-gray-50">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <label class="flex items-center cursor-pointer">
                  <input type="checkbox" :checked="customConsent[cookieType.id]" :disabled="cookieType.required"
                    @change="toggleCustom(cookieType.id)"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded cursor-pointer disabled:opacity-50" />
                  <span class="ml-3 font-medium text-gray-900">{{ cookieType.name }}</span>
                  <span v-if="cookieType.required"
                    class="inline-block px-2 py-1 ml-2 text-xs font-semibold text-red-800 bg-red-100 rounded">
                    Obligatoria
                  </span>
                </label>
                <p class="mt-1 text-sm text-gray-600 ml-7">{{ cookieType.description }}</p>
                <div v-if="expandedTypes.includes(cookieType.id)"
                  class="pt-3 mt-3 space-y-2 border-t border-gray-200 ml-7">
                  <div v-for="cookie in cookieType.cookies" :key="cookie.name"
                    class="p-2 text-xs text-gray-700 bg-gray-100 rounded">
                    <p class="font-semibold">{{ cookie.name }}</p>
                    <p class="text-gray-600">{{ cookie.description }}</p>
                    <p class="mt-1 text-gray-500">Duración: {{ cookie.duration }}</p>
                  </div>
                </div>
                <button v-if="cookieType.cookies && cookieType.cookies.length > 0"
                  @click="toggleExpanded(cookieType.id)"
                  class="mt-2 text-xs font-medium text-blue-600 ml-7 hover:text-blue-800">
                  {{ expandedTypes.includes(cookieType.id) ? 'Ocultar detalles' : 'Ver detalles' }}
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-200">
          <button @click="view = 'main'"
            class="flex-1 px-4 py-2 font-medium text-gray-900 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50">
            Atrás
          </button>
          <button @click="handleSaveCustom"
            class="flex-1 px-4 py-2 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
            Guardar preferencias
          </button>
        </div>
      </ul>
      <footer class="pt-4 mt-4 text-xs text-gray-600 border-t border-gray-200">
        <p>
          Consulta nuestra
          <a href="/privacy-policy" class="font-medium text-blue-600 hover:text-blue-800">Política de Privacidad</a>
          para más información sobre cómo usamos tus datos.
        </p>
      </footer>
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
  if (COOKIE_CONFIG[type]?.required) return;
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

    customConsent.value = { ...getDefaultConsentState(), ...showBanner.value };
  }
});
</script>

<style scoped>
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
