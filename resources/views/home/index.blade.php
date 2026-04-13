<x-main>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <section class="flex flex-col justify-center md:py-20">
        <header class="flex flex-col items-center">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Sobre nosotros
            </p>
            <h1 class="w-2/3 pb-8 text-5xl font-medium text-center md:text-8xl">
                Atención que inspira confianza
            </h1>
        </header>
        <figure class="relative flex items-center justify-center px-6">
            <img src="{{ asset('images/Home/Hero.jpeg') }}"
                alt="Equipo médico profesional en instalaciones hospitalarias modernas"
                class="rounded-2xl md:w-7xl h-58 md:h-auto">
        </figure>
        <ul class="grid grid-cols-2 grid-rows-3 gap-5 py-12 md:flex md:items-center md:justify-around">
            <li class="text-center">
                <span class="block text-5xl font-semibold">30+</span>
                <p class="font-medium">Años de experiencia</p>
            </li>
            <li class="text-center">
                <span class="block text-5xl font-semibold">60+</span>
                <p class="font-medium">Profesionales de la salud</p>
            </li>
            <li class="text-center">
                <span class="block text-5xl font-semibold">5+</span>
                <p class="font-medium">Áreas quirúrgicas</p>
            </li>
            <li class="text-center">
                <span class="block text-5xl font-semibold">3+</span>
                <p class="font-medium">Quirófanos disponibles</p>
            </li>
            <li class="col-span-2 text-center">
                <span class="block text-5xl font-semibold">15+</span>
                <p class="font-medium">Especialidades médicas</p>
            </li>
        </ul>
    </section>
    <section class="flex flex-col items-center justify-center w-full px-6 py-12 md:px-20">
        <header class="flex flex-col items-center">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Como podemos ayudarte
            </p>
            <h2 class="pt-4 pb-8 text-5xl font-medium text-center md:w-2/3 text-quinary">
                Atención médica en cada etapa
            </h2>
        </header>
        <ul class="flex flex-col justify-around w-full gap-4 py-4 md:flex-row">
            <li class="px-8 py-12 text-left border-2 border-gray-200 md:w-1/3 bg-gray-50 rounded-4xl">
                <figure class="flex items-center justify-center w-16 h-16 mb-16 bg-blue-100 rounded-full">
                    <img src="{{ asset('icons/capsule.svg') }}" alt="Icono de paquetes quirúrgicos" class="w-11 h-11">
                </figure>
                <h2 class="pb-2 text-4xl font-semibold">
                    Especialidades médicas
                </h2>
                <p class="pt-2 pr-10 text-base md:pr-18">
                    El hospital integra un equipo multidisciplinario de médicos especialistas que atienden desde
                    consultas generales hasta diagnósticos y tratamientos complejos, ofreciendo atención profesional
                    respaldada por experiencia clínica y tecnología médica adecuada.
                </p>
                <button
                    class="flex items-center justify-center gap-4 px-2 py-2 mt-16 text-base font-semibold cursor-pointer rounded-4xl">
                    Conoce más
                    <img src="{{ asset('icons/arrow-right-short.svg') }}" alt=""
                        class="w-6 bg-gray-300 rounded-full">
                </button>
            </li>
            <li class="px-8 py-12 text-left border-2 border-gray-200 md:w-1/3 bg-gray-50 rounded-4xl">
                <figure class="flex items-center justify-center w-16 h-16 mb-16 bg-gray-100 rounded-full">
                    <img src="{{ asset('icons/hospital.svg') }}" alt="Icono de servicios integrales" class="w-11 h-11">
                </figure>
                <h2 class="pb-2 text-4xl font-semibold">
                    Servicios
                </h2>
                <p class="pt-2 pr-10 text-base md:pr-18">
                    Ofrece servicios de apoyo diagnóstico, hospitalización y atención especializada que permiten una
                    cobertura completa en cada etapa del tratamiento, asegurando continuidad médica y seguimiento
                    adecuado para cada paciente.
                </p>
                <button
                    class="flex items-center justify-center gap-4 px-2 py-2 mt-16 text-base font-semibold cursor-pointer rounded-4xl">
                    Explorar servicios
                    <img src="{{ asset('icons/arrow-right-short.svg') }}" alt=""
                        class="w-6 bg-gray-300 rounded-full">
                </button>
            </li>
            <li class="px-8 py-12 text-left border-2 border-gray-200 md:w-1/3 bg-gray-50 rounded-4xl">
                <figure class="flex items-center justify-center w-16 h-16 mb-16 bg-red-100 rounded-full">
                    <img src="{{ asset('icons/heart-pulse.svg') }}" alt="Icono de paquetes quirúrgicos"
                        class="w-11 h-11">
                </figure>
                <h2 class="pb-2 text-4xl font-semibold">
                    Paquetes quirúrgicos
                </h2>
                <p class="pt-2 pr-10 text-base md:pr-18">
                    Cuenta con paquetes quirúrgicos diseñados para brindar claridad en costos, seguridad en
                    procedimientos y acompañamiento médico antes, durante y después de la intervención, facilitando una
                    experiencia hospitalaria organizada y confiable.
                </p>
                <button
                    class="flex items-center justify-center gap-4 px-2 py-2 mt-16 text-base font-semibold cursor-pointer rounded-4xl">
                    Conoce más
                    <img src="{{ asset('icons/arrow-right-short.svg') }}" alt=""
                        class="w-6 bg-gray-300 rounded-full">
                </button>
            </li>
        </ul>
    </section>
    <section class="flex flex-row items-center justify-center w-full px-6 py-12 md:px-20 md:flex-col">
        <div
            class="flex flex-col-reverse w-full overflow-hidden rounded-3xl bg-linear-to-t from-blue-300 to-gray-200 md:h-164 md:flex-row md:bg-linear-to-r">
            <figure class="md:w-1/2">
                <img src="{{ asset('images/Home/Hospital_panoramica.png') }}"
                    alt="Fachada del Hospital Dr. Raúl Hernández" class="w-full rounded-3xl">
            </figure>
            <article class="flex flex-col justify-center p-10 md:pl-16 md:w-1/2 md:pr-50">
                <p class="mb-3 text-sm font-medium tracking-wide text-tertiary">
                    Nuestra ubicación
                </p>
                <h2 class="mb-6 text-5xl font-semibold leading-tight text-quinary">
                    Visita nuestras instalaciones
                </h2>
                <p class="mb-8 text-lg text-gray-700">
                    Ubicado en la Zona Centro de León, el Hospital Dr. Raúl Hernández
                    ofrece acceso rápido y conveniente para pacientes y familiares,
                    facilitando atención médica oportuna y segura.
                </p>
                <div class="flex gap-4">
                    <a href="https://www.google.com/maps/dir//Hospital+HR+Ra%C3%BAl+Hern%C3%A1ndez,+5+de+Febrero+724,+Centro,+37000+Le%C3%B3n+de+los+Aldama,+Gto./@21.1187282,-101.6784173,17z/data=!3m1!5s0x842bbf09b5c238b7:0x65fbaf69bf9210!4m17!1m7!3m6!1s0x842bbf09b45b9033:0x179d54bf60000b1c!2sHospital+HR+Ra%C3%BAl+Hern%C3%A1ndez!8m2!3d21.1187232!4d-101.6758424!16s%2Fg%2F11bxc5gfrr!4m8!1m0!1m5!1m1!1s0x842bbf09b45b9033:0x179d54bf60000b1c!2m2!1d-101.6758424!2d21.1187232!3e3?authuser=0&entry=ttu&g_ep=EgoyMDI2MDIyNC4wIKXMDSoASAFQAw%3D%3D"
                        class="px-6 py-3 text-sm text-white bg-black rounded-full md:font-medium" target="_blank"
                        rel="noopener noreferrer">
                        Cómo llegar
                    </a>
                    <a href="https://maps.app.goo.gl/S6CBuMScnpvabART9"
                        class="px-6 py-3 text-sm bg-white rounded-full md:font-medium" target="_blank"
                        rel="noopener noreferrer">
                        Ver en mapa
                    </a>
                </div>
            </article>
        </div>
    </section>
    <section class="flex flex-col items-center justify-center w-full px-6 md:px-20 ">
        <header class="flex flex-col items-center">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Certificación
            </p>
            <h2 class="pt-4 pb-8 text-5xl font-medium text-center md:w-2/3 text-quinary">
                Un hospital de Guanajuato para Guanajuato
            </h2>
        </header>
        <div class="flex flex-col w-full gap-8 md:flex-row">
            <article class="flex flex-col items-center justify-center md:pr-40 md:w-1/2">
                <p class="mb-12 text-xl leading-relaxed text-gray-700">
                    En Hospital HR Raúl Hernández contamos con el distintivo Marca GTO,
                    que respalda nuestro compromiso con la calidad, identidad y desarrollo del estado.
                </p>
                <div class="mb-10">
                    <h3 class="mb-3 text-2xl font-semibold text-quinary">
                        01. Distintivo oficial de calidad
                    </h3>
                    <p class="pl-12 leading-relaxed text-gray-600">
                        Ser parte de Marca GTO acredita al hospital como una institución que cumple
                        estándares reconocidos en el estado de Guanajuato.
                    </p>
                </div>
                <div class="mb-10">
                    <h3 class="mb-3 text-2xl font-semibold text-quinary">
                        02. Compromiso con la comunidad
                    </h3>
                    <p class="pl-12 leading-relaxed text-gray-600">
                        Generamos empleo especializado y fortalecemos la red de servicios médicos locales,
                        impulsando el desarrollo regional.
                    </p>
                </div>
                <div>
                    <h3 class="mb-3 text-2xl font-semibold text-quinary">
                        03. Responsabilidad social y crecimiento sostenible
                    </h3>
                    <p class="pl-12 leading-relaxed text-gray-600">
                        Nuestra pertenencia a Marca GTO refleja prácticas responsables, inclusión y mejora
                        continua en la atención médica.
                    </p>
                </div>
            </article>
            <figure class="md:w-1/2">
                <img src="{{ asset('images/Home/MarcaGTO.svg') }}" alt="">
            </figure>
        </div>
    </section>
    <section class="mx-6 my-12 md:px-20">
        <header class="text-center">
            <span class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Campañas y recomendaciones para tu bienestar
            </span>
            <h2 class="pt-4 pb-8 text-5xl font-medium text-center text-quinary">
                Actualidad en salud
            </h2>
        </header>
        <picture class="grid grid-cols-2 grid-rows-1 gap-2 md:flex md:justify-center">
            <img src="{{ asset('images/Home/fecha-abril.jpeg') }}"
                alt="Campaña del Día Mundial de la Salud con mensaje sobre prevención y bienestar"
                class="rounded-lg max-w-42.75 h-77 md:min-w-80.5 md:h-112.5 object-center">
            <img src="{{ asset('images/Home/fecha-abril-2.jpeg') }}"
                alt="Campaña del Día Mundial del Parkinson sobre concientización y apoyo a pacientes"
                class="rounded-lg max-w-42.75 h-77 md:min-w-80.5 md:h-112.5 object-center">
        </picture>
    </section>
    <section class="flex flex-col items-center justify-center w-full px-6 py-12 md:px-20">
        <header class="flex flex-col items-center">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Nuestro equipo
            </p>
            <h2 class="pt-4 pb-8 text-5xl font-medium text-center text-quinary">
                Conoce a nuestros medicos
            </h2>
        </header>
        <ul class="flex flex-col w-full grid-cols-4 grid-rows-2 gap-5 md:grid place-items-center">
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/dr._Santiago_I._Godínez.png') }}"
                        alt="Icono de paquetes quirúrgicos" class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dr. Santiago I.Godínez
                </h3>
                <p class="text-base">
                    Especialidad en genética médica
                </p>
            </li>
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/Dr. Alberto.png') }}" alt="Icono de paquetes quirúrgicos"
                        class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dr. Alberto González
                </h3>
                <p class="text-base">
                    Especialista en urología
                </p>
            </li>
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/DR. ALDO IVAN GALVAN LINARES.png') }}"
                        alt="Icono de paquetes quirúrgicos" class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dr. Aldo Galvan
                </h3>
                <p class="text-base">
                    Anatomopatóloga
                </p>
            </li>
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/Dr. Augusto Ramírez Solís.png') }}"
                        alt="Icono de paquetes quirúrgicos" class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dr. Augusto Ramírez
                </h3>
                <p class="text-base">
                    Especialidad en genética médica
                </p>
            </li>
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/Dr. Benjamín Sánchez Trocino.png') }}"
                        alt="Icono de paquetes quirúrgicos" class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dr. Benjamín Sánchez
                </h3>
                <p class="text-base">
                    Maxilofacial
                </p>
            </li>
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/Dra. Carolina Domínguez Meza.png') }}"
                        alt="Icono de paquetes quirúrgicos" class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dra. Carolina Domínguez
                </h3>
                <p class="text-base">
                    Otorrinolaringología
                </p>
            </li>
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/Dra. Guadalupe Alejandra Uviña Quintero.png') }}"
                        alt="Icono de paquetes quirúrgicos" class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dra. Guadalupe Uviña
                </h3>
                <p class="text-base">
                    Ginecología
                </p>
            </li>
            <li class="text-center border-2 border-gray-200 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="{{ asset('images/Doctores/Dra. Fátima Iranganí Cedillo Azuela.png') }}"
                        alt="Icono de paquetes quirúrgicos" class="object-cover rounded-full aspect-square">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">
                    Dra. Fátima Cedillo
                </h3>
                <p class="text-base">
                    Oftalmología
                </p>
            </li>
        </ul>
    </section>
    <section class="flex flex-col items-center justify-center w-full px-20">
        <header class="flex flex-col items-center w-1/2">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Testimonios
            </p>
            <h2 class="pt-4 pb-8 text-5xl font-medium text-center text-quinary">
                La confianza de nuestra comunidad nos respalda
            </h2>
        </header>
        <div id="reviews" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3"></div>
    </section>
</x-main>
