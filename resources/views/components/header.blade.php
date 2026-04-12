<header class="relative flex justify-center">
    <nav class="sticky flex items-center justify-between w-11/12 px-8 m-2 bg-gray-200 rounded-full" role="navigation"
        aria-label="Navegación principal">
        <a href="{{ route('inicio') }}" aria-label="Ir al inicio">
            <img src="{{ asset('icons/HospitalDrRaulHernadez_horizontal.svg') }}" alt="Cargatel Logo" width="350"
                height="75" />
        </a>
        <button id="toggle" aria-label="Abrir menú de navegación"
            class="p-2 focus:outline-none text-primary md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
        </button>
        <ul class="absolute left-0 flex-col items-center hidden w-full gap-6 py-6 mt-4 font-medium bg-gray-200 top-full rounded-4xl md:static md:flex md:flex-row md:w-auto md:gap-8 md:mt-0 md:bg-gray-100 md:py-3 md:px-4"
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
                <a href="{{ route('quienes.somos') }}" class="text-sm text-tertiary" title="Quiénes somos en Cargatel">
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
