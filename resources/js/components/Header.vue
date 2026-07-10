<script setup>
import { ref } from 'vue'

const menuAbierto = ref(false)

function toggleMenu() {
    menuAbierto.value = !menuAbierto.value
}

function cerrarMenu() {
    menuAbierto.value = false
}
</script>

<template>
    <header class="sticky z-50 px-5 top-2 md:px-20">
        <nav class="flex items-center justify-between px-4 my-2 bg-gray-200 rounded-4xl"
            aria-label="Navegación principal">
            <RouterLink to="/" aria-label="Ir al inicio" @click="cerrarMenu">
                <img src="/icons/HospitalDrRaulHernadez_horizontal.svg" alt="Logo del Hospital Dr. Raul Hernandez"
                    width="350" height="75">
            </RouterLink>
            <button @click="toggleMenu" aria-label="Abrir menú de navegación"
                class="p-2 focus:outline-none text-primary md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <ul :class="[menuAbierto ? 'flex' : 'hidden', 'mx-5 absolute top-full mt-2 min-w-85 flex-col items-center gap-6 rounded-2xl bg-gray-200 py-6 font-medium md:static md:flex md:flex-row md:gap-8 md:mt-0 md:bg-gray-100 md:px-4 md:py-3 inset-x-0']"
                aria-label="Menú de navegación">
                <li>
                    <RouterLink to="/servicios" class="text-sm text-tertiary"
                        title="Servicios del Hospital Dr. Raul Hernandez" @click="cerrarMenu">
                        Servicios
                    </RouterLink>
                </li>
                <li>
                    <RouterLink to="/directorio-medico" class="text-sm text-tertiary"
                        title="Directorio médico del Hospital Dr. Raul Hernandez" @click="cerrarMenu">
                        Directorio Médico
                    </RouterLink>
                </li>
                <li>
                    <RouterLink to="/quienes-somos" class="text-sm text-tertiary"
                        title="Quiénes somos en el Hospital Dr. Raul Hernandez" @click="cerrarMenu">
                        Quiénes somos
                    </RouterLink>
                </li>
            </ul>
            <!-- <button
                class="hidden px-2 py-2 text-sm font-medium bg-gray-100 border-2 border-gray-300 cursor-pointer rounded-4xl md:block">
                Contáctanos
            </button> -->
        </nav>
    </header>
</template>
