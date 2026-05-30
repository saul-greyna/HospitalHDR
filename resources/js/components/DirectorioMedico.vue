<script setup>
import { ref, computed, watch } from 'vue'

const doctores = [
    {
        id: 1,
        nombre: "Dr. Santiago I. Godínez",
        especialidad: "Genética Médica",
        especialidadCategoria: "Diagnóstico",
        consultorio: "120",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-santiago-ignacio-godinez-hernandez.webp"
    },
    {
        id: 2,
        nombre: "Dr. Alberto González",
        especialidad: "Urología",
        especialidadCategoria: "Clínicas",
        consultorio: "118",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-alberto-antonio-gonzalez-bravo.webp"
    },
    {
        id: 3,
        nombre: "Dr. Jaime Velázquez",
        especialidad: "Medicina Interna y Geriatría",
        especialidadCategoria: "Clínicas",
        consultorio: "140",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-jaime-alonso-velazquez-fuentes.webp"
    },
    {
        id: 4,
        nombre: "Dr. Juan Viveros",
        especialidad: "Medicina Interna y Geriatría",
        especialidadCategoria: "Clínicas",
        consultorio: "131",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-juan-carlos-viveros.webp"
    },
    {
        id: 5,
        nombre: "Dr. Victor Hugo Godínez Valdez",
        especialidad: "Cardiólogo y Médico Internista",
        especialidadCategoria: "Clínicas",
        consultorio: "111",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-victor-hugo-godinez-valdez.webp"
    },
    {
        id: 6,
        nombre: "Dra. Guadalupe Uviña",
        especialidad: "Ginecología",
        especialidadCategoria: "Clínicas",
        consultorio: "141",
        profesion: "Doctora",
        imagen: "/images/Doctores/dra-guadalupe-alejandra-uvina-quintero.webp"
    },
    {
        id: 7,
        nombre: "Dr. Luis Castaldi",
        especialidad: "Ginecología",
        especialidadCategoria: "Clínicas",
        consultorio: "113",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-luis-arturo-castaldi-bermudez.webp"
    },
    {
        id: 8,
        nombre: "Dra. Laura Darynka",
        especialidad: "Ginecología y Obstetricia",
        especialidadCategoria: "Clínicas",
        consultorio: "113",
        profesion: "Doctora",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 9,
        nombre: "Dr. Jorge Gutiérrez",
        especialidad: "Pediatría",
        especialidadCategoria: "Clínicas",
        consultorio: "106",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-jorge-arturo-gutierrez-vargas.webp"
    },
    {
        id: 10,
        nombre: "Dr. José Luis Cruz Sánchez",
        especialidad: "Pediatría",
        especialidadCategoria: "Clínicas",
        consultorio: "135",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-jose-luis-cruz-sanchez.webp"
    },
    {
        id: 11,
        nombre: "Dra. Palmira Hernández",
        especialidad: "Neurología Pediátrica",
        especialidadCategoria: "Clínicas",
        consultorio: "137",
        profesion: "Doctora",
        imagen: "/images/Doctores/dra-palmira-hernandez-aguirre.webp"
    },
    {
        id: 12,
        nombre: "Dr. Jaime Bustamante",
        especialidad: "Otorrinolaringología",
        especialidadCategoria: "Clínicas",
        consultorio: "139",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-jaime-ivan-bustamente-garcia.webp"
    },
    {
        id: 13,
        nombre: "Dra. Carolina Domínguez",
        especialidad: "Otorrinolaringología / Cirugía de Cabeza y Cuello",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "103",
        profesion: "Doctora",
        imagen: "/images/Doctores/dra-carolina-dominguez-meza.webp"
    },
    {
        id: 14,
        nombre: "Dra. Fátima Cedillo",
        especialidad: "Oftalmología",
        especialidadCategoria: "Clínicas",
        consultorio: "140",
        profesion: "Doctora",
        imagen: "/images/Doctores/dra-fatima-irangani-cedillo-azuela.webp"
    },
    {
        id: 15,
        nombre: "Dr. Roberto Ávila",
        especialidad: "Cirugía Gastroenterológica",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "110",
        profesion: "Doctor",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 16,
        nombre: "Dr. Raúl Hernández",
        especialidad: "Gastroenterología y Cirugía de Mínima Invasión",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "110",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-raul-hernandez-centeno.webp"
    },
    {
        id: 17,
        nombre: "Dr. Ernesto Rodríguez",
        especialidad: "Cirugía Gastroenterológica",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "141",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-ernesto-rodriguez-alvarado.webp"
    },
    {
        id: 18,
        nombre: "Dr. Fernando Chico",
        especialidad: "Traumatología y Ortopedia",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "140",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-fernando-chico-carpizo.webp"
    },
    {
        id: 19,
        nombre: "Dr. Francisco Cabrales",
        especialidad: "Traumatología y Ortopedia",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "134",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-francisco-cabrales-garcia.webp"
    },
    {
        id: 20,
        nombre: "Dr. Gerardo Bautista",
        especialidad: "Traumatología y Ortopedia",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "139",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-gerardo-bautista-diaz.webp"
    },
    {
        id: 21,
        nombre: "Dr. Ramón Rodríguez",
        especialidad: "Traumatología y Ortopedia",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "107",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-ramon-rodriguez-padilla.webp"
    },
    {
        id: 22,
        nombre: "Dr. Valente Romero",
        especialidad: "Traumatología / Cirugía de Cadera",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "134",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-valente-romero-rodriguez.webp"
    },
    {
        id: 23,
        nombre: "Dr. Aldo Galván",
        especialidad: "Anatomopatología",
        especialidadCategoria: "Diagnóstico",
        consultorio: "141",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-aldo-ivan-galvan-linares.webp"
    },
    {
        id: 24,
        nombre: "Dr. Augusto Ramírez Solis",
        especialidad: "Cirugía Cardiovascular y Torácica / Angiología",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "102",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-augusto-ramirez-solis.webp"
    },
    {
        id: 25,
        nombre: "Dr. Benjamín Sánchez",
        especialidad: "Cirugía Maxilofacial",
        especialidadCategoria: "Odontológicas",
        consultorio: "112",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-benjamin-sanchez-trocino.webp"
    },
    {
        id: 26,
        nombre: "Dr. Jacinto Díaz",
        especialidad: "Cirugía Maxilofacial",
        especialidadCategoria: "Odontológicas",
        consultorio: "112",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-jacinto-armando-diaz-acevedo.webp"
    },
    {
        id: 27,
        nombre: "Dr. José Quintana",
        especialidad: "Cirujano Oncológico",
        especialidadCategoria: "Otra",
        consultorio: "133",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-jose-alejandro-quintana.webp"
    },
    {
        id: 28,
        nombre: "Dr. Julio Torres",
        especialidad: "Cirugía Cardiotorácica y Vascular Periférica",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "142",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-julio-torres-escamilla.webp"
    },
    {
        id: 29,
        nombre: "Dra. Nereida Cortez",
        especialidad: "Periodoncia",
        especialidadCategoria: "Odontológicas",
        consultorio: "112",
        profesion: "Doctora",
        imagen: "/images/Doctores/dra-nereida-cortez-lopez.webp"
    },
    {
        id: 30,
        nombre: "Dra. Paulina Montaño",
        especialidad: "Radiología y Radiología Oncológica",
        especialidadCategoria: "Diagnóstico",
        consultorio: "108",
        profesion: "Doctora",
        imagen: "/images/Doctores/dra-paulina-montano-ascencio.webp"
    },
    {
        id: 31,
        nombre: "Dr. Francisco Castrejón",
        especialidad: "Cardiología",
        especialidadCategoria: "Clínicas",
        consultorio: "142",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-francisco-jose-castrejon-aivar.webp"
    },
    {
        id: 32,
        nombre: "Dr. Francisco Vilches",
        especialidad: "Radiología",
        especialidadCategoria: "Diagnóstico",
        consultorio: "109",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-francisco-vilches-duran.webp"
    },
    {
        id: 33,
        nombre: "Dr. Francisco Mendoza",
        especialidad: "Alergia e Inmunología Clínica",
        especialidadCategoria: "Clínicas",
        consultorio: "103",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-francisco-javier-mendoza-espinoza.webp"
    },
    {
        id: 34,
        nombre: "Dr. Francisco Orta",
        especialidad: "Neurocirugía y Cirugía de Columna",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "137",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-francisco-javier-orta-montejano.webp"
    },
    {
        id: 35,
        nombre: "Lic. Edna Hernández",
        especialidad: "Fisioterapia",
        especialidadCategoria: "Rehabilitación",
        consultorio: "143",
        profesion: "Licenciatura",
        imagen: "/images/Doctores/lic-edna-hernandez-sanchez.webp"
    },
    {
        id: 36,
        nombre: "Lic. Fátima García",
        especialidad: "Fisioterapia",
        especialidadCategoria: "Rehabilitación",
        consultorio: "143",
        profesion: "Licenciatura",
        imagen: "/images/Doctores/lic-fatima-teresa-de-la-o-garcia.webp"
    },
    {
        id: 37,
        nombre: "Lic. Israel Rentería",
        especialidad: "Fisioterapia",
        especialidadCategoria: "Rehabilitación",
        consultorio: "143",
        profesion: "Licenciatura",
        imagen: "/images/Doctores/lic-israel-renteria-troncoso.webp"
    },
    {
        id: 38,
        nombre: "Lic. Patricia Maldonado",
        especialidad: "Nutrición Clínica",
        especialidadCategoria: "Rehabilitación",
        consultorio: "133",
        profesion: "Licenciatura",
        imagen: "/images/Doctores/lic-patricia-maldonado-valadez.webp"
    },
    {
        id: 39,
        nombre: "Dra. Claudia Carolina Castellanos Cervantes",
        especialidad: "Nutrición Gerontológica",
        especialidadCategoria: "Rehabilitación",
        consultorio: "131",
        profesion: "Doctora",
        imagen: "/images/Doctores/dra-claudia-carolina-castellanos-cervantes.webp"
    },
    {
        id: 40,
        nombre: "Dr. Juan González",
        especialidad: "Medicina General",
        especialidadCategoria: "Clínicas",
        consultorio: "132",
        profesion: "Doctor",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 41,
        nombre: "Dr. Israel Armida Granados",
        especialidad: "Nefrología",
        especialidadCategoria: "Clínicas",
        consultorio: "120",
        profesion: "Doctor",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 42,
        nombre: "Dr. Javier Medrano",
        especialidad: "Urología de Mínima Invasión",
        especialidadCategoria: "Clínicas",
        consultorio: "A - Ext. 113",
        profesion: "Doctor",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 43,
        nombre: "Dra. Alejandra Muñoz Valdivia",
        especialidad: "Psiquiatría y Adicciones",
        especialidadCategoria: "Clínicas",
        consultorio: "133",
        profesion: "Doctora",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 44,
        nombre: "Dr. Jairo Barba",
        especialidad: "Medicina General",
        especialidadCategoria: "Clínicas",
        consultorio: "104",
        profesion: "Doctor",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 45,
        nombre: "Dr. Asael Palafox",
        especialidad: "Oncología Clínica",
        especialidadCategoria: "Clínicas",
        consultorio: "114",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-asael-palafoz-cazarez.webp"
    },
    {
        id: 46,
        nombre: "Lic. María Guerrero",
        especialidad: "Fisioterapia",
        especialidadCategoria: "Rehabilitación",
        consultorio: "143",
        profesion: "Licenciatura",
        imagen: "/images/Doctores/lic-maria-fernanda-guerrero-monjaraz.webp"
    },
    {
        id: 47,
        nombre: "Dr. Juan Ángel Cibrián Delgado",
        especialidad: "Cardiología Clínica e Intervencionista",
        especialidadCategoria: "Clínicas",
        consultorio: "131",
        profesion: "Doctor",
        imagen: "/images/Doctores/dr-juan-angel-cibrian-delgado.webp"
    },
    {
        id: 48,
        nombre: "Dr. Juan Carlos García Lino",
        especialidad: "Cirugía Pediátrica",
        especialidadCategoria: "Quirúrgicas",
        consultorio: "102",
        profesion: "Doctor",
        imagen: "/images/Doctores/174x224.webp"
    },
    {
        id: 49,
        nombre: "Dr. Jesús Estrada Hernández",
        especialidad: "Endoscopia Gastrointestinal",
        especialidadCategoria: "Diagnóstico",
        consultorio: "110",
        profesion: "Doctor",
        imagen: "/images/Doctores/174x224.webp"
    }
];

