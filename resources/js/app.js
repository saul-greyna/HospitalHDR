import { createApp } from 'vue'
import ServiciosLaboratorio from './components/ServiciosLaboratorio.vue'
import DirectorioMedico from './components/DirectorioMedico.vue'

const appElement = document.getElementById('app')

if (appElement) {
    createApp({
        components: {
            ServiciosLaboratorio,
            DirectorioMedico
        }
    }).mount('#app')
}