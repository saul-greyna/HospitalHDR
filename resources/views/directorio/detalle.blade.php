@push('scripts')
    @vite(['resources/js/app.js'])
@endpush

<x-main title="Directorio medico de Hospital Dr. Raúl Hernández" description="Conoce el directorio medico del hospital">
    <section id="app"
        class="relative grid grid-cols-2 grid-rows-1 gap-4 py-6 place-items-center place-content-center">
    </section>
</x-main>
