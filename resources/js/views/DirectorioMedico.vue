<template>
    <section class="py-3 bg-gray-200 md:py-0 md:my-14 rounded-2xl">
        <header class="flex flex-col items-center md:py-11">
            <span class="text-xs font-medium tracking-wide md:text-sm text-plata-600">
                Directorio del Hospital
            </span>
            <h1 class="py-4 text-2xl font-medium text-center md:text-6xl text-azul-600">
                Directorio de médicos
            </h1>
        </header>
        <form class="grid grid-cols-2 grid-rows-3 gap-3 mx-2 my-4 rounded-lg md:mx-17 md:grid-cols-6 md:grid-rows-1"
            @submit.prevent="buscarPorNombre">
            <select v-model="filtros.grado" aria-label="Seleciona la profesión" name="grado"
                class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sexto text-tertiary md:text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center text-sm">
                <option value="">Profesión</option>
                <option value="Doctor">Doctor</option>
                <option value="Doctora">Doctora</option>
                <option value="Licenciatura">Licenciatura</option>
            </select>
            <select v-model="filtros.especialidad" aria-label="Seleciona la especialidad" name="especialidad"
                class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sexto text-tertiary md:text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center text-sm">
                <option value="">Especialidades</option>
                <option value="Clínicas">Clínicas</option>
                <option value="Quirúrgicas">Quirúrgicas</option>
                <option value="Diagnóstico">Diagnóstico</option>
                <option value="Rehabilitación">Rehabilitación</option>
                <option value="Odontológicas">Odontológicas</option>
            </select>
            <select v-model="filtros.consultorio" aria-label="Seleciona el consultorio" name="consultorio"
                class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sexto text-tertiary md:text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center text-sm">
                <option value="">Consultorio</option>
                <optgroup label="100 - 110">
                    <option value="102">102</option>
                    <option value="103">103</option>
                    <option value="104">104</option>
                    <option value="106">106</option>
                    <option value="107">107</option>
                    <option value="108">108</option>
                    <option value="109">109</option>
                    <option value="110">110</option>
                </optgroup>
                <optgroup label="111 - 120">
                    <option value="111">111</option>
                    <option value="112">112</option>
                    <option value="113">113</option>
                    <option value="114">114</option>
                    <option value="118">118</option>
                    <option value="120">120</option>
                </optgroup>
                <optgroup label="131 - 140">
                    <option value="131">131</option>
                    <option value="132">132</option>
                    <option value="133">133</option>
                    <option value="134">134</option>
                    <option value="135">135</option>
                    <option value="137">137</option>
                    <option value="139">139</option>
                    <option value="140">140</option>
                </optgroup>
                <optgroup label="141 - 145">
                    <option value="141">141</option>
                    <option value="142">142</option>
                    <option value="143">143</option>
                </optgroup>
            </select>
            <input v-model="nombreBusqueda" type="search" placeholder="Ingresa el nombre" aria-label="Buscar por Nombre"
                name="nombre"
                class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sextarian text-tertiary md:text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center md:col-span-2 text-sm">
            <button type="submit"
                class="col-span-2 px-6 py-3 text-sm font-bold transition-all duration-500 ease-in-out transform bg-sextarian rounded-2xl hover:animate-pulse md:col-start-6 md:text-base">
                Buscar
            </button>
        </form>
        <div class="flex items-center justify-between gap-4 mx-2">
            <span class="text-sm font-semibold md:mx-17 text-quinary">
                Medicos disponibles {{ doctoresFiltrados.length }}
                <span v-if="hayFiltrosActivos"> de {{ doctores.length }}</span>
            </span>
            <button v-if="hayFiltrosActivos" @click="limpiarFiltros"
                class="font-semibold transition-all duration-200 cursor-pointer hover:underline md:mx-17 text-secondary md:text-base">
                Limpiar filtros
            </button>
        </div>
        <ul class="grid grid-cols-1 gap-4 py-4 md:py-8 md:grid-cols-4 place-items-center">
            <li v-for="doctor in doctoresFiltrados" :key="doctor.id" class="text-left">
                <RouterLink :to="{ name: 'detalle', params: { slug: doctor.slug } }">
                    <figure class="place-items-center">
                        <img :src="doctor.imagen" :alt="`${doctor.gradoPrefijo} ${doctor.nombre} ${doctor.apellido}`"
                            class="transition cursor-pointer rounded-2xl hover:scale-105" width="288" height="370"
                            fetchpriority="high" decoding="async" loading="eager">
                    </figure>
                </RouterLink>
                <div class="max-w-72 md:w-full">
                    <h2 class="my-2 text-xl font-semibold md:text-2xl">
                        {{ doctor.gradoPrefijo }} {{ doctor.alias }}
                    </h2>
                    <p class="text-sm md:text-base">
                        {{ doctor.especialidad }}
                    </p>
                    <span>
                        Consultorio {{ doctor.consultorio }}
                    </span>
                </div>
            </li>
        </ul>
    </section>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { doctores } from '../data/doctores.js'
import { setSlugsFiltrados } from '../data/directorioState.js'

const hayFiltrosActivos = computed(() => {
    return (
        filtros.value.grado ||
        filtros.value.especialidad ||
        filtros.value.consultorio ||
        filtros.value.nombre
    )
})

const nombreBusqueda = ref('')

const filtros = ref({
    grado: '',
    especialidad: '',
    consultorio: '',
    nombre: ''
})

const buscarPorNombre = () => {
    filtros.value.nombre = nombreBusqueda.value.trim()
}

watch(nombreBusqueda, (valor) => {
    if (!valor.trim()) {
        filtros.value.nombre = ''
    }
})

const limpiarFiltros = () => {
    filtros.value.grado = ''
    filtros.value.especialidad = ''
    filtros.value.consultorio = ''
    filtros.value.nombre = ''
    nombreBusqueda.value = ''
}

const doctoresFiltrados = computed(() => {
    return doctores.filter(doctor => {
        const grado =
            !filtros.value.grado ||
            doctor.grado === filtros.value.grado

        const especialidad =
            !filtros.value.especialidad ||
            doctor.especialidadCategoria === filtros.value.especialidad

        const consultorio =
            !filtros.value.consultorio ||
            doctor.consultorio === filtros.value.consultorio

        const nombre =
            !filtros.value.nombre ||
            `${doctor.gradoPrefijo} ${doctor.nombre} ${doctor.apellido}`
                .toLowerCase()
                .includes(filtros.value.nombre.toLowerCase()) ||
            doctor.alias
                .toLowerCase()
                .includes(filtros.value.nombre.toLowerCase())

        return grado && especialidad && consultorio && nombre
    })
})

watch(doctoresFiltrados, (lista) => {
    setSlugsFiltrados(lista)
}, { immediate: true })
</script>