<x-navegacion>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <section class="flex flex-col items-center justify-center w-full px-20">
        <header class="flex flex-col items-center w-1/2">
            <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                Nuestros servicios
            </p>
            <h2 class="pt-4 pb-8 text-6xl font-medium text-center text-quinary">
                La confianza de nuestra comunidad nos respalda
            </h2>
        </header>
        <div id="app" class="flex w-full">
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
