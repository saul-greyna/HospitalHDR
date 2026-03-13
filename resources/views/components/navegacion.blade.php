<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @props(['title' => 'Hospital | Dr. Raúl Hernández'])
    <title>{{ $title }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-aeonik">
    <header class="relative flex justify-center">
        <nav class="sticky flex items-center justify-between w-11/12 px-8 m-2 bg-gray-200 rounded-full" role="navigation"
            aria-label="Navegación principal">
            <a href="{{ route('inicio') }}" aria-label="Ir al inicio">
                <img src="{{ asset('icons/HospitalDrRaulHernadez_horizontal.svg') }}" alt="Cargatel Logo" width="350"
                    height="75" />
            </a>
            <button id="toggle" aria-label="Abrir menú de navegación"
                class="p-2 focus:outline-none text-primary md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <ul class="absolute flex-col items-center hidden w-full gap-6 py-6 mt-4 font-medium top-full rounded-4xl md:static md:flex md:flex-row md:w-auto md:gap-8 md:mt-0 md:bg-gray-100 md:py-3 md:px-4"
                id="menu" aria-label="Menú de navegación">
                {{-- <li>
                    <a href="" class="text-sm text-tertiary" title="Solicita tu cotización de flete o mudanza">
                        Especialidades
                    </a>
                </li> 
                <li>
                    <a href="" class="text-sm text-tertiary" title="Conoce nuestra flota de transporte">
                        Paquetes Quirurgicos
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('servicios') }}" class="text-sm text-tertiary"
                        title="Servicios de mudanza y flete local o foráneo">
                        Servicios
                    </a>
                </li>
                <li>
                    <a href="{{ route('directorio.medico') }}" class="text-sm text-tertiary"
                        title="Quiénes somos en Cargatel">
                        Directorio Medico
                    </a>
                </li>
                <li>
                    <a href="{{ route('quienes.somos') }}" class="text-sm text-tertiary"
                        title="Quiénes somos en Cargatel">
                        Quienes somos
                    </a>
                </li>
            </ul>
            <button
                class="hidden px-2 py-2 text-sm font-medium bg-gray-100 border-2 border-gray-300 cursor-pointer rounded-4xl md:block">
                Contáctanos
            </button>
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="w-full h-auto px-6 md:px-20">
        <div class="flex flex-col items-center justify-center min-h-96 rounded-4xl md:flex-row">
            <picture class="w-full md:w-1/4">
                <img src="{{ asset('icons/HospitalDrRaulHernadez_vertical.svg') }}" alt="Logo pie pagina"
                    class="mim-h-40 mim-w-40">
            </picture>
            <nav aria-label="Footer Navigation" class="flex flex-col justify-around w-3/4 gap-8 md:flex-row">
                <div>
                    <h3 class="mb-3 text-xl font-semibold">Servicios</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Paquetes</a></li>
                        <li><a href="#" class="hover:underline">Especialidades </a></li>
                        <li><a href="#" class="hover:underline">Paquetes quirurgicos</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-3 text-xl font-semibold">Nosotros</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Misión</a></li>
                        <li><a href="#" class="hover:underline">Visión</a></li>
                        <li><a href="#" class="hover:underline">Valores</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-3 text-xl font-semibold">Contáctanos</h3>
                    <ul class="space-y-2 ">
                        <li>
                            <span>
                                5 de Febrero 724, Col. Zona Centro, León, Gto. C.P. 37000
                            </span>
                        </li>
                        <li>
                            <span>477 714-19-73</span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <hr class="border-t-2 border-gray-400">
        <div class="w-full md:flex bg-secondary-text min-h-20">
            <ul class="grid w-full grid-cols-2 grid-rows-2 gap-5 md:justify-between md:items-center md:flex place-items-center">
                <li class="row-start-2">
                    <a href="#" class="hover:underline">Privacidad</a>
                </li>
                <li class="col-span-2">
                    <span class="hover:underline">© 2023 - 2026 HOSPITAL DR RAUL HERNANDEZ S.A. de C.V.</span>
                </li>
                <li class="row-start-2">
                    <a href="#" class="hover:underline">Términos y condiciones</a>
                </li>
            </ul>
        </div>
    </footer>
</body>

</html>
