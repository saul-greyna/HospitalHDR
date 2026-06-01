@push('scripts')
    @vite(['resources/js/app.js'])
@endpush

<x-main title="Directorio medico de Hospital Dr. Raúl Hernández" description="Conoce el directorio medico del hopital"
    :url="route('directorio.medico')">
    <section class="bg-gray-200 md:my-14 rounded-2xl" id="app">
        <header class="flex flex-col items-center md:py-11">
            <p class="mt-2 text-xs font-medium tracking-wide md:text-sm text-quaternary">
                Directorio medico
            </p>
            <h1 class="mt-4 text-3xl font-medium text-center md:text-6xl text-quinary">
                Encuentra a nuestros médicos
            </h1>
        </header>
        <directorio-medico></directorio-medico>
    </section>
</x-main>
