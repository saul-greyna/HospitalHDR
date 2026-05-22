import { createApp } from 'vue'
import ServiciosLaboratorio from './components/ServiciosLaboratorio.vue'
import DirectorioMedico from './components/DirectorioMedico.vue'
import './menu'
import './home'

const appElement = document.getElementById('app')

if (appElement) {
    createApp({
        components: {
            ServiciosLaboratorio,
            DirectorioMedico
        }
    }).mount('#app')
}