<x-navegacion>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/menu.js'])
    <section class="flex flex-col items-center justify-center w-full px-6 md:px-20">
        <header class="flex flex-col items-center md:w-1/2">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Nuestros servicios
            </p>
            <h2 class="pt-4 pb-8 text-5xl font-medium text-center md:text-6xl text-quinary">
                La confianza de nuestra comunidad nos respalda
            </h2>
        </header>
        <div id="app" class="flex flex-col w-full gap-4 md:flex-row md:items-center md:justify-center">
            <servicios-laboratorio></servicios-laboratorio>
        </div>
        {{-- <article>
            <header class="flex flex-col items-center w-1/2">
                <h2 class="pt-12 pb-8 text-6xl font-medium text-center text-quinary">
                    Cafeteria
                </h2>
            </header>
            <figure>
                <img src="{{ asset('images/Servicios/chapata.jpeg') }}" alt="" class=" rounded-3xl">
            </figure>
        </article> --}}
    </section>
</x-navegacion>
