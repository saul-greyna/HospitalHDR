<script setup>
import { onMounted } from 'vue'

onMounted(() => {
    const counters = document.querySelectorAll('[data-target-value]')

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return

            const element = entry.target
            const target = Number(element.dataset.targetValue)
            let current = 0
            const increment = Math.ceil(target / 30)

            const timer = setInterval(() => {
                current += increment
                if (current >= target) {
                    current = target
                    clearInterval(timer)
                }
                element.textContent = current + '+'
            }, 16)

            observer.unobserve(element)
        })
    }, { threshold: 0.1 })

    counters.forEach(counter => observer.observe(counter))
})
</script>

<template>
    <section class="grid grid-cols-2 md:mb-24 md:mt-16 place-content-center">
        <header class="col-span-2 text-center place-items-center place-content-center">
            <span class="mb-4 text-xs font-medium tracking-wide md:text-sm text-plata-600">
                Sobre nosotros
            </span>
            <h1 class="w-2/3 pb-4 text-2xl font-medium md:text-8xl md:pb-12 md:w-11/12 text-azul-600">
                Hospital con atención médica especializada
            </h1>
        </header>
        <picture class="col-span-2 row-start-2 place-content-center place-items-center">
            <source sizes="(min-width: 1400px) 1280px, 93.7vw" srcset="/images/Home/Oms-Cada-Paciente-Es-Unico-382.webp 382w,
                        /images/Home/Oms-Cada-Paciente-Es-Unico-984.webp 984w,
                        /images/Home/Oms-Cada-Paciente-Es-Unico-1280.webp 1280w,
                        /images/Home/Oms-Cada-Paciente-Es-Unico-1710.webp 1710w,
                        /images/Home/Oms-Cada-Paciente-Es-Unico-2048.webp 2048w" type="image/webp">
            <img src="/images/Home/Oms-Cada-Paciente-Es-Unico-382.webp" alt="Profesional medico con receta"
                class="w-full h-auto max-w-7xl rounded-2xl" fetchpriority="high" loading="eager" width="335"
                height="124">
        </picture>
        <ul
            class="grid grid-cols-2 col-span-2 grid-rows-3 row-start-3 gap-y-8 gap-x-5 mt-7 md:grid-cols-5 md:grid-rows-1 md:my-16 place-items-center">
            <li class="text-center">
                <span class="inline-block md:text-5xl font-semibold tabular-nums min-w-[4ch] text-4xl"
                    data-target-value="30">0</span>
                <p class="font-medium">Años de experiencia</p>
            </li>
            <li class="text-center">
                <span class="inline-block md:text-5xl font-semibold tabular-nums min-w-[4ch] text-4xl"
                    data-target-value="60">0</span>
                <p class="font-medium">Profesionales de la salud</p>
            </li>
            <li class="row-start-2 text-center md:row-start-auto">
                <span class="inline-block md:text-5xl font-semibold tabular-nums min-w-[4ch] text-4xl"
                    data-target-value="5">0</span>
                <p class="font-medium">Áreas quirúrgicas</p>
            </li>
            <li class="row-start-2 text-center md:row-start-auto">
                <span class="inline-block md:text-5xl font-semibold tabular-nums min-w-[4ch] text-4xl"
                    data-target-value="3">0</span>
                <p class="font-medium">Quirófanos disponibles</p>
            </li>
            <li class="col-span-2 row-start-3 text-center md:col-auto md:row-start-auto">
                <span class="inline-block md:text-5xl font-semibold tabular-nums min-w-[4ch] text-4xl"
                    data-target-value="15">0</span>
                <p class="font-medium">Especialidades médicas</p>
            </li>
        </ul>
    </section>
    <section class="flex flex-col items-center justify-center py-6">
        <header class="flex flex-col items-center">
            <span class="my-2 text-xs font-medium tracking-wide text-plata-700 md:text-sm">Como podemos ayudarte</span>
            <h2 class="pt-4 pb-8 text-3xl font-medium text-center text-azul-700 md:w-2/3 md:text-5xl">
                Servicios hospitalarios y especialidades médicas en León
            </h2>
        </header>
        <ul class="flex flex-col justify-around w-full gap-4 py-4 md:flex-row">
            <li class="px-8 py-12 text-left border-2 border-gray-300 md:w-1/3 bg-gray-50 rounded-4xl">
                <figure class="flex items-center justify-center w-16 h-16 mb-16 bg-blue-100 rounded-full">
                    <img src="/icons/capsule.svg" alt="Icono de paquetes quirúrgicos" class="w-11 h-11">
                </figure>
                <h3 class="pb-2 text-4xl font-semibold">Especialidades médicas</h3>
                <p class="pt-2 pr-10 text-base md:pr-18">
                    El hospital integra un equipo multidisciplinario de médicos especialistas que atienden desde
                    consultas generales hasta diagnósticos y tratamientos complejos, ofreciendo atención profesional
                    respaldada por experiencia clínica y tecnología médica adecuada.
                </p>
                <RouterLink to="/directorio-medico"
                    class="flex items-start gap-4 px-2 py-2 mt-16 text-base font-semibold cursor-pointer rounded-4xl">
                    Conoce más
                    <img src="/icons/arrow-right-short.svg" alt="" width="24" height="24"
                        class="w-6 bg-gray-300 rounded-full">
                </RouterLink>
            </li>
            <li class="px-8 py-12 text-left border-2 border-gray-300 md:w-1/3 bg-gray-50 rounded-4xl">
                <figure class="flex items-center justify-center w-16 h-16 mb-16 bg-gray-100 rounded-full">
                    <img src="/icons/hospital.svg" alt="Icono de servicios integrales" class="w-11 h-11">
                </figure>
                <h3 class="pb-2 text-4xl font-semibold">Servicios Medicos</h3>
                <p class="pt-2 pr-10 text-base md:pr-18">
                    Ofrece servicios de apoyo diagnóstico, hospitalización y atención especializada que permiten una
                    cobertura completa en cada etapa del tratamiento, asegurando continuidad médica y seguimiento
                    adecuado para cada paciente.
                </p>
                <RouterLink to="/servicios"
                    class="flex items-start gap-4 px-2 py-2 mt-16 text-base font-semibold cursor-pointer rounded-4xl">
                    Explorar servicios
                    <img src="/icons/arrow-right-short.svg" alt="" width="24" height="24"
                        class="w-6 bg-gray-300 rounded-full">
                </RouterLink>
            </li>
            <li class="px-8 py-12 text-left border-2 border-gray-300 md:w-1/3 bg-gray-50 rounded-4xl">
                <figure class="flex items-center justify-center w-16 h-16 mb-16 bg-red-100 rounded-full">
                    <img src="/icons/heart-pulse.svg" alt="Icono de paquetes quirúrgicos" class="w-11 h-11">
                </figure>
                <h3 class="pb-2 text-4xl font-semibold">Paquetes quirúrgicos</h3>
                <p class="pt-2 pr-10 text-base md:pr-18">
                    Cuenta con paquetes quirúrgicos diseñados para brindar claridad en costos, seguridad en
                    procedimientos y acompañamiento médico antes, durante y después de la intervención, facilitando una
                    experiencia hospitalaria organizada y confiable.
                </p>
                <button
                    class="flex items-center justify-center gap-4 px-2 py-2 mt-16 text-base font-semibold cursor-pointer rounded-4xl">
                    Conoce más
                    <img src="/icons/arrow-right-short.svg" alt="" width="24" height="24"
                        class="w-6 bg-gray-300 rounded-full">
                </button>
            </li>
        </ul>
    </section>
    <section class="flex flex-row items-center justify-center w-full py-6 md:flex-col">
        <div
            class="flex flex-col-reverse w-full overflow-hidden rounded-3xl bg-linear-to-t from-blue-300 to-gray-200 md:h-160 md:flex-row md:bg-linear-to-r">
            <picture class="md:w-1/2">
                <source sizes="(min-width: 768px) 50vw, 93vw" srcset="/images/Home/Fachada-Del-Hospital-Dr-Raul-Hernadez-380.webp 380w,
                            /images/Home/Fachada-Del-Hospital-Dr-Raul-Hernadez-480.webp 480w,
                            /images/Home/Fachada-Del-Hospital-Dr-Raul-Hernadez-760.webp 760w,
                            /images/Home/Fachada-Del-Hospital-Dr-Raul-Hernadez-1140.webp 1140w" type="image/webp">
                <img src="/images/Home/Fachada-Del-Hospital-Dr-Raul-Hernadez-380.webp"
                    alt="Fachada del Hospital Dr. Raúl Hernández" width="380" height="285" loading="lazy"
                    class="w-full h-auto md:rounded-3xl">
            </picture>
            <header class="flex flex-col justify-center p-6 md:p-10 md:pl-12 md:w-1/2 md:pr-40">
                <span class="mb-3 text-sm font-medium tracking-wide text-plata-700">Nuestra ubicación</span>
                <h2 class="mb-6 text-3xl font-semibold leading-tight text-left text-azul-700 md:text-5xl">
                    Hospital en León, Guanajuato con ubicación en Zona Centro
                </h2>
                <p class="mb-8 text-base text-gray-700">
                    Nuestro hospital en León ofrece acceso rápido para atención médica, hospitalización y servicios de
                    emergencia, facilitando el ingreso inmediato de pacientes.
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
            </header>
        </div>
    </section>
    <section class="flex flex-col items-center justify-center w-full py-6">
        <header class="flex flex-col items-center">
            <p class="my-4 text-sm font-medium tracking-wide text-plata-700">Certificación</p>
            <h2 class="pt-4 pb-8 text-3xl font-medium text-center text-azul-700 md:w-2/3 md:text-5xl">
                Hospital certificado en Guanajuato con estándares de calidad médica
            </h2>
        </header>
        <div class="flex flex-col w-full gap-8 md:flex-row">
            <article class="flex flex-col items-center justify-center md:pr-40 md:w-1/2">
                <p class="mb-12 text-xl leading-relaxed text-gray-700">
                    En Hospital HR Raúl Hernández contamos con el distintivo Marca GTO,
                    que respalda nuestro compromiso con la calidad, identidad y desarrollo del estado.
                </p>
                <div class="mb-10">
                    <h3 class="mb-3 text-2xl font-semibold text-quinary">01. Distintivo oficial de calidad</h3>
                    <p class="leading-relaxed text-gray-600 pl-9">
                        Ser parte de Marca GTO acredita al hospital como una institución que cumple
                        estándares reconocidos en el estado de Guanajuato.
                    </p>
                </div>
                <div class="mb-10">
                    <h3 class="mb-3 text-2xl font-semibold text-quinary">02. Compromiso con la comunidad</h3>
                    <p class="leading-relaxed text-gray-600 pl-9">
                        Generamos empleo especializado y fortalecemos la red de servicios médicos locales,
                        impulsando el desarrollo regional.
                    </p>
                </div>
                <div>
                    <h3 class="mb-3 text-2xl font-semibold text-quinary">03. Responsabilidad social y crecimiento
                        sostenible</h3>
                    <p class="leading-relaxed text-gray-600 pl-9">
                        Nuestra pertenencia a Marca GTO refleja prácticas responsables, inclusión y mejora
                        continua en la atención médica.
                    </p>
                </div>
            </article>
            <figure class="md:w-1/2">
                <img src="/images/Home/MarcaGTO.svg"
                    alt="Logo del Distintivo Marca Guanajuato del Hospital Dr. Raúl Hernández" class="w-full"
                    loading="lazy" width="366" height="253">
            </figure>
        </div>
    </section>
    <section class="py-6">
        <header class="text-center">
            <p class="my-4 text-sm font-medium tracking-wide text-plata-700">Actualidad médica</p>
            <h2 class="pt-4 pb-8 text-3xl font-medium text-center text-azul-700 md:text-5xl">
                Campañas de salud del hospital
            </h2>
        </header>
        <div class="grid grid-cols-2 gap-1 md:flex md:justify-center md:gap-8">
            <picture>
                <source srcset="/images/Home/7-Abril-Dia-Mundial-de-la-Salud-183.webp 183w,
                                /images/Home/7-Abril-Dia-Mundial-de-la-Salud-288.webp 288w"
                    sizes="(max-width: 768px) 183px, 288px">
                <img src="/images/Home/7-Abril-Dia-Mundial-de-la-Salud-183.webp" width="183" height="325"
                    alt="Campaña del Día Mundial de la Salud" class="rounded-lg md:min-w-72" loading="lazy">
            </picture>
            <picture>
                <source srcset="/images/Home/11-Abril-Dia-Mundial-del-Parkinson-183.webp 183w,
                                /images/Home/11-Abril-Dia-Mundial-del-Parkinson-288.webp 288w"
                    sizes="(max-width: 768px) 183px, 288px">
                <img src="/images/Home/11-Abril-Dia-Mundial-del-Parkinson-183.webp" width="183" height="325"
                    alt="Campaña del Día Mundial del Parkinson" class="rounded-lg md:min-w-72" loading="lazy">
            </picture>
        </div>
    </section>
    <section class="flex flex-col items-center justify-center w-full py-6">
        <header class="flex flex-col items-center">
            <p class="my-4 text-sm font-medium tracking-wide text-plata-700">Nuestro equipo</p>
            <h2 class="pt-4 pb-8 text-3xl font-medium text-center text-azul-700 md:text-5xl">
                Médicos especialistas en nuestro hospital
            </h2>
        </header>
        <ul class="flex flex-col w-full grid-cols-4 grid-rows-2 gap-5 md:grid place-items-center">
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dr-Santiago-Ignacio-Godinez-Hernandez.webp" width="174" height="174"
                        alt="Dr. Santiago Ignacio Godínez Hernández" class="object-cover rounded-full aspect-square"
                        loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dr. Santiago I. Godínez</h3>
                <p class="text-base">Especialidad en genética médica</p>
            </li>
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dr-Alberto-Antonio-Gonzalez-Bravo.webp" width="174" height="174"
                        alt="Dr. Alberto Antonio González Bravo" class="object-cover rounded-full aspect-square"
                        loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dr. Alberto González</h3>
                <p class="text-base">Especialista en urología</p>
            </li>
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dr-Aldo-Ivan-Galvan-Linares.webp" width="174" height="174"
                        alt="Dr. Aldo Iván Galván Linares" class="object-cover rounded-full aspect-square"
                        loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dr. Aldo Galvan</h3>
                <p class="text-base">Anatomopatóloga</p>
            </li>
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dr-Augusto-Ramirez-Solis.webp" width="174" height="174"
                        alt="Dr. Augusto Ramírez Solís" class="object-cover rounded-full aspect-square" loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dr. Augusto Ramírez</h3>
                <p class="text-base">Especialidad en genética médica</p>
            </li>
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dr-Benjamin-Sanchez-Trocino.webp" width="174" height="174"
                        alt="Dr. Benjamín Sánchez Trocino" class="object-cover rounded-full aspect-square"
                        loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dr. Benjamín Sánchez</h3>
                <p class="text-base">Maxilofacial</p>
            </li>
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dra-Carolina-Dominguez-Meza.webp" width="174" height="174"
                        alt="Dra. Carolina Domínguez Meza" class="object-cover rounded-full aspect-square"
                        loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dra. Carolina Domínguez</h3>
                <p class="text-base">Otorrinolaringología</p>
            </li>
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dra-Guadalupe-Alejandra-Uvina-Quintero.webp" width="174"
                        height="174" alt="Dra. Guadalupe Alejandra Uviña Quintero"
                        class="object-cover rounded-full aspect-square" loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dra. Guadalupe Uviña</h3>
                <p class="text-base">Ginecología</p>
            </li>
            <li class="text-center border-2 border-gray-300 bg-gray-50 rounded-4xl w-80 h-80">
                <figure class="flex items-center justify-center m-4">
                    <img src="/images/Home/doctores/Dra-Fatima-Irangani-Cedillo-Azuela.webp" width="174" height="174"
                        alt="Dra. Fátima Irangani Cedillo Azuela" class="object-cover rounded-full aspect-square"
                        loading="lazy">
                </figure>
                <h3 class="mb-4 text-2xl font-semibold">Dra. Fátima Cedillo</h3>
                <p class="text-base">Oftalmología</p>
            </li>
        </ul>
    </section>
</template>