const hayFiltrosActivos = computed(() => {
    return (
        filtros.value.profesion ||
        filtros.value.especialidad ||
        filtros.value.consultorio ||
        filtros.value.nombre
    )
})

const nombreBusqueda = ref('')

const filtros = ref({
    profesion: '',
    especialidad: '',
    consultorio: '',
    nombre: ''
})

const buscarPorNombre = () => {
    filtros.value.nombre =
        nombreBusqueda.value.trim()

    watch(nombreBusqueda, (valor) => {
        if (!valor.trim()) {
            filtros.value.nombre = ''
        }
    })
}

const doctoresFiltrados = computed(() => {

    return doctores.filter(doctor => {

        const profesion =
            !filtros.value.profesion ||
            doctor.profesion === filtros.value.profesion

        const especialidad =
            !filtros.value.especialidad ||
            doctor.especialidadCategoria === filtros.value.especialidad

        const consultorio =
            !filtros.value.consultorio ||
            doctor.consultorio === filtros.value.consultorio

        const nombre =
            !filtros.value.nombre ||
            doctor.nombre
                .toLowerCase()
                .includes(
                    filtros.value.nombre.toLowerCase()
                )

        return (
            profesion &&
            especialidad &&
            consultorio &&
            nombre
        )
    })
})
</script>

