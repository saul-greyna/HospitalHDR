import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home.vue'
import Nosotros from '../components/Nosotros.vue'
import DirectorioMedico from '../components/DirectorioMedico.vue'
import Medicos from '../components/Medicos.vue'
import ServiciosLaboratorio from '../components/ServiciosLaboratorio.vue'
import Farmacia from '../components/Farmacia.vue'

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
