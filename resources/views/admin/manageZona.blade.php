@extends('layout/mainAdmin')

@section('main')

    <div class="flex flex-col p-6 -ml-5 space-y-4 -mt-7">
        <!-- tombol tambah zona -->
        <div class="ml-10">
            <button data-modal-target="tambah-zona" data-modal-toggle="tambah-zona"
                class="rounded-md bg-base-200 hover:bg-[#95AFE5] p-2 px-2">
                <div id="tambah-zonas" class="flex items-center space-x-0">
                    <i class="fas fa-plus me-2 ">
                    </i>
                    <p class="font-bold text-md">Tambah Zona</p>
                </div>
            </button>
        </div>
        <!-- tabel zona -->
        <div class="grid w-9/12 grid-cols-1 p-5 mx-6 ">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-400 rounded-lg dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">Success!</span> {{ session('success') }}
                </div>
            @endif
            <table class="font-medium table-fixed">
                <thead class="bg-[#95AFE5]">
                    <tr>
                        <th class="px-1 py-2 text-sm font-bold w-[5rem]">No</th>
                        <th class="px-1 py-2 text-sm font-bold w-[30rem]">Nama Zona</th>
                        <th class="px-1 py-2 text-sm font-bold w-[15rem]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($zonas as $index => $zona)
                        <tr
                            class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">

                            <th scope="row"
                                class="px-3 py-2 font-medium text-gray-900 rounded-bl-lg whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}
                            </th>
                            <td class="py-2 px-9">
                                {{ $zona->nama_zona }}
                            </td>
                            <td class="px-1 py-2 rounded-br-lg ">
                                <button data-modal-target="edit-zona-{{ $zona->id }}"
                                    data-modal-toggle="edit-zona-{{ $zona->id }}"
                                    class="inline-flex items-center justify-center py-1 text-sm text-blue-500 hover:underline">
                                    <i class="w-3 h-3 text-blue-500 me-2 fas fa-pen "></i>Edit</button>
                                <button data-modal-target="hapus-zona-{{ $zona->id }}"
                                    data-modal-toggle="hapus-zona-{{ $zona->id }}"
                                    class="inline-flex items-center justify-center px-2 py-1 text-sm text-red-400 hover:underline">
                                    <i class="w-3 h-3 text-red-400 me-2 fas fa-trash "></i>Hapus</button>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>



        <!-- tombol tambah sub zona -->
        <div class="ml-10">
            <button data-modal-target="tambah-subzona" data-modal-toggle="tambah-subzona"
                class="rounded-md bg-base-200 hover:bg-[#95AFE5] p-2 px-2">
                <div class="flex items-center space-x-0">
                    <i class="fas fa-plus me-2">
                    </i>
                    <p class="font-bold text-md">Tambah Sub-Zona</p>
                </div>
            </button>
        </div>


        <form method="GET" action="{{ route('admin-zona') }}">
            <div class="ml-11">
                <!-- <label for="zona_id" class="block text-sm font-bold text-gray-700">Pilih Zona:</label> -->
                <select name="zona_id" id="zona_id" onchange="this.form.submit()"
                    class="block mt-1 font-bold border-gray-300 rounded-md shadow-sm w-36 focus:border-blue-300 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih Zona</option>
                    @foreach ($zonas as $zona)
                        <option value="{{ $zona->id }}" {{ $zona->id == $zonaId ? 'selected' : '' }}>
                            {{ $zona->nama_zona }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Tabel Subzona -->
        <div class="grid w-9/12 grid-cols-1 p-5 mx-6">
            @if (session('succes'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-400 rounded-lg dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">Success!</span> {{ session('succes') }}
                </div>
            @endif
            <table class="text-sm font-medium">
                <thead class="bg-[#95AFE5]">
                    <tr>
                        <th class="px-1 py-2 text-sm font-bold w-[5rem]">No</th>
                        <th class="px-1 py-2 text-sm font-bold w-[30rem]">Nama SubZona</th>
                        <th class="px-1 py-2 text-sm font-bold w-[15rem]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @if ($zonaId === null)
                        <tr>
                            <td colspan="3" class="px-3 py-2 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada zona yang dipilih.
                            </td>
                        </tr>
                    @elseif($subzonas->isEmpty())
                        <tr>
                            <td colspan="3" class="px-3 py-2 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada subzona untuk zona yang dipilih.
                            </td>
                        </tr>
                    @else
                        @foreach ($subzonas as $index => $subzona)
                            <tr
                                class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-3 py-2 font-medium text-gray-900 rounded-bl-lg whitespace-nowrap dark:text-white">
                                    {{ $index + 1 }}
                                </th>
                                <td class="py-2 px-9">
                                    {{ $subzona->nama_subzona }}
                                </td>
                                <td class="px-1 py-2 rounded-br-lg">
                                    <button data-modal-target="edit-subzona-{{ $subzona->id }}"
                                        data-modal-toggle="edit-subzona-{{ $subzona->id }}"
                                        class="inline-flex items-center justify-center py-1 text-sm text-blue-500 hover:underline">
                                        <i class="w-3 h-3 text-blue-500 me-2 fas fa-pen"></i>Edit</button>
                                    <button data-modal-target="hapus-subzona-{{ $subzona->id }}"
                                        data-modal-toggle="hapus-subzona-{{ $subzona->id }}"
                                        class="inline-flex items-center justify-center px-2 py-1 text-sm text-red-400 hover:underline">
                                        <i class="w-3 h-3 text-red-400 me-2 fas fa-trash"></i>Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


        <!-- Pop-Up Error Message -->
        <div id="validation-popup" class="fixed inset-x-0 z-50 flex justify-center hidden top-5">
            <div
                class="relative w-full max-w-sm p-6 bg-white border-l-4 border-red-500 rounded-lg shadow-lg shadow-red-500/80">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.054 0 1.63-1.08.928-1.918l-6.928-8.562a1.25 1.25 0 00-1.856 0l-6.928 8.562c-.702.838-.126 1.918.928 1.918z" />
                    </svg>
                    <span class="ml-3 text-sm font-medium text-gray-900" id="popup-message"></span>
                </div>
                <button onclick="closePopup()" class="absolute text-gray-500 top-2 right-2 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>



    </div>

    <!-- Main Modal Tambah zona -->
    <div id="tambah-zona" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-[#95AFE5]">
                    <h3 class="text-lg font-semibold text-white dark:text-white">
                        Tambah Zona Baru
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-white bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="tambah-zona">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('zona.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 md:p-5">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <label for="nama_zona"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Zona</label>
                            <input type="text" name="nama_zona" id="nama_zona"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukkan Nama Zona" value="{{ old('nama_zona') }}" required>
                        </div>


                        <div class="col-span-2">
                            <label for="keterangan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan
                                Zona</label>
                            <textarea id="keterangan" name="keterangan" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Informasi yang berkaitan dengan zona" required>{{ old('keterangan') }}</textarea>
                        </div>
                        <div class="col-span-2">
                            <div id="image-preview" class="hidden mb-2">
                                <img src="" alt="Preview Foto" class="object-cover w-full h-32 rounded-lg">
                            </div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fotozona">
                                Foto Area Zona
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="fotozona" type="file" name="fotozona"
                                accept="image/*" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                                SVG, PNG, JPG or GIF (MAX. 800x400px).
                            </p>
                        </div>
                    </div>
                    <button type="submit" id="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Tambah Zona
                    </button>
                </form>


            </div>
        </div>
    </div>

    <!-- Main Modal Edit Zona -->
    @foreach ($zonas as $zona)
        <div id="edit-zona-{{ $zona->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full p-4">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-[#95AFE5]">
                        <h3 class="text-lg font-semibold text-white dark:text-white">
                            Edit Zona
                        </h3>
                        <button type="button"
                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-white bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="edit-zona-{{ $zona->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('zona.update', $zona->id) }} "
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Zona</label>
                                <input type="text" value="{{ $zona->nama_zona }}" disabled
                                    class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5">
                            </div>

                            <div class="col-span-2">
                                <label for="keterangan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan
                                    Zona</label>
                                <textarea id="keterangan" name="keterangan" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Masukkan Keterangan Zona">{{ $zona->keterangan }}</textarea>
                            </div>
                            <div class="col-span-2">
                                @if ($zona->fotozona)
                                    @php
                                        $fotoPath = $zona->fotozona;
                                        if (Str::startsWith($fotoPath, 'datafoto')) {
                                            $fotoUrl = asset('storage/' . $fotoPath);
                                        } else {
                                            $fotoUrl = asset(ltrim($fotoPath, '/'));
                                        }
                                    @endphp
                                    <div class="mb-2">
                                        <img src="{{ $fotoUrl }}" alt="Foto Zona"
                                            class="object-cover w-full h-32 rounded-lg">
                                    </div>
                                @endif
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="fotozona">
                                    Foto Area Zona
                                </label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" type="file" name="fotozona" id="fotozona"
                                    accept="image/*">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                                    SVG, PNG, JPG or GIF (MAX. 800x400px).
                                </p>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Main Modal Tambah sub-zona -->
    <div id="tambah-subzona" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-[#95AFE5]">
                    <h3 class="text-lg font-semibold text-white dark:text-white">
                        Tambah Sub-Zona Baru
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-white bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="tambah-subzona">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('subzona.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <label for="zona_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Zona</label>
                            <select name="zona_id" id="zona_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                                <option value="">Pilih Zona</option>
                                @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nama_zona }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-span-2">
                            <label for="nama_subzona"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Sub-Zona</label>
                            <input type="text" name="nama_subzona" id="nama_subzona"
                                value="{{ old('nama_subzona') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukkan Nama Subzona" required>
                        </div>
                        <div class="col-span-2">
                            <label for="camera_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">kamera_id
                            </label>
                            <input type="text" name="camera_id" id="camera_id" value="{{ old('camera_id') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukkan Kamera Id" required>
                        </div>
                        <div class="col-span-2">
                            <div id="image-previewsubzona" class="hidden mb-2">
                                <img src="" alt="Preview Foto" class="object-cover w-full h-32 rounded-lg">
                            </div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="foto">
                                Foto Area Sub-Zona
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="foto" type="file" name="foto"
                                accept="image/*" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                                SVG, PNG, JPG or GIF (MAX. 800x400px).
                            </p>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Tambah Sub-Zona
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Modal Edit sub-Zona -->
    @foreach ($subzonas as $subzona)
        <div id="edit-subzona-{{ $subzona->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full p-4">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-[#95AFE5]">
                        <h3 class="text-lg font-semibold text-white dark:text-white">
                            Edit Sub-Zona
                        </h3>
                        <button type="button"
                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-white bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="edit-subzona-{{ $subzona->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('subzona.update', $subzona->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="col-span-2">
                                <label for="zona_id_edit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Zona</label>
                                <input type="text" value="{{ $subzona->zona->nama_zona }}" disabled
                                    class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5">
                            </div>

                            <div class="col-span-2">
                                <label for="nama_subzona_edit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Sub-Zona</label>
                                <input type="text" value="{{ $subzona->nama_subzona }}" disabled
                                    class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5">
                            </div>
                            <div class="col-span-2">
                                <label for="camera_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamera Id
                                </label>
                                <input type="text" value="{{ $subzona->camera_id }}" name="camera_id"
                                    class="border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5">
                            </div>
                            <div class="col-span-2">
                                @if ($subzona->foto)
                                    @php
                                        $fotoPath = $subzona->foto;
                                        if (Str::startsWith($fotoPath, 'datafoto')) {
                                            $fotoUrl = asset('storage/' . $fotoPath);
                                        } else {
                                            $fotoUrl = asset(ltrim($fotoPath, '/'));
                                        }
                                    @endphp
                                    <div class="mb-2">
                                        <img src="{{ $fotoUrl }}" alt="Foto Subzona"
                                            class="object-cover w-full h-32 rounded-lg">
                                    </div>
                                @endif
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="foto">
                                    Foto Area Sub-Zona
                                </label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" type="file" name="foto" id="foto"
                                    accept="image/*">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                                    SVG, PNG, JPG or GIF (MAX. 800x400px).
                                </p>
                            </div>

                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach



    <!-- Main Modal hapus zona -->
    @foreach ($zonas as $zona)
        <div id="hapus-zona-{{ $zona->id }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full p-4">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="hapus-zona-{{ $zona->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form action="{{ route('zona.destroy', $zona->id) }}" method="POST" class="p-4 md:p-5 ">
                        @csrf
                        @method('DELETE')
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda ingin
                                menghapus
                                "{{ $zona->nama_zona }}" ini ?</h3>
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Iya
                            </button>
                            <button data-modal-toggle="hapus-zona-{{ $zona->id }}" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Main Modal hapus sub-zona -->
    @foreach ($subzonas as $subzona)
        <div id="hapus-subzona-{{ $subzona->id }}" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full p-4">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="hapus-subzona-{{ $subzona->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form action="{{ route('subzona.destroy', $subzona->id) }}" method="POST" class="p-4 md:p-5 ">
                        @csrf
                        @method('DELETE')
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda ingin
                                menghapus Subzona
                                "{{ $subzona->nama_subzona }}"" ini?</h3>
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Iya
                            </button>
                            <button data-modal-toggle="hapus-subzona-{{ $subzona->id }}" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        setTimeout(() => {
            const alert = document.querySelector('[role="alert"]');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);

        document.getElementById('foto').addEventListener('change', function(event) {
            const preview = document.getElementById('image-previewsubzona');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.querySelector('img').src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });

        document.getElementById('fotozona').addEventListener('change', function(event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.querySelector('img').src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const errors = @json($errors->all());
            if (errors.length > 0) {
                const popup = document.getElementById("validation-popup");
                const messageContainer = document.getElementById("popup-message");

                // Set error messages
                messageContainer.innerHTML = errors.map(error => `<p>${error}</p>`).join("");

                // Show the popup
                popup.classList.remove("hidden");
            }
        });

        function closePopup() {
            document.getElementById("validation-popup").classList.add("hidden");
        }
    </script>
@endsection