<template>
    <form class="grid grid-cols-2 grid-rows-3 gap-3 mx-2 my-4 rounded-lg md:mx-17 md:grid-cols-6 md:grid-rows-1"
        @submit.prevent="buscarPorNombre">
        <select v-model="filtros.profesion" aria-label="Seleciona la profesión" name="profesion"
            class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sexto text-tertiary text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center">
            <option value="">Profesión</option>
            <option value="Doctor">Doctor</option>
            <option value="Doctora">Doctora</option>
            <option value="Licenciatura">Licenciatura</option>
        </select>
        <select v-model="filtros.especialidad" aria-label="Seleciona la especialidad" name="especialidad"
            class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sexto text-tertiary text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center">
            <option value="">Especialidades</option>
            <option value="Clínicas">Clínicas</option>
            <option value="Quirúrgicas">Quirúrgicas</option>
            <option value="Diagnóstico">Diagnóstico</option>
            <option value="Rehabilitación">Rehabilitación</option>
            <option value="Odontológicas">Odontológicas</option>
        </select>
        <select v-model="filtros.consultorio" aria-label="Seleciona el consultorio" name="consultorio"
            class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sexto text-tertiary text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center">
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
            class="md:min-w-50 transition-[background] duration-1000 ease-in-out open:bg-sextarian text-tertiary text-base font-medium bg-white px-4 py-2 rounded-2xl text-center flex items-center justify-center md:col-span-2">
        <button type="submit"
            class="col-span-2 px-6 py-3 font-bold transition-all duration-500 ease-in-out transform bg-sextarian rounded-2xl hover:animate-pulse md:col-start-6">
            Buscar
        </button>
    </form>

    <ul class="grid grid-cols-1 gap-4 md:py-8 md:grid-cols-4 place-items-center">
        <li v-for="doctor in doctoresFiltrados" :key="doctor.id" class="text-left">
            <figure v-if="doctor.imagen && !doctor.imagen.endsWith('/')" class="place-items-center">
                <img :src="doctor.imagen" :alt="doctor.nombre"
                    class="rounded-2xl" width="288" height="370"
                    fetchpriority="high" decoding="async" loading="eager">
            </figure>
            <div class="pl-4">
                <h2 class="my-2 text-2xl font-semibold">
                    {{ doctor.nombre }}
                </h2>
                <p class="text-base">
                    {{ doctor.especialidad }}
                </p>
                <span>
                    Consultorio {{ doctor.consultorio }}
                </span>
            </div>
        </li>
    </ul>
</template>
