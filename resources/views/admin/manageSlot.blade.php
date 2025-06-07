@extends('layout/mainAdmin')

@section('main')
    <div class="flex flex-col p-6 -ml-5 space-y-4 -mt-7">
        <!-- dropdown pilih zona -->
        <div class="ml-10 dropdown">
            <div tabindex="0" role="button" class="btn hover:bg-[#95AFE5] font-bold w-36 pr-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                {{ $selectedZona ? $selectedZona->nama_zona : 'Pilih Zona' }}
            </div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-36 p-2 shadow">
                @foreach ($zonas as $zona)
                    <li>
                        <a href="{{ route('admin-slot', ['zona' => $zona->id]) }}"
                            class="hover:bg-[#95AFE5] {{ $selectedZona && $selectedZona->id == $zona->id ? 'bg-[#95AFE5]' : '' }}">
                            {{ $zona->nama_zona }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex items-center justify-between w-9/12 px-5 mx-6">

            <div class="">
                <label for="" class="block text-sm font-bold text-gray-700">Pilih SubZona :</label>
                <select
                    onchange="window.location.href='{{ route('slot.getBySubzona', ['subzonaId' => '__SUBZONA_ID__']) }}'.replace('__SUBZONA_ID__', this.value);"
                    class="block mt-1 font-bold border-gray-300 rounded-md shadow-sm w-36 focus:border-blue-300 focus:ring-indigo-500 sm:text-sm">
                    @foreach ($subzonas as $subzona)
                        <option value="{{ $subzona->id }}"
                            {{ $selectedSubzona && $selectedSubzona->id == $subzona->id ? 'selected' : '' }}>
                            {{ $subzona->nama_subzona }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- tombol tambah slot -->
            <div class="pt-6 ml-auto ">
                <button data-modal-target="tambah-slot" data-modal-toggle="tambah-slot"
                    class="rounded-md bg-base-200 hover:bg-[#95AFE5] p-2 px-2">
                    <div class="flex items-center space-x-0">
                        <i class="fas fa-plus me-2">
                        </i>
                        <p class="font-bold text-md">Tambah Slot</p>
                    </div>
                </button>
            </div>

            <!-- dropdown pilih subzona -->
            <!-- Periksa URL yang dihasilkan -->
            <!-- {{ route('slot.getBySubzona', ['subzonaId' => 'SUBZONA_ID']) }} -->


        </div>



        <!-- tabel slot -->
        <div class="grid w-9/12 grid-cols-1 px-5 mx-6">
            <table class="text-sm font-medium">
                <thead class="bg-[#95AFE5]">
                    <tr>
                        <th class="px-1 py-2 text-sm font-bold w-[10rem]">Nomor Slot</th>
                        <th class="px-1 py-2 text-sm font-bold w-[30rem]">Keterangan</th>
                        <th class="px-1 py-2 text-sm font-bold w-[15rem]">Aksi</th>
                    </tr>
                </thead>
                <tbody class=text-center>
                    @forelse($slots as $slot)
                        <tr
                            class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-3 py-2 font-medium text-gray-900 rounded-bl-lg whitespace-nowrap dark:text-white">
                                {{ $slot->nomor_slot }}
                            </th>
                            <td class="py-2 px-9">
                                {{ $slot->keterangan }}
                            </td>
                            <td class="px-1 py-2 rounded-br-lg">
                                <button data-modal-target="edit-slot-{{ $slot->id }}"
                                    data-modal-toggle="edit-slot-{{ $slot->id }}"
                                    class="inline-flex items-center justify-center py-1 text-sm text-blue-500 hover:underline">
                                    <i class="w-3 h-3 text-blue-500 me-2 fas fa-pen"></i>Edit
                                </button>
                                <button data-modal-target="hapus-slot-{{ $slot->id }}"
                                    data-modal-toggle="hapus-slot-{{ $slot->id }}"
                                    class="inline-flex items-center justify-center px-2 py-1 text-sm text-red-400 hover:underline">
                                    <i class="w-3 h-3 text-red-400 me-2 fas fa-trash"></i>Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center">Tidak ada slot</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <!-- Modal Tambah Slot -->
        <div id="tambah-slot" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full p-4">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal Header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-[#95AFE5]">
                        <h3 class="text-lg font-semibold text-white dark:text-white">
                            Tambah Slot Baru
                        </h3>
                        <button type="button"
                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-white bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="tambah-slot">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup modal</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form action="{{ route('slot.store') }}" method="POST" class="p-4 md:p-5">
                        @csrf
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <!-- Sub-Zona Dropdown -->
                            <div class="col-span-2">
                                <label for="subzona_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Sub-Zona <span class="text-red-500">*</span>
                                </label>
                                <select name="subzona_id" id="subzona_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('subzona_id') ? 'border-red-500' : '' }}">
                                    <option value="" selected disabled>Pilih Sub-Zona</option>
                                    @foreach ($subzonas as $subzona)
                                        <option value="{{ $subzona->id }}"
                                            {{ old('subzona_id') == $subzona->id ? 'selected' : '' }}>
                                            {{ $subzona->nama_subzona }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nomor Slot Input -->
                            <div class="col-span-2">
                                <label for="nomor_slot"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nomor Slot <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="nomor_slot" id="nomor_slot" value="{{ old('nomor_slot') }}"
                                    min="1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('nomor_slot') ? 'border-red-500' : '' }}"
                                    placeholder="Masukkan Nomor Slot" required>
                            </div>

                            <!-- Keterangan Dropdown -->
                            <div class="col-span-2">
                                <label for="keterangan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Keterangan <span class="text-red-500">*</span>
                                </label>
                                <select name="keterangan" id="keterangan" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('keterangan') ? 'border-red-500' : '' }}">
                                    <option value="" selected disabled>Pilih Keterangan</option>
                                    <option value="Tersedia" {{ old('keterangan') == 'Tersedia' ? 'selected' : '' }}>
                                        Tersedia</option>
                                    <option value="Terisi" {{ old('keterangan') == 'Terisi' ? 'selected' : '' }}>Terisi
                                    </option>
                                    <option value="Perbaikan" {{ old('keterangan') == 'Perbaikan' ? 'selected' : '' }}>
                                        Perbaikan</option>
                                </select>
                            </div>

                            <!-- Koordinat Inputs -->
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Koordinat <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-4 gap-2">
                                    <input type="number" name="x1" id="x1" value="{{ old('x1') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x1') ? 'border-red-500' : '' }}"
                                        placeholder="x1" required>
                                    <input type="number" name="y1" id="y1" value="{{ old('y1') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y1') ? 'border-red-500' : '' }}"
                                        placeholder="y1" required>
                                    <input type="number" name="x2" id="x2" value="{{ old('x2') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x2') ? 'border-red-500' : '' }}"
                                        placeholder="x2" required>
                                    <input type="number" name="y2" id="y2" value="{{ old('y2') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y2') ? 'border-red-500' : '' }}"
                                        placeholder="y2" required>
                                    <input type="number" name="x3" id="x3" value="{{ old('x3') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x3') ? 'border-red-500' : '' }}"
                                        placeholder="x3" required>
                                    <input type="number" name="y3" id="y3" value="{{ old('y3') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y3') ? 'border-red-500' : '' }}"
                                        placeholder="y3" required>
                                    <input type="number" name="x4" id="x4" value="{{ old('x4') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x4') ? 'border-red-500' : '' }}"
                                        placeholder="x4" required>
                                    <input type="number" name="y4" id="y4" value="{{ old('y4') }}"
                                        min="0" step="1"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y4') ? 'border-red-500' : '' }}"
                                        placeholder="y4" required>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Tambah Slot
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pop-Up Error Message -->
        <div id="validation-popup" class="fixed inset-x-0 z-50 flex justify-center hidden top-5">
            <div
                class="relative w-full max-w-sm p-6 bg-white border-l-4 border-red-500 rounded-lg shadow-lg shadow-red-500/80">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
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



        <!-- Modal Edit Slot -->
        @foreach ($slots as $slot)
            <div id="edit-slot-{{ $slot->id }}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full p-4">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div
                            class="flex items-center justify-between bg-[#95AFE5] p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-white dark:text-white">
                                Edit Slot
                            </h3>
                            <button type="button"
                                class="inline-flex items-center justify-center w-8 h-8 text-sm text-white bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="edit-slot-{{ $slot->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="{{ route('slot.update', $slot->id) }}" method="POST" class="p-4 md:p-5">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="subzona_id" value="{{ $selectedSubzona->id }}">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="col-span-2">
                                    <label for="nama_subzona"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Subzona</label>
                                    <input type="text" name="nama_subzona" id="nama_subzona"
                                        value="{{ $slot->subzona->nama_subzona }}"
                                        class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5"
                                        disabled>
                                </div>
                                <div class="col-span-2">
                                    <label for="nomor_slot"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                        Slot</label>
                                    <input type="text" name="nomor_slot" id="nomor_slot"
                                        value="{{ $slot->nomor_slot }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                <div class="col-span-2">
                                    <label for="keterangan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Keterangan <span class="text-red-500">*</span>
                                    </label>
                                    <select name="keterangan" id="keterangan" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="Perbaikan"
                                            {{ $slot->keterangan == 'Perbaikan' ? 'selected' : '' }}>
                                            Perbaikan</option>
                                        <option value="Tersedia" {{ $slot->keterangan == 'Tersedia' ? 'selected' : '' }}>
                                            Tersedia</option>
                                        <option value="Terisi" {{ $slot->keterangan == 'Terisi' ? 'selected' : '' }}>
                                            Terisi</option>
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Koordinat <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-4 gap-2">
                                        <input type="number" name="x1" id="x1"
                                            value="{{ old('x1', $slot->x1) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x1') ? 'border-red-500' : '' }}"
                                            placeholder="x1" required>
                                        <input type="number" name="y1" id="y1"
                                            value="{{ old('y1', $slot->y1) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y1') ? 'border-red-500' : '' }}"
                                            placeholder="y1" required>
                                        <input type="number" name="x2" id="x2"
                                            value="{{ old('x2', $slot->x2) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x2') ? 'border-red-500' : '' }}"
                                            placeholder="x2" required>
                                        <input type="number" name="y2" id="y2"
                                            value="{{ old('y2', $slot->y2) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y2') ? 'border-red-500' : '' }}"
                                            placeholder="y2" required>
                                        <input type="number" name="x3" id="x3"
                                            value="{{ old('x3', $slot->x3) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x3') ? 'border-red-500' : '' }}"
                                            placeholder="x3" required>
                                        <input type="number" name="y3" id="y3"
                                            value="{{ old('y3', $slot->y3) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y3') ? 'border-red-500' : '' }}"
                                            placeholder="y3" required>
                                        <input type="number" name="x4" id="x4"
                                            value="{{ old('x4', $slot->x4) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('x4') ? 'border-red-500' : '' }}"
                                            placeholder="x4" required>
                                        <input type="number" name="y4" id="y4"
                                            value="{{ old('y4', $slot->y4) }}" min="0" step="1"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('y4') ? 'border-red-500' : '' }}"
                                            placeholder="y4" required>
                                    </div>

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

        <!-- Modal Hapus Slot -->
        @foreach ($slots as $slot)
            <div id="hapus-slot-{{ $slot->id }}" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full p-4">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 text-center">
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                Apakah Anda yakin ingin menghapus slot "{{ $slot->nomor_slot }}" ini?
                            </h3>
                            <form action="{{ route('slot.destroy', $slot->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    Ya, Hapus
                                </button>
                            </form>
                            <button data-modal-hide="hapus-slot-{{ $slot->id }}" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
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
