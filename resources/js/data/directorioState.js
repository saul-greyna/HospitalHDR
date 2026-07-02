import { reactive } from 'vue'
import { doctores } from './doctores.js'

export const directorioState = reactive({
    slugsFiltrados: doctores.map(d => d.slug)
})

export function setSlugsFiltrados(lista) {
    directorioState.slugsFiltrados = lista.map(d => d.slug)
}
