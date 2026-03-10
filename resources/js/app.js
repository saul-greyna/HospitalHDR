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

const reviewsContainer = document.getElementById("reviews")

if (reviewsContainer) {
    fetch('/google-reviews')
        .then(res => res.json())
        .then(data => {

            reviewsContainer.innerHTML = ""

            const reviews = data.result.reviews
                .sort((a, b) => b.rating - a.rating)
                .slice(0, 3)

            reviews.forEach(review => {

                const card = document.createElement("div")

                card.className =
                    "p-6 transition bg-white border border-gray-100 shadow-md rounded-2xl hover:shadow-lg"

                card.innerHTML = `
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold text-gray-800">
                            ${review.author_name}
                        </h3>
                        <span class="text-yellow-500 font-medium">
                            ★ ${review.rating}
                        </span>
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        ${review.text}
                    </p>

                    <p class="text-xs text-gray-400 mt-4">
                        ${review.relative_time_description}
                    </p>
                `

                reviewsContainer.appendChild(card)
            })
        })
}