@extends('layout/mainAdmin')

@section('main')
    <!-- Awalan -->
    <div class="pl-5 mb-4 text-2xl font-bold md:text-3xl xl:text-2xl">
        <span>Selamat datang, Admin</span>
    </div>

    <!-- Card Grid -->
    <div class="grid justify-center grid-cols-1 p-12 mx-6 my-8 gap-y-16 sm:grid-cols-2 lg:grid-cols-3 gap-x-10">

        <!-- Card 1 -->
        <div
            class="flex flex-col max-w-sm h-auto bg-[#95AFE5] border border-gray-200 shadow-md p-7 md:rounded-2xl hover:bg-blue-400">
            <a href="{{ route('admin-users') }}" class="block">
                <div class="flex items-center mb-1 pl-7">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="flex flex-col">
                            <p data-hs-toggle-count='{
                            "target": "#toggle-count",
                            "min": 0,
                            "max": 150
                            }'
                                class="text-4xl font-semibold text-center text-gray-800">
                                {{ $data['total_user'] }}
                            </p>
                            <h4 class="text-xl text-center text-black">Pengguna</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 3 -->
        <div
            class="flex flex-col max-w-sm h-auto bg-[#95AFE5] border border-gray-200 shadow-md p-7 md:rounded-2xl hover:bg-blue-400">
            <a href="{{ route('admin-zona') }}" class="block">
                <div class="flex items-center mb-1 pl-7">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M112,80a16,16,0,1,1,16,16A16,16,0,0,1,112,80ZM64,80a64,64,0,0,1,128,0c0,59.95-57.58,93.54-60,94.95a8,8,0,0,1-7.94,0C121.58,173.54,64,140,64,80Zm16,0c0,42.2,35.84,70.21,48,78.5,12.15-8.28,48-36.3,48-78.5a48,48,0,0,0-96,0Zm122.77,67.63a8,8,0,0,0-5.54,15C213.74,168.74,224,176.92,224,184c0,13.36-36.52,32-96,32s-96-18.64-96-32c0-7.08,10.26-15.26,26.77-21.36a8,8,0,0,0-5.54-15C29.22,156.49,16,169.41,16,184c0,31.18,57.71,48,112,48s112-16.82,112-48C240,169.41,226.78,156.49,202.77,147.63Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="flex flex-col">
                            <p data-hs-toggle-count='{
                                "target": "#toggle-count",
                                "min": 0,
                                "max": 150
                                }'
                                class="text-4xl font-semibold text-center text-gray-800">
                                {{ $data['total_zona'] }}
                            </p>
                            <h4 class="text-xl text-center text-black">Zona Parkir</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card 4 --}}
        <div
            class="flex flex-col max-w-sm h-auto bg-[#95AFE5] border border-gray-200 shadow-md p-7 md:rounded-2xl hover:bg-blue-400">
            <a href="{{ route('admin-slot') }}" class="block">
                <div class="flex items-center mb-1 pl-7">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M240,192h-8V98.67a16,16,0,0,0-7.12-13.31l-88-58.67a16,16,0,0,0-17.75,0l-88,58.67A16,16,0,0,0,24,98.67V192H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM40,98.67,128,40l88,58.66V192H192V136a8,8,0,0,0-8-8H72a8,8,0,0,0-8,8v56H40ZM176,144v16H136V144Zm-56,16H80V144h40ZM80,176h40v16H80Zm56,0h40v16H136Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="flex flex-col">
                            <p data-hs-toggle-count='{
                                    "target": "#toggle-count",
                                    "min": 0,
                                    "max": 150
                                    }'
                                class="text-4xl font-semibold text-center text-gray-800">
                                {{ $data['total_slot'] }}
                            </p>
                            <h4 class="text-xl text-center text-black">Slot Parkir</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Card 5 -->
        <div
            class="flex flex-col max-w-sm h-auto bg-[#95AFE5] border border-gray-200 shadow-md p-7 md:rounded-2xl hover:bg-blue-400">
            <a href="{{ route('admin-users') }}" class="block">
                <div class="flex items-center mb-1 pl-7">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M240,104H229.2L201.42,41.5A16,16,0,0,0,186.8,32H69.2a16,16,0,0,0-14.62,9.5L26.8,104H16a8,8,0,0,0,0,16h8v80a16,16,0,0,0,16,16H64a16,16,0,0,0,16-16V184h96v16a16,16,0,0,0,16,16h24a16,16,0,0,0,16-16V120h8a8,8,0,0,0,0-16ZM69.2,48H186.8l24.89,56H44.31ZM64,200H40V184H64Zm128,0V184h24v16Zm24-32H40V120H216ZM56,144a8,8,0,0,1,8-8H80a8,8,0,0,1,0,16H64A8,8,0,0,1,56,144Zm112,0a8,8,0,0,1,8-8h16a8,8,0,0,1,0,16H176A8,8,0,0,1,168,144Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="flex flex-col">
                            <p data-hs-toggle-count='{
                            "target": "#toggle-count",
                            "min": 0,
                            "max": 150
                            }'
                                class="text-4xl font-semibold text-center text-gray-800">
                                {{ $data['total_mobil'] }}
                            </p>
                            <h4 class="text-xl text-center text-black">Mobil</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 6 -->
        <div
            class="flex flex-col max-w-sm h-auto bg-[#95AFE5] border border-gray-200 shadow-md p-7 md:rounded-2xl hover:bg-blue-400">
            <a href="{{ route('admin-users') }}" class="block">
                <div class="flex items-center mb-1 pl-7">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M216,120a41,41,0,0,0-6.6.55l-5.82-15.14A55.64,55.64,0,0,1,216,104a8,8,0,0,0,0-16H196.88L183.47,53.13A8,8,0,0,0,176,48H144a8,8,0,0,0,0,16h26.51l9.23,24H152c-18.5,0-33.5,4.31-43.37,12.46a16,16,0,0,1-16.76,2.07C81.29,97.72,31.13,77.33,26.71,75.6L21,73.36A17.74,17.74,0,0,0,16,72a8,8,0,0,0-2.87,15.46h0c.46.18,47.19,18.3,72.13,29.63a32.15,32.15,0,0,0,33.56-4.29c4.86-4,14.57-8.8,33.19-8.8h18.82a71.74,71.74,0,0,0-24.17,36.59A15.86,15.86,0,0,1,131.32,152H79.2a40,40,0,1,0,0,16h52.12a31.91,31.91,0,0,0,30.74-23.1,56,56,0,0,1,26.59-33.72l5.82,15.13A40,40,0,1,0,216,120ZM40,168H62.62a24,24,0,1,1,0-16H40a8,8,0,0,0,0,16Zm176,16a24,24,0,0,1-15.58-42.23l8.11,21.1a8,8,0,1,0,14.94-5.74L215.35,136l.65,0a24,24,0,0,1,0,48Z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1">
                        <div class="flex flex-col">
                            <p data-hs-toggle-count='{
                            "target": "#toggle-count",
                            "min": 0,
                            "max": 150
                            }'
                                class="text-4xl font-semibold text-center text-gray-800">
                                {{ $data['total_motor'] }}
                            </p>
                            <h4 class="text-lg text-center text-black">Motor</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
@endsection

