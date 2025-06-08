            <!-- Tombol untuk Menampilkan Modal -->
            <button id="tampilkan" onclick="showSubzoneModal()" class="w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium rounded-xl shadow-md transition duration-300 ease-in-out transform hover:scale-[1.02] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Tampilkan Sub Zona
            </button>

            <!-- Modal Subzona -->
            <div id="subZoneModal" class="fixed inset-0 z-50 hidden overflow-hidden">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
                <div class="fixed inset-0 flex items-center justify-center p-4">
                    <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white rounded-lg shadow-xl">
                        <!-- Tombol Close -->
                        <button id="closeModalBtn" class="absolute z-50 p-2 text-white rounded-full top-6 right-6 hover:text-gray-300 bg-black/40 backdrop-blur-md">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="p-6">
                            <h3 class="mb-4 text-2xl font-bold" id="subzoneName">Sub Zona: Memuat...</h3>

                            <!-- Video Stream Subzona -->
                            <div class="mb-6 overflow-hidden rounded-lg shadow-md">
                                <img id="subzoneStream" class="object-contain w-full max-h-[70vh] rounded-lg shadow-md cursor-zoom-in" src="" alt="Stream Kamera Subzona">
                            </div>

                            <!-- Denah Slot -->
                            <div>
                                <h4 class="mb-3 text-lg font-semibold">Denah Slot</h4>
                                <div class="grid grid-cols-10 gap-2" id="slotGrid"></div>

                                <!-- Legenda Slot -->
                                <div class="flex flex-wrap gap-4 mt-4">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 mr-2 bg-blue-500 rounded"></div><span class="text-sm">Tersedia</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 mr-2 bg-red-500 rounded"></div><span class="text-sm">Terisi</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 mr-2 bg-yellow-300 rounded"></div><span class="text-sm">Perbaikan</span>
                                    </div>
                                </div>

                                <!-- Statistik Slot -->
                                <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-4" id="slotStats">
                                    <div class="p-3 rounded-lg bg-blue-50">
                                        <h5 class="font-medium text-blue-800">Tersedia</h5>
                                        <p class="text-2xl font-bold text-blue-600" id="tersediaCount">0</p>
                                    </div>
                                    <div class="p-3 rounded-lg bg-red-50">
                                        <h5 class="font-medium text-red-800">Terisi</h5>
                                        <p class="text-2xl font-bold text-red-600" id="terisiCount">0</p>
                                    </div>
                                    <div class="p-3 rounded-lg bg-yellow-50">
                                        <h5 class="font-medium text-yellow-500">Perbaikan</h5>
                                        <p class="text-2xl font-bold text-yellow-300" id="diperbaikiCount">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
