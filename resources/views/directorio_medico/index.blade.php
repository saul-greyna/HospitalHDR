<x-main>
    <section class="w-full px-6 py-10 md:px-20">
        <div class="bg-gray-200 rounded-3xl">
            <header class="flex flex-col items-center">
                <p class="my-4 text-sm font-medium tracking-wide text-quaternary">
                    Directorio medico
                </p>
                <h1 class="pt-4 pb-8 text-4xl font-medium text-center md:text-6xl text-quinary">
                    Encuentra a nuestros médicos
                </h1>
            </header>
            <form class="grid grid-cols-2 grid-rows-2 gap-5 p-4 rounded-lg shadow-sm md:items-center md:flex md:mx-38">
                <select
                    class="w-full px-4 py-2 text-gray-900 rounded-md md:w-auto focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50">
                    <option>Area</option>
                </select>
                <select
                    class="w-full px-4 py-2 text-gray-600 rounded-md md:w-auto focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50">
                    <option>Especialidad</option>
                    <option>Pediatría</option>
                    <option>Otorrinolaringología</option>
                    <option>Oncología Clínica</option>
                    <option>Oftalmología</option>
                    <option>Nutrición Clínica</option>
                    <option>Neuropediatría</option>
                    <option>Neurocirugía</option>
                    <option>Ginecología</option>
                    <option>Geriatría</option>
                    <option>Cirugía Plástica</option>
                </select>
                <div class="relative w-full">
                    <input type="text" placeholder="Nombre"
                        class="w-full px-4 py-2 pl-10 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-4 h-4 text-gray-400 left-3 top-3"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.6-5.4a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button
                    class="w-full px-6 py-2 text-white transition duration-200 bg-blue-600 rounded-md md:w-auto hover:bg-blue-700">
                    Buscar
                </button>
            </form>
            <div id="app" class="grid px-4 py-4 md:px-20">
                <directorio-medico></directorio-medico>
            </div>
        </div>
    </section>
</x-main>
