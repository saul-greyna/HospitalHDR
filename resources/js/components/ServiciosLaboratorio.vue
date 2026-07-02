<script setup>
import { ref, computed, onMounted } from 'vue'

const servicios = [
    {
        id: 1,
        nombre: "Paquete Salud",
        precio: 355,
        imagen: "/images/Servicios/salud.webp",
        estudios: [
            "Biometría Hemática",
            "Química Sanguínea 6",
            "Examen General de Orina"
        ],
        descripcion: "Estudios básicos de sangre y orina para evaluación general preventiva y detección temprana de alteraciones."
    },
    {
        id: 2,
        nombre: "Paquete Salud Integral",
        precio: 538,
        imagen: "/images/Servicios/salud_integral.webp",
        estudios: [
            "Biometría Hemática",
            "Química Sanguínea 6",
            "Examen General de Orina",
            "Coprológico"
        ],
        descripcion: "Incluye análisis sanguíneos, orina y coprológico para valoración digestiva y estado general del paciente."
    },
    {
        id: 3,
        nombre: "Paquete Salud Integral Plus",
        precio: 733,
        imagen: "/images/Servicios/salud_integral_plus.webp",
        estudios: [
            "Biometría",
            "Química Sanguínea 4",
            "Perfil de Lípidos",
            "Electrolitos Séricos 6",
            "Examen General de Orina"
        ],
        descripcion: "Perfil más completo con lípidos y electrolitos para evaluar metabolismo, función renal y cardiovascular."
    },
    {
        id: 4,
        nombre: "Paquete Prequirúrgico",
        precio: 387,
        imagen: "/images/Servicios/prequirurjico.webp",
        estudios: [
            "Biometría Hemática",
            "Química Sanguínea 3",
            "Grupo y RH",
            "TP",
            "TPT",
            "Examen General de Orina"
        ],
        descripcion: "Estudios esenciales de coagulación, sangre y orina para valoración previa segura a procedimientos quirúrgicos."
    },
    {
        id: 5,
        nombre: "Prenatal",
        precio: 593,
        imagen: "/images/Servicios/prenatal.webp",
        estudios: [
            "Biometría Hemática",
            "Química Sanguínea 3",
            "Grupo y RH",
            "VDRL",
            "Examen General de Orina"
        ],
        descripcion: "Análisis básicos y VDRL para control materno, detección de infecciones y seguimiento del embarazo."
    },
    {
        id: 6,
        nombre: "Perfil Vías Urinarias",
        precio: 511,
        imagen: "/images/Servicios/perfil_vias_urinarias.webp",
        estudios: [
            "Examen General de Orina",
            "Urocultivo"
        ],
        descripcion: "Evaluación específica con examen general y urocultivo para detectar infecciones urinarias."
    },
    {
        id: 7,
        nombre: "Check Up General",
        precio: 799,
        imagen: "/images/Servicios/check_up_general.webp",
        estudios: [
            "Biometría Hemática",
            "Química Sanguínea 30",
            "Examen General de Orina",
            "Coproparasitoscópico 1"
        ],
        descripcion: "Perfil amplio con química sanguínea extensa y estudios básicos para revisión médica integral."
    },
    {
        id: 8,
        nombre: "Control Diabetes",
        precio: 581,
        imagen: "/images/Servicios/control_diabetes.webp",
        estudios: [
            "Biometría Hemática",
            "Química Sanguínea 3",
            "Examen General de Orina",
            "Hemoglobina Glicosilada"
        ],
        descripcion: "Estudios enfocados en glucosa y hemoglobina glicosilada para monitoreo y control metabólico."
    }
];

const listaServicios = ref(servicios)

const servicioInicial = servicios[0]

const servicioActivo = ref(servicioInicial)

const imagenActual = computed(() => servicioActivo.value.imagen)

const seleccionarServicio = (servicio) => {
    servicioActivo.value = servicio
}
</script>

<template>
    <section class="flex flex-col items-center py-6">
        <header class="flex flex-col items-center justify-center w-5xl">
            <p class="text-sm font-medium tracking-wide text-quaternary">
                Nuestros servicios
            </p>
            <h1 class="py-6 text-5xl font-medium text-center md:text-6xl text-quinary">
                Servicios médicos y promociones
            </h1>
        </header>
        <article class="flex flex-col w-full gap-4 md:flex-row md:items-center md:justify-center md:gap-0">
            <nav class="w-1/3">
                <ul class="space-y-4">
                    <li v-for="servicio in listaServicios" :key="servicio.id" class="cursor-pointer"
                        @click="seleccionarServicio(servicio)"
                        :class="servicioActivo.id === servicio.id ? ' text-quinary text-3xl font-semibold' : 'text-gray-500 text-base'">
                        {{ servicio.nombre }}
                    </li>
                </ul>
            </nav>
            <figure class="relative w-2/3 overflow-hidden rounded-2xl aspect-1163/654">
                <img :src="servicioActivo.imagen" :alt="servicioActivo.nombre" class="object-cover w-full h-full"
                    width="1163" height="654" fetchpriority="high" decoding="async" loading="eager">
                <header
                    class="absolute top-0 max-w-sm p-6 shadow-md bg-white/90 backdrop-blur-md rounded-2xl md:top-8 md:left-8">
                    <h2 class="mb-4 text-3xl font-semibold text-quinary">
                        {{ servicioActivo.nombre }}
                    </h2>
                    <p class="mb-6 text-gray-600">
                        {{ servicioActivo.descripcion }}
                    </p>
                    <span class="text-2xl font-bold text-quinary">
                        ${{ servicioActivo.precio }}
                    </span>
                </header>
                <footer class="absolute bottom-0 left-0 w-full p-8 bg-linear-to-t from-black/70 to-transparent">
                    <h3 class="sr-only">
                        Estudios incluidos
                    </h3>
                    <ul class="space-y-2">
                        <li v-for="(estudio, index) in servicioActivo.estudios" :key="index" class="text-gray-200">
                            • {{ estudio }}
                        </li>
                    </ul>
                </footer>
            </figure>
        </article>
    </section>
</template>