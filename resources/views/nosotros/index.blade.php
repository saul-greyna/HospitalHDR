<x-main>
    <section class="w-full px-6 md:px-20">
        <header class="flex flex-col items-center">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Comprometidos con tu bienestar
            </p>
            <h1 class="pt-4 pb-8 text-4xl font-medium text-center md:text-6xl md:w-2/3 text-quinary">
                Hospital Dr. Raúl Hernández
            </h1>
        </header>
        <div class="grid items-center gap-20 mx-auto md:mt-20 md:w-5/6 lg:grid-cols-2">
            <div class="relative">
                <div class="absolute inset-0 rounded-3xl bg-tertiary/20"></div>
                <img src="{{ asset('images/Nosotros/portada.jpg') }}" alt="Equipo médico del hospital"
                    class="object-cover rounded-3xl">
            </div>
            <div class="space-y-12">
                <div class="p-10 bg-blue-300 shadow-md backdrop-blur-sm rounded-3xl">
                    <h3 class="mb-4 text-3xl font-semibold text-quinary">
                        Trayectoria
                    </h3>
                    <p class="leading-relaxed text-tertiary">
                        El Hospital HR Raúl Hernández es una institución privada de salud ubicada en León, Guanajuato,
                        con más de 30 años de trayectoria. Inició sus actividades como C.M.Q. Raúl Hernández y, con el
                        paso del tiempo, evolucionó hasta consolidarse como un hospital con infraestructura,
                        especialidades y tecnología orientadas a brindar atención integral a la comunidad.
                    </p>
                </div>
                <div class="p-10 bg-blue-300 shadow-md backdrop-blur-sm rounded-3xl">
                    <h3 class="mb-4 text-3xl font-semibold text-quinary">
                        Nuestra misión
                    </h3>
                    <p class="leading-relaxed text-tertiary">
                        Contribuir a mejorar la calidad de vida mediante una atención médica completa, confiable y al
                        alcance de todos.
                    </p>
                </div>
                <div class="p-10 bg-blue-300 shadow-md rounded-3xl">
                    <h3 class="mb-4 text-3xl font-semibold text-quinary">
                        Nuestra visión
                    </h3>
                    <p class="leading-relaxed text-quaternary">
                        Ser un hospital que cuente con la más alta preparación y capacidad profesional en sinergía con
                        tecnología de vanguardia, brindando un servicio de excelencia.
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full p-12 my-16 bg-gray-100 rounded-3xl ">
            <div class="mb-12 text-center">
                <h3 class="text-4xl font-semibold text-quinary">
                    Nuestros valores
                </h3>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-8 transition bg-white shadow-md rounded-3xl hover:shadow-xl">
                    <h4 class="mb-2 text-xl font-semibold text-quinary">Honestidad</h4>
                    <p class="text-tertiary">Actuamos con transparencia y ética profesional.</p>
                </div>
                <div class="p-8 transition shadow-md bg-secondary/30 rounded-3xl hover:shadow-xl">
                    <h4 class="mb-2 text-xl font-semibold text-quinary">Disciplina</h4>
                    <p class="text-tertiary">Trabajamos con orden, constancia y compromiso.</p>
                </div>
                <div class="p-8 transition bg-white shadow-md rounded-3xl hover:shadow-xl">
                    <h4 class="mb-2 text-xl font-semibold text-quinary">Proactividad</h4>
                    <p class="text-tertiary">Nos anticipamos a las necesidades del paciente.</p>
                </div>
                <div class="p-8 transition shadow-md bg-secondary/30 rounded-3xl hover:shadow-xl">
                    <h4 class="mb-2 text-xl font-semibold text-quinary">Perseverancia</h4>
                    <p class="text-tertiary">Buscamos soluciones hasta lograr resultados.</p>
                </div>
                <div class="p-8 transition bg-white shadow-md rounded-3xl hover:shadow-xl">
                    <h4 class="mb-2 text-xl font-semibold text-quinary">Adaptabilidad</h4>
                    <p class="text-tertiary">Evolucionamos junto a la tecnología médica.</p>
                </div>
                <div class="p-8 transition shadow-md bg-secondary/30 rounded-3xl hover:shadow-xl">
                    <h4 class="mb-2 text-xl font-semibold text-quinary">Responsabilidad</h4>
                    <p class="text-tertiary">Asumimos cada caso con compromiso total.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full px-6 md:px-20">
        <figure class="h-full">
            <video controls playsinline preload="metadata" poster="{{ asset('images/Nosotros/portadaVideo.jpeg') }}"
                class="object-cover w-full md:h-204 rounded-3xl h-70">
                <source src="{{ asset('video/institucional_HR2.mp4') }}" type="video/mp4">
            </video>
        </figure>
    </section>
</x-main>
