<script setup>
import { ref } from 'vue'

const doctores = [
    {
        id: 1,
        nombre: "Dr. Santiago I. Godínez",
        especialidad: "Genética Médica",
        consultorio: "120",
        imagen: "/images/Doctores/dr._Santiago_I._Godínez.png"
    },
    {
        id: 2,
        nombre: "Dr. Alberto González",
        especialidad: "Urología",
        consultorio: "118",
        imagen: "/images/Doctores/Dr. Alberto.png"
    },
    {
        id: 3,
        nombre: "Dr. Jaime Velázquez",
        especialidad: "Medicina Interna y Geriatría",
        consultorio: "140",
        imagen: "/images/Doctores/Dr. Jaime Alonso Velazquez Fuentes.png"
    },
    {
        id: 4,
        nombre: "Dr. Juan Viveros",
        especialidad: "Medicina Interna y Geriatría",
        consultorio: "131",
        imagen: "/images/Doctores/Dr. Juan Carlos Viveros.png"
    },
    {
        id: 5,
        nombre: "Dr. Víctor Godínez",
        especialidad: "Cardiólogo y Médico Internista",
        consultorio: "111",
        imagen: "/images/Doctores/Dr. Victor Hugo Godinez Valdez.png"
    },
    {
        id: 6,
        nombre: "Dra. Guadalupe Uviña",
        especialidad: "Ginecología",
        consultorio: "141",
        imagen: "/images/Doctores/Dra. Guadalupe Alejandra Uviña Quintero.png"
    },
    {
        id: 7,
        nombre: "Dr. Luis Castaldi",
        especialidad: "Ginecología",
        consultorio: "113",
        imagen: "/images/Doctores/Dr. Luis Arturo Castaldi Bermudez.png"
    },
    {
        id: 8,
        nombre: "Dra. Laura Darynka",
        especialidad: "Ginecología y Obstetricia",
        consultorio: "113",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 9,
        nombre: "Dr. Jorge Gutiérrez",
        especialidad: "Pediatría",
        consultorio: "106",
        imagen: "/images/Doctores/Dr. Jorge Arturo Gutiérrez Vargas.png"
    },
    {
        id: 10,
        nombre: "Dr. José Cruz",
        especialidad: "Pediatría",
        consultorio: "135",
        imagen: "/images/Doctores/Dr. José Luis Cruz Sánchez.png"
    },
    {
        id: 11,
        nombre: "Dra. Palmira Hernández",
        especialidad: "Neurología Pediátrica",
        consultorio: "137",
        imagen: "/images/Doctores/Dra. Palmira Hernández Aguirre.png"
    },
    {
        id: 12,
        nombre: "Dr. Jaime Bustamante",
        especialidad: "Otorrinolaringología",
        consultorio: "139",
        imagen: "/images/Doctores/DR. JAIME IVAN BUSTAMENTE GARCIA.png"
    },
    {
        id: 13,
        nombre: "Dra. Carolina Domínguez",
        especialidad: "Otorrinolaringología / Cirugía de Cabeza y Cuello",
        consultorio: "103",
        imagen: "/images/Doctores/Dra. Carolina Domínguez Meza.png"
    },
    {
        id: 14,
        nombre: "Dra. Fátima Cedillo",
        especialidad: "Oftalmología",
        consultorio: "140",
        imagen: "/images/Doctores/Dra. Fátima Iranganí Cedillo Azuela.png"
    },
    {
        id: 15,
        nombre: "Dr. Roberto Ávila",
        especialidad: "Cirugía Gastroenterológica",
        consultorio: "110",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 16,
        nombre: "Dr. Raúl Hernández",
        especialidad: "Gastroenterología y Cirugía de Mínima Invasión",
        consultorio: "110",
        imagen: "/images/Doctores/Dr. Raúl Hernández Centeno.png"
    },
    {
        id: 17,
        nombre: "Dr. Ernesto Rodríguez",
        especialidad: "Cirugía Gastroenterológica",
        consultorio: "141",
        imagen: "/images/Doctores/Dr. Ernesto Rodríguez Alvarado.png"
    },
    {
        id: 18,
        nombre: "Dr. Fernando Chico",
        especialidad: "Traumatología y Ortopedia",
        consultorio: "140",
        imagen: "/images/Doctores/Dr. Fernando Chico Carpizo.png"
    },
    {
        id: 19,
        nombre: "Dr. Francisco Cabrales",
        especialidad: "Traumatología y Ortopedia",
        consultorio: "134",
        imagen: "/images/Doctores/Dr. Francisco Cabrales García.png"
    },
    {
        id: 20,
        nombre: "Dr. Gerardo Bautista",
        especialidad: "Traumatología y Ortopedia",
        consultorio: "139",
        imagen: "/images/Doctores/Dr. Gerardo Bautista Díaz.png"
    },
    {
        id: 21,
        nombre: "Dr. Ramón Rodríguez",
        especialidad: "Traumatología y Ortopedia",
        consultorio: "107",
        imagen: "/images/Doctores/Dr. Ramón Rodríguez Padilla.png"
    },
    {
        id: 22,
        nombre: "Dr. Valente Romero",
        especialidad: "Traumatología / Cirugía de Cadera",
        consultorio: "134",
        imagen: "/images/Doctores/Dr. Valente Romero Rodriguez.png"
    },
    {
        id: 23,
        nombre: "Dr. Aldo Galván",
        especialidad: "Anatomopatología",
        consultorio: "141",
        imagen: "/images/Doctores/DR. ALDO IVAN GALVAN LINARES.png"
    },
    {
        id: 24,
        nombre: "Dr. Augusto Ramírez",
        especialidad: "Cirugía Cardiovascular y Torácica / Angiología",
        consultorio: "102",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 25,
        nombre: "Dr. Benjamín Sánchez",
        especialidad: "Cirugía Maxilofacial",
        consultorio: "112",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 26,
        nombre: "Dr. Jacinto Díaz",
        especialidad: "Cirugía Maxilofacial",
        consultorio: "112",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 27,
        nombre: "Dr. José Quintana",
        especialidad: "Cirujano Oncológico",
        consultorio: "133",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 28,
        nombre: "Dr. Julio Torres",
        especialidad: "Cirugía Cardiotorácica y Vascular Periférica",
        consultorio: "142",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 29,
        nombre: "Dra. Nereida Cortez",
        especialidad: "Periodoncia",
        consultorio: "112",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 30,
        nombre: "Dra. Paulina Montaño",
        especialidad: "Radiología y Radiología Oncológica",
        consultorio: "108",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 31,
        nombre: "Dr. Francisco Castrejón",
        especialidad: "Cardiología",
        consultorio: "142",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 32,
        nombre: "Dr. Francisco Vilches",
        especialidad: "Radiología",
        consultorio: "109",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 33,
        nombre: "Dr. Francisco Mendoza",
        especialidad: "Alergia e Inmunología Clínica",
        consultorio: "103",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 34,
        nombre: "Dr. Francisco Orta",
        especialidad: "Neurocirugía y Cirugía de Columna",
        consultorio: "137",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 35,
        nombre: "Lic. Edna Hernández",
        especialidad: "Fisioterapia",
        consultorio: "143",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 36,
        nombre: "Lic. Fátima García",
        especialidad: "Fisioterapia",
        consultorio: "143",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 37,
        nombre: "Lic. Israel Rentería",
        especialidad: "Fisioterapia",
        consultorio: "143",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 38,
        nombre: "Lic. Patricia Maldonado",
        especialidad: "Nutrición Clínica",
        consultorio: "133",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 39,
        nombre: "Dra. Claudia Carolina Castellanos Cervantes",
        especialidad: "Nutrición Gerontológica",
        consultorio: "131",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 40,
        nombre: "Dr. Juan González",
        especialidad: "Medicina General",
        consultorio: "132",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 41,
        nombre: "Dr. Israel Armida Granados",
        especialidad: "Nefrología",
        consultorio: "120",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 42,
        nombre: "Dr. Javier Medrano",
        especialidad: "Urología de Mínima Invasión",
        consultorio: "A - Ext. 113",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 43,
        nombre: "Dra. Alejandra Muñoz Valdivia",
        especialidad: "Psiquiatría y Adicciones",
        consultorio: "133",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 44,
        nombre: "Dr. Jairo Barba",
        especialidad: "Medicina General",
        consultorio: "104",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 45,
        nombre: "Dr. Asael Palafox",
        especialidad: "Oncología Clínica",
        consultorio: "114",
        imagen: "/images/Doctores/Dr. Asael Palafoz Cázarez.png"
    },
    {
        id: 46,
        nombre: "Lic. María Guerrero",
        especialidad: "Fisioterapia",
        consultorio: "143",
        imagen: "/images/Doctores/Lic. Maria Fernanda Guerrero Monjaraz.png"
    },
    {
        id: 47,
        nombre: "Dr. Juan Ángel Cibrián Delgado",
        especialidad: "Cardiología Clínica e Intervencionista",
        consultorio: "131",
        imagen: "/images/Doctores/Dr. Juan Ángel Cibrián Delgado.jpeg"
    },
    {
        id: 48,
        nombre: "Dr. Juan Carlos García Lino",
        especialidad: "Cirugía Pediátrica",
        consultorio: "102",
        imagen: "/images/Doctores/174x224.png"
    },
    {
        id: 49,
        nombre: "Dr. Jesús Estrada Hernández",
        especialidad: "Endoscopia Gastrointestinal",
        consultorio: "110",
        imagen: "/images/Doctores/174x224.png"
    }
];

const listaDoctores = ref(doctores)
</script>

<template>
    <ul class="grid grid-cols-4 grid-rows-5 gap-4">
        <li v-for="doctor in listaDoctores" :key="doctor.id" class="text-left">
            <figure class="flex items-center justify-center w-72">
                <img :src="doctor.imagen" :alt="doctor.nombre" class="rounded-2xl w-72">
            </figure>

            <h3 class="my-2 text-2xl font-semibold">
                {{ doctor.nombre }}
            </h3>

            <p class="text-base">
                {{ doctor.especialidad }}
            </p>

            <span>
                Consultorio {{ doctor.consultorio }}
            </span>
        </li>
    </ul>
</template>