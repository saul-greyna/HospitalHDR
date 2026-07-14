<script setup>
import { computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { doctores } from '../data/doctores.js'
import { directorioState } from '../data/directorioState.js'

const route = useRoute()
const router = useRouter()

const doctorActual = computed(() =>
    doctores.find(d => d.slug === route.params.slug)
)

const listaActiva = computed(() =>
    directorioState.slugsFiltrados
        .map(slug => doctores.find(d => d.slug === slug))
        .filter(Boolean)
)

const indiceActual = computed(() =>
    listaActiva.value.findIndex(d => d.slug === route.params.slug)
)

const anterior = computed(() => listaActiva.value[indiceActual.value - 1])
const siguiente = computed(() => listaActiva.value[indiceActual.value + 1])

function irAnterior() {
    if (!anterior.value) return
    router.push({ name: 'detalle', params: { slug: anterior.value.slug } })
}

function irSiguiente() {
    if (!siguiente.value) return
    router.push({ name: 'detalle', params: { slug: siguiente.value.slug } })
}

function volver() {
    router.push({ name: 'lista' })
}
</script>

<template>
    <section v-if="doctorActual"
        class="grid grid-cols-1 gap-4 md:grid-cols-2 md:grid-rows-1 md:place-content-center md:place-items-center md:my-8">
        <aside class="absolute z-20 p-2 -translate-y-1/2 bg-white rounded-full shadow-xl md:p-4 top-1/2 md:left-49">
            <div class="flex flex-col gap-3 md:gap-6">
                <button @click="irAnterior" :disabled="!anterior"
                    class="flex items-center justify-center text-white transition bg-black rounded-full md:h-16 md:w-16 hover:scale-105 disabled:opacity-30"
                    aria-label="Médico anterior">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 p-1 md:p-0" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </button>
                <button @click="volver"
                    class="flex items-center justify-center text-black transition rounded-full md:h-16 md:w-16 bg-cyan-300 hover:scale-105"
                    aria-label="Volver al listado">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 p-1 md:p-0" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <button @click="irSiguiente" :disabled="!siguiente"
                    class="flex items-center justify-center text-white transition bg-black rounded-full md:h-16 md:w-16 hover:scale-105 disabled:opacity-30"
                    aria-label="Médico siguiente">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 p-1 md:p-0" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </aside>
        <figure
            class="relative w-full overflow-hidden min-w-83.75 aspect-335/502 rounded-4xl md:max-w-134 md:aspect-536/804">
            <img :src="doctorActual.imagenPerfil"
                :alt="`Fotografia de ${doctorActual.gradoPrefijo} ${doctorActual.nombre} ${doctorActual.apellido}`"
                class="object-cover object-center w-full h-full" width="335" height="502" fetchpriority="high">
        </figure>
        <article class="flex flex-col items-start justify-center py-4 space-y-4">
            <ul class="flex gap-8">
                <li class="flex items-center justify-center h-22 w-22 shrink-0 rounded-3xl bg-cyan-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-11 h-11 text-cyan-500" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                    </svg>
                </li>
                <li class="flex flex-col items-start justify-center">
                    <span class="text-lg font-bold text-black">{{ doctorActual.grado }}</span>
                    <h1 class="text-xl font-medium md:text-3xl text-zinc-500">
                        {{ doctorActual.nombre }} {{ doctorActual.apellido }}
                    </h1>
                </li>
            </ul>
            <ul class="flex gap-8">
                <li class="flex items-center justify-center h-22 w-22 shrink-0 rounded-3xl bg-cyan-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-11 h-11 text-cyan-500"
                        viewBox="0 0 16 16">
                        <path
                            d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
                    </svg>
                </li>
                <li class="flex flex-col items-start justify-center">
                    <span class="text-lg font-bold text-black">Especialidad</span>
                    <h2 class="text-xl font-medium md:text-3xl text-zinc-500">{{ doctorActual.especialidad }}</h2>
                </li>
            </ul>
            <div class="w-full border-t border-zinc-200"></div>
            <ul class="grid w-full grid-cols-1 grid-rows-4 gap-4 mt-2 md:grid-cols-4 md:grid-rows-1">
                <li
                    class="flex flex-col justify-center p-4 rounded-3xl min-h-32 bg-linear-to-r from-cyan-300 via-cyan-400 to-cyan-300 md:bg-linear-to-b md:from-white md:via-cyan-300 md:to-cyan-400">
                    <span class="text-base font-bold text-black md:text-lg">Horario</span>
                    <p class="text-lg font-medium text-zinc-500 md:text-xl">
                        {{ doctorActual.horario ?? 'Por definir' }}
                    </p>
                </li>
                <li
                    class="flex flex-col justify-center p-4 rounded-3xl min-h-32 bg-linear-to-r from-cyan-300 via-cyan-400 to-cyan-300 md:bg-linear-to-b md:from-white md:via-cyan-300 md:to-cyan-400">
                    <span class="text-base font-bold text-black md:text-lg">Cédula</span>
                    <p class="text-lg font-medium text-zinc-500 md:text-xl">
                        {{ doctorActual.cedula ?? 'No disponible' }}
                    </p>
                </li>
                <li
                    class="flex flex-col justify-center p-4 rounded-3xl min-h-32 bg-linear-to-r from-cyan-300 via-cyan-400 to-cyan-300 md:bg-linear-to-b md:from-white md:via-cyan-300 md:to-cyan-400">
                    <span class="text-base font-bold text-black md:text-lg">Área médica</span>
                    <p class="text-lg font-medium text-zinc-500 md:text-xl">
                        {{ doctorActual.especialidadCategoria }}
                    </p>
                </li>
                <li
                    class="flex flex-col justify-center p-4 rounded-3xl min-h-32 bg-linear-to-r from-cyan-300 via-cyan-400 to-cyan-300 md:bg-linear-to-b md:from-white md:via-cyan-300 md:to-cyan-400">
                    <span class="text-base font-bold text-black md:text-lg">Consultorio</span>
                    <p class="text-lg font-medium text-zinc-500 md:text-xl">
                        {{ doctorActual.consultorio }}
                    </p>
                </li>
            </ul>
            <a href="tel:4777141973"
                class="grid w-full h-20 cursor-pointer hover:border-2 hover:border-cyan-500 rounded-3xl place-content-center md:bg-linear-to-t md:from-white md:via-cyan-300 md:to-cyan-400 bg-linear-to-r from-cyan-300 via-cyan-400 to-cyan-300">
                <span class="text-lg font-medium text-center md:text-xl text-zinc-500">Agenda una cita</span>
            </a>
        </article>
    </section>
    <div v-else class="flex items-center justify-center py-20">
        <p class="text-xl text-gray-500">Médico no encontrado.</p>
    </div>
</template>
