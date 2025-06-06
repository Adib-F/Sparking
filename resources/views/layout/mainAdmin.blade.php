<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icon.png')}}" type="image/x-icon">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css">
    @vite('resources/css/app.css')
    @vite('resources/css/sidebar.css')
    @vite('resources/css/loader.css')
    @vite('resources/js/app.js')
    @vite('resources/js/sidebar.js')
    @vite('resources/js/loader.js')
</head>

<body class="font-poppins  [&::-webkit-scrollbar]:w-3
    [&::-webkit-scrollbar-track]:rounded-full
    [&::-webkit-scrollbar-track]:bg-gray-100
    [&::-webkit-scrollbar-thumb]:rounded-full
    [&::-webkit-scrollbar-thumb]:bg-gray-300
    dark:[&::-webkit-scrollbar-track]:bg-neutral-700
    dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">

    <div class="flex h-full overflow-y-auto">
        <!-- Sidebar -->
        <div class="md:w-64 xl:w-[19rem]">
            @include('component/sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-grow">
            <!-- Header -->
            <div class="grid grid-cols-5 p-5 border-b-4">
                @include('component/headerAdmin')
            </div>

            <!-- Content -->
            <div class="container mx-auto sm:p-10 lg:p-5">
                @yield('main')
            </div>
        </div>
    </div>
    <script src="./node_modules/lodash/lodash.min.js"></script>
    <script src="./node_modules/apexcharts/dist/apexcharts.min.js"></script>
    <script src="./node_modules/preline/dist/helper-apexcharts.js"></script>


    <!-- Logout Modal -->
    <div id="modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="hs-vertically-centered-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div
                class="flex flex-col w-full bg-white border shadow-sm pointer-events-auto rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex items-center justify-between px-4 py-3 border-b dark:border-neutral-700">
                    <h3 id="hs-vertically-centered-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Konfirmasi Logout
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <p class="text-center text-gray-800 dark:text-neutral-400">
                        Apakah anda yakin ingin menghapus data ini?
                    </p>

                    <ul class="flex items-center justify-center gap-4 my-10">
                        <li><button type="button" data-hs-overlay="#modal"
                                class="inline-flex items-center justify-center w-32 px-4 py-3 text-sm font-medium text-white border border-transparent rounded-full gap-x-2 bg-Medium-Carmine focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z">
                                    </path>
                                </svg>
                                Tidak
                            </button>
                        </li>
                        <li>
                            <a href="/"
                                class="inline-flex items-center justify-center w-32 px-4 py-3 text-sm font-medium text-white border border-transparent rounded-full gap-x-2 bg-Genoa focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z">
                                    </path>
                                </svg>
                                Ya
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
