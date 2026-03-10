<script setup>
import { ref } from 'vue'

const servicios = [
    {
        id: 1,
        nombre: "Paquete Salud",
        precio: 355,
        imagen: "/images/Servicios/salud.jpg",
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
        imagen: "/images/Servicios/salud_integral.jpg",
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
        imagen: "/images/Servicios/salud_integral_plus.jpg",
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
        imagen: "/images/Servicios/prequirurjico.jpeg",
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
        imagen: "/images/Servicios/prenatal.jpeg",
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
        imagen: "/images/Servicios/perfil_vias_urinarias.jpeg",
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
        imagen: "/images/Servicios/check_up_general.jpg",
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
        imagen: "/images/Servicios/control_diabetes.jpg",
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
const servicioActivo = ref(listaServicios.value[0])

const seleccionarServicio = (servicio) => {
    servicioActivo.value = servicio
}

</script>

<template>
    <aside class="flex items-center w-1/3">
        <ul class="space-y-4">
            <li v-for="servicio in listaServicios" :key="servicio.id" @click="seleccionarServicio(servicio)"
                class="text-lg cursor-pointer"
                :class="servicioActivo.id === servicio.id ? 'font-semibold text-quinary' : 'text-gray-300'">
                {{ servicio.nombre }}
            </li>
        </ul>
    </aside>
    <div class="relative w-2/3 overflow-hidden bg-gray-50 rounded-3xl h-150">
        <img :src="servicioActivo.imagen" :alt="servicioActivo.nombre" class="w-full" />
        <div class="absolute max-w-sm p-6 shadow-md top-8 left-8 bg-white/90 backdrop-blur-md rounded-2xl">
            <h3 class="mb-4 text-3xl font-semibold text-quinary">
                {{ servicioActivo.nombre }}
            </h3>
            <p class="mb-6 text-gray-600">
                {{ servicioActivo.descripcion }}
            </p>
            <p class="text-2xl font-bold text-quinary">
                ${{ servicioActivo.precio }}
            </p>
        </div>
        <div class="absolute bottom-0 left-0 w-full p-8 bg-linear-to-t from-black/70 to-transparent">
            <ul class="mb-6 space-y-2">
                <li v-for="(estudio, index) in servicioActivo.estudios" :key="index" class="text-gray-200">
                    • {{ estudio }}
                </li>
            </ul>
        </div>
    </div>
</template>