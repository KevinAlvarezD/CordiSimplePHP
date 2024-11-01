<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Montserrat:wght@800&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body {
                animation: gradient 15s ease infinite;
                background: linear-gradient(270deg, #FF2D20, #FF8C20, #FFD300, #3DBE29);
                background-size: 400% 400%;
                margin: 0;
                height: 100vh;
                display: flex;
                flex-direction: column;
            }

            @keyframes gradient {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            @keyframes pulse {  

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.1);
                }
            }

            #logo {
                animation: pulse 2s ease-in-out infinite;
                /* Animación siempre activa */
            }

            .nav-link {
                margin: 0 10px;
                /* Margen lateral entre los enlaces */
                color: black;
                /* Color de texto por defecto */
                transition: color 0.3s;
                /* Transición suave para el color */
            }

            .nav-link:hover {
                color: #FF8C20;
                /* Color al pasar el ratón */
            }
        </style>
    @endif
</head>

<body class="font-sans antialiased dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-1 items-center gap-2 py-10">
                    <div class="flex justify-center">
                        <img id="logo" class="h-64 w-auto lg:h-64" src="{{ asset('imgs/Logo.png') }}"
                            alt="Logo">
                    </div>
                    <main class="mt-6">
                        @if (Route::has('login'))
                            <nav class="flex justify-center space-x-4 mt-6">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="border border-yellow-500 text-yellow-500 bg-transparent rounded-md px-4 py-2 transition hover:bg-yellow-500 hover:text-white">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="border border-yellow-500 text-yellow-500 bg-transparent rounded-md px-4 py-2 transition hover:bg-yellow-500 hover:text-white">
                                        Log in
                                    </a>
                    
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="border border-yellow-500 text-yellow-500 bg-transparent rounded-md px-4 py-2 transition hover:bg-yellow-500 hover:text-white">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </main>
                    

                   
                </header>
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </div>
        </div>
    </div>

</body>

</html>
