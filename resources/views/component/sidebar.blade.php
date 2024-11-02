<div class="sidebar md:w-64 xl:w-[19rem] h-svh bg-[#95AFE5]">
    <ul>
        <li class="flex mt-4 mb-10 pointer-events-none logo">
            <a href="#">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>
                <div class="font-bold text md:text-xl xl:text-2xl">Menu</div>
            </a>
        </li>
        <div class="Menulist">
            <li
                class="{{ $title == 'Dashboard Admin' ? 'active' : '' }} hover:px-5 hover:bg-blue-200">
                <a href="{{ route('admin-dashboard') }}">
                    <div class="icon">
                        <svg class="{{ $title == 'Dashboard Admin' ? 'text-black' : 'text-gray-950' }} size-8"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <div
                        class="text md:text-sm xl:text-lg font-bold {{ $title == 'Dashboard Admin' ? 'text-black' : 'text-white' }}">
                        Dashboard
                    </div>
                </a>
            </li>
            <li
                class="{{ $title == 'ManageUsers' ? 'active' : '' }} hover:px-5 hover:bg-blue-200">
                <a href="{{ route('admin-users') }}">
                    <div class="icon">
                        <svg class="{{ $title == 'ManageUsers' ? 'text-black' : 'text-gray-950' }} size-8"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <div
                        class="text md:text-sm xl:text-lg font-bold {{ $title == 'ManageUsers' ? 'text-black' : 'text-white' }}">
                        Pengguna
                    </div>
                </a>
            </li>
            <li
                class="{{ $title == 'ManageZona' ? 'active' : '' }}  hover:px-5 hover:bg-blue-200">
                <a href="{{ route('admin-zona') }}">
                    <div class="icon">
                        <svg class="{{ $title == 'ManageZona' ? 'text-black' : 'text-gray-950' }} size-8"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <div
                        class="text md:text-sm xl:text-lg font-bold {{ $title == 'ManageZona' ? 'text-black' : 'text-white' }}">
                        Zona Parkir
                    </div>
                </a>
            </li>
            <li
                class="{{ $title == 'ManageSlot' ? 'active' : '' }}  hover:px-5 hover:bg-blue-200">
                <a href="{{ route('admin-slot') }}">
                    <div class="icon">
                        <svg class="{{ $title == 'ManageSlot' ? 'text-black' : 'text-gray-950' }} size-8"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M256 32l-74.8 0c-27.1 0-51.3 17.1-60.3 42.6L3.1 407.2C1.1 413 0 419.2 0 425.4C0 455.5 24.5 480 54.6 480L256 480l0-64c0-17.7 14.3-32 32-32s32 14.3 32 32l0 64 201.4 0c30.2 0 54.6-24.5 54.6-54.6c0-6.2-1.1-12.4-3.1-18.2L455.1 74.6C446 49.1 421.9 32 394.8 32L320 32l0 64c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-64zm64 192l0 64c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32s32 14.3 32 32z" />
                        </svg>
                    </div>
                    <div
                        class="text md:text-sm xl:text-lg font-bold {{ $title == 'ManageZona' ? 'text-black' : 'text-white' }}">
                        Slot Parkir
                    </div>
                </a>
            </li>
            <li
                class="{{ $title == 'ManageAnalysis' ? 'active' : '' }} hover:px-5 hover:bg-blue-200">
                <a href="{{ route('admin-analysis') }}">
                    <div class="icon">
                        <svg class="{{ $title == 'ManageAnalysis' ? 'text-black' : 'text-gray-950' }} size-8"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M160 80c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 352c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-352zM0 272c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48L0 272zM368 96l32 0c26.5 0 48 21.5 48 48l0 288c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48z" />
                        </svg>
                    </div>
                    <div
                        class="text md:text-sm xl:text-lg font-bold  hover:px-5 {{ $title == 'ManageAnalysis' ? 'text-black' : 'text-white' }}">
                        Analisis Data
                    </div>
                </a>
            </li>
        </div>
    </ul>
</div>
