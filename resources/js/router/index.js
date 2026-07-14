import { createRouter, createWebHistory } from 'vue-router'

import Home from '../views/Home.vue'
import ServiciosLaboratorio from '../views/ServiciosLaboratorio.vue'
import DirectorioMedico from '../views/DirectorioMedico.vue'
import Medicos from '../views/Medicos.vue'
import Farmacia from '../views/Farmacia.vue'
import Nosotros from '../views/Nosotros.vue'

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
        },
        {
            path: '/farmacia',
            name: 'farmacia',
            component: Farmacia
        }
    ],
    scrollBehavior(to, from) {
        if (to.name === 'lista' && from.name === 'detalle') {
            return false
        }

        return { top: 0 }
    }
})
