<template>
    <section class="py-3">
        <header class="flex flex-col items-center">
            <span class="text-xs font-medium tracking-wide md:text-sm text-plata-600">
                Comprometidos con tu bienestar
            </span>
            <h1 class="py-4 text-2xl font-medium text-center md:text-6xl text-azul-600">
                Dr. Raúl Hernández
            </h1>
        </header>
        <article class="grid items-center gap-20 mx-auto md:w-5/6 lg:grid-cols-2">
            <figure>
                <img src="/images/Nosotros/portada.jpg" alt="Equipo médico del hospital"
                    class="object-cover rounded-3xl">
            </figure>
            <div class="space-y-12">
                <div class="p-10 shadow-md bg-sextarian backdrop-blur-sm rounded-3xl">
                    <h2 class="mb-4 text-3xl font-bold text-quinary">Trayectoria del Hospital Dr. Raúl Hernández</h2>
                    <p class="leading-relaxed text-quinary">
                        El Hospital <strong>HR Raúl Hernández</strong> es una institución privada de salud ubicada en
                        León, Guanajuato, con más de 30 años de trayectoria. Inició sus actividades como C.M.Q. Raúl
                        Hernández y, con el paso del tiempo, evolucionó hasta consolidarse como un hospital con
                        infraestructura, especialidades y tecnología orientadas a brindar atención integral a la
                        comunidad.
                    </p>
                </div>
                <div class="p-10 shadow-md bg-sextarian backdrop-blur-sm rounded-3xl">
                    <h2 class="mb-4 text-3xl font-semibold text-quinary">Nuestra misión en el Hospital Dr. Raúl
                        Hernández</h2>
                    <p class="leading-relaxed text-quinary">
                        Contribuir a mejorar la calidad de vida mediante una atención médica completa, confiable y al
                        alcance de todos.
                    </p>
                </div>
                <div class="p-10 shadow-md bg-sextarian rounded-3xl">
                    <h2 class="mb-4 text-3xl font-semibold text-quinary">Nuestra visión en el Hospital Dr. Raúl
                        Hernández</h2>
                    <p class="leading-relaxed text-quinary">
                        Ser un hospital que cuente con la más alta preparación y capacidad profesional en sinergía con
                        tecnología de vanguardia, brindando un servicio de excelencia.
                    </p>
                </div>
            </div>
        </article>
    </section>
    <section class="px-4 py-4 my-16 bg-gray-100 md:p-12 rounded-3xl">
        <header class="text-center">
            <span class="text-xs font-medium tracking-wide text-plata-700 md:text-sm">Valores</span>
            <h2 class="my-4 text-3xl font-medium text-center text-azul-700 md:text-5xl">
                Nuestros valores en el Hospital Dr. Raúl Hernández
            </h2>
        </header>
        <article class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <div class="p-8 transition bg-white shadow-md rounded-3xl hover:shadow-xl">
                <h3 class="mb-2 text-xl font-semibold text-quinary">Honestidad</h3>
                <p class="text-tertiary">Actuamos con transparencia y ética profesional.</p>
            </div>
            <div class="p-8 transition shadow-md bg-secondary/30 rounded-3xl hover:shadow-xl">
                <h3 class="mb-2 text-xl font-semibold text-quinary">Disciplina</h3>
                <p class="text-tertiary">Trabajamos con orden, constancia y compromiso.</p>
            </div>
            <div class="p-8 transition bg-white shadow-md rounded-3xl hover:shadow-xl">
                <h3 class="mb-2 text-xl font-semibold text-quinary">Proactividad</h3>
                <p class="text-tertiary">Nos anticipamos a las necesidades del paciente.</p>
            </div>
            <div class="p-8 transition shadow-md bg-secondary/30 rounded-3xl hover:shadow-xl">
                <h3 class="mb-2 text-xl font-semibold text-quinary">Perseverancia</h3>
                <p class="text-tertiary">Buscamos soluciones hasta lograr resultados.</p>
            </div>
            <div class="p-8 transition bg-white shadow-md rounded-3xl hover:shadow-xl">
                <h3 class="mb-2 text-xl font-semibold text-quinary">Adaptabilidad</h3>
                <p class="text-tertiary">Evolucionamos junto a la tecnología médica.</p>
            </div>
            <div class="p-8 transition shadow-md bg-secondary/30 rounded-3xl hover:shadow-xl">
                <h3 class="mb-2 text-xl font-semibold text-quinary">Responsabilidad</h3>
                <p class="text-tertiary">Asumimos cada caso con compromiso total.</p>
            </div>
        </article>
    </section>
    <section>
        <header class="text-center">
            <span class="text-xs font-medium tracking-wide text-plata-700 md:text-sm">Video institucional</span>
            <h2 class="my-4 text-3xl font-medium text-center text-azul-700 md:text-5xl">
                Institucionalidad del Hospital Dr. Raúl Hernández
            </h2>
        </header>
        <figure>
            <video controls playsinline preload="metadata" poster="/images/Nosotros/portadaVideo.jpeg"
                class="rounded-3xl">
                <source src="/video/institucional_HR2.mp4" type="video/mp4">
            </video>
        </figure>
    </section>
</template>
