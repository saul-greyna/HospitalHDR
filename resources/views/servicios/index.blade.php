@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
<x-main>
    <section class="flex flex-col items-center py-6" id="app">
        <header class="flex flex-col items-center justify-center w-5xl">
            <p class="text-sm font-medium tracking-wide text-quaternary">
                Nuestros servicios
            </p>
            <h1 class="py-6 text-5xl font-medium text-center md:text-6xl text-quinary">
                Servicios médicos y promociones
            </h1>
        </header>
        <servicios-laboratorio></servicios-laboratorio>
    </section>
</x-main>
