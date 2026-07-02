import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home.vue'
import Nosotros from '../components/Nosotros.vue'
import DirectorioMedico from '../components/DirectorioMedico.vue'
import Medicos from '../components/Medicos.vue'
import ServiciosLaboratorio from '../components/ServiciosLaboratorio.vue'

export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'inicio',
            component: Home
        },
        {
            path: '/quienes-somos',
            name: 'nosotros',
            component: Nosotros
        },
        {
            path: '/servicios',
            name: 'servicios',
            component: ServiciosLaboratorio
        },
        {
            path: '/directorio-medico',
            name: 'lista',
            component: DirectorioMedico
        },
        {
            path: '/directorio-medico/:slug',
            name: 'detalle',
            component: Medicos
        }
    ],
    scrollBehavior(to, from) {
        // Volver al listado (detalle -> lista) conserva la posición de scroll
        if (to.name === 'lista' && from.name === 'detalle') {
            return false
        }

        // Cualquier otra navegación (cambio de doctor, ir a otra sección) sube al top
        return { top: 0 }
    }
})
