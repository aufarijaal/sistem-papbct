<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- @laravelPWA --}}
        <title>{{ env('APP_NAME', 'Admin Dashboard') }}</title>
        <link rel="icon" href="{{ asset('icons/icon-72x72.png') }}" type='image/x-icon'>
        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800;900&display=swap" rel="stylesheet">
        <link
        rel="stylesheet"
        href="https://unpkg.com/tippy.js@6/themes/light.css"
        />
        <style type="text/tailwindcss">
            @layer base {
                html {
                    -webkit-tap-highlight-color: transparent;
                }
            }
        </style>
        {{-- @livewireStyles --}}

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <style>
            * {
                font-family: 'Inter', sans-serif;
            }
            body {
                display: flex;
                @if (Request::is('dashboard'))
                    height: 100vh;
                @elseif (Request::is('datapekerjadanowner'))
                    height: 100%;
                @endif
            }
            #app {
                height: 100%;
                width: 100%;
                background-color: #0f172a;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 304 304' width='304' height='304'%3E%3Cpath fill='%23334155' fill-opacity='0.4' d='M44.1 224a5 5 0 1 1 0 2H0v-2h44.1zm160 48a5 5 0 1 1 0 2H82v-2h122.1zm57.8-46a5 5 0 1 1 0-2H304v2h-42.1zm0 16a5 5 0 1 1 0-2H304v2h-42.1zm6.2-114a5 5 0 1 1 0 2h-86.2a5 5 0 1 1 0-2h86.2zm-256-48a5 5 0 1 1 0 2H0v-2h12.1zm185.8 34a5 5 0 1 1 0-2h86.2a5 5 0 1 1 0 2h-86.2zM258 12.1a5 5 0 1 1-2 0V0h2v12.1zm-64 208a5 5 0 1 1-2 0v-54.2a5 5 0 1 1 2 0v54.2zm48-198.2V80h62v2h-64V21.9a5 5 0 1 1 2 0zm16 16V64h46v2h-48V37.9a5 5 0 1 1 2 0zm-128 96V208h16v12.1a5 5 0 1 1-2 0V210h-16v-76.1a5 5 0 1 1 2 0zm-5.9-21.9a5 5 0 1 1 0 2H114v48H85.9a5 5 0 1 1 0-2H112v-48h12.1zm-6.2 130a5 5 0 1 1 0-2H176v-74.1a5 5 0 1 1 2 0V242h-60.1zm-16-64a5 5 0 1 1 0-2H114v48h10.1a5 5 0 1 1 0 2H112v-48h-10.1zM66 284.1a5 5 0 1 1-2 0V274H50v30h-2v-32h18v12.1zM236.1 176a5 5 0 1 1 0 2H226v94h48v32h-2v-30h-48v-98h12.1zm25.8-30a5 5 0 1 1 0-2H274v44.1a5 5 0 1 1-2 0V146h-10.1zm-64 96a5 5 0 1 1 0-2H208v-80h16v-14h-42.1a5 5 0 1 1 0-2H226v18h-16v80h-12.1zm86.2-210a5 5 0 1 1 0 2H272V0h2v32h10.1zM98 101.9V146H53.9a5 5 0 1 1 0-2H96v-42.1a5 5 0 1 1 2 0zM53.9 34a5 5 0 1 1 0-2H80V0h2v34H53.9zm60.1 3.9V66H82v64H69.9a5 5 0 1 1 0-2H80V64h32V37.9a5 5 0 1 1 2 0zM101.9 82a5 5 0 1 1 0-2H128V37.9a5 5 0 1 1 2 0V82h-28.1zm16-64a5 5 0 1 1 0-2H146v44.1a5 5 0 1 1-2 0V18h-26.1zm102.2 270a5 5 0 1 1 0 2H98v14h-2v-16h124.1zM242 149.9V160h16v34h-16v62h48v48h-2v-46h-48v-66h16v-30h-16v-12.1a5 5 0 1 1 2 0zM53.9 18a5 5 0 1 1 0-2H64V2H48V0h18v18H53.9zm112 32a5 5 0 1 1 0-2H192V0h50v2h-48v48h-28.1zm-48-48a5 5 0 0 1-9.8-2h2.07a3 3 0 1 0 5.66 0H178v34h-18V21.9a5 5 0 1 1 2 0V32h14V2h-58.1zm0 96a5 5 0 1 1 0-2H137l32-32h39V21.9a5 5 0 1 1 2 0V66h-40.17l-32 32H117.9zm28.1 90.1a5 5 0 1 1-2 0v-76.51L175.59 80H224V21.9a5 5 0 1 1 2 0V82h-49.59L146 112.41v75.69zm16 32a5 5 0 1 1-2 0v-99.51L184.59 96H300.1a5 5 0 0 1 3.9-3.9v2.07a3 3 0 0 0 0 5.66v2.07a5 5 0 0 1-3.9-3.9H185.41L162 121.41v98.69zm-144-64a5 5 0 1 1-2 0v-3.51l48-48V48h32V0h2v50H66v55.41l-48 48v2.69zM50 53.9v43.51l-48 48V208h26.1a5 5 0 1 1 0 2H0v-65.41l48-48V53.9a5 5 0 1 1 2 0zm-16 16V89.41l-34 34v-2.82l32-32V69.9a5 5 0 1 1 2 0zM12.1 32a5 5 0 1 1 0 2H9.41L0 43.41V40.6L8.59 32h3.51zm265.8 18a5 5 0 1 1 0-2h18.69l7.41-7.41v2.82L297.41 50H277.9zm-16 160a5 5 0 1 1 0-2H288v-71.41l16-16v2.82l-14 14V210h-28.1zm-208 32a5 5 0 1 1 0-2H64v-22.59L40.59 194H21.9a5 5 0 1 1 0-2H41.41L66 216.59V242H53.9zm150.2 14a5 5 0 1 1 0 2H96v-56.6L56.6 162H37.9a5 5 0 1 1 0-2h19.5L98 200.6V256h106.1zm-150.2 2a5 5 0 1 1 0-2H80v-46.59L48.59 178H21.9a5 5 0 1 1 0-2H49.41L82 208.59V258H53.9zM34 39.8v1.61L9.41 66H0v-2h8.59L32 40.59V0h2v39.8zM2 300.1a5 5 0 0 1 3.9 3.9H3.83A3 3 0 0 0 0 302.17V256h18v48h-2v-46H2v42.1zM34 241v63h-2v-62H0v-2h34v1zM17 18H0v-2h16V0h2v18h-1zm273-2h14v2h-16V0h2v16zm-32 273v15h-2v-14h-14v14h-2v-16h18v1zM0 92.1A5.02 5.02 0 0 1 6 97a5 5 0 0 1-6 4.9v-2.07a3 3 0 1 0 0-5.66V92.1zM80 272h2v32h-2v-32zm37.9 32h-2.07a3 3 0 0 0-5.66 0h-2.07a5 5 0 0 1 9.8 0zM5.9 0A5.02 5.02 0 0 1 0 5.9V3.83A3 3 0 0 0 3.83 0H5.9zm294.2 0h2.07A3 3 0 0 0 304 3.83V5.9a5 5 0 0 1-3.9-5.9zm3.9 300.1v2.07a3 3 0 0 0-1.83 1.83h-2.07a5 5 0 0 1 3.9-3.9zM97 100a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-48 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 96a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-144a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-96 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm96 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-32 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM49 36a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-32 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM33 68a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 240a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm80-176a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm112 176a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM17 180a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM17 84a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'%3E%3C/path%3E%3C/svg%3E");
                background-repeat: repeat;
            }
            </style>
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    </head>
    <body class="font-sans antialiased">
        <div class="modal fixed w-full h-full top-0 left-0 hidden items-center justify-center" id="modal-hubung">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-slate-700 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-lg font-bold text-white">Beri akses Owner</p>
                </div>

                <!--Body-->
                <form action="{{ route('bond') }}" method="POST" id="form-hubung">
                    @csrf
                    <div class="flex flex-col">
                        <label for="owner_username" class="mr-2 text-white">Username Owner</label>
                        <input id="owner_username-for-hubung" required name="owner_username" type="text" class="h-10 w-72 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan username owner">
                    </div>

                    <input required type="hidden" name="machineid" id="machineid-for-hubung">
                    <input required type="hidden" name="option" id="option-for-hubung">
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button onclick="updateBond('bind')" class="px-4 py-1 rounded-lg bg-indigo-200 text-indigo-600 mr-2">Beri akses</button>
                    <button onclick="document.getElementById('modal-hubung').classList.replace('flex', 'hidden')" class="px-4 py-1 rounded-lg text-indigo-200 mr-2">Tutup</button>
                </div>

                </div>
            </div>
        </div>

        <div class="modal fixed w-full h-full top-0 left-0 hidden items-center justify-center" id="modal-tambah">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-slate-700 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

              <!-- Add margin if you want to see some of the overlay behind the modal-->
              <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                  <p class="text-lg font-bold text-white">Tambah ID mesin baru</p>
                </div>

                <!--Body-->
                <form action="{{ route('addmachineid') }}" method="POST" id="form-tambah" class="flex flex-col gap-3">
                    @csrf
                    <div class="flex flex-col">
                        <label for="machineid" class="mr-2 text-white">ID Mesin</label>
                        <input required id="machineid" name="machineid" type="text" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan id mesin">
                    </div>
                    <div class="flex flex-col">
                        <label for="owner_username" class="mr-2 text-white">Username Owner</label>
                        <input id="owner_username" name="owner_username" type="text" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan username owner">
                    </div>
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                  <button onclick="document.getElementById('form-tambah').submit()" class="px-4 py-1 rounded-lg bg-indigo-200 text-indigo-600 mr-2">Tambahkan</button>
                  <button onclick="document.getElementById('modal-tambah').classList.replace('flex', 'hidden')" class="px-4 py-1 rounded-lg text-indigo-200 mr-2">Tutup</button>
                </div>

              </div>
            </div>
          </div>


          {{-- Modal Ubah username --}}
        <div class="modal fixed w-full h-full top-0 left-0 hidden items-center justify-center" id="modal-ubah-username">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-slate-700 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

              <!-- Add margin if you want to see some of the overlay behind the modal-->
              <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                  <p class="text-lg font-bold text-white">Ubah username</p>
                </div>

                <!--Body-->
                <form action="{{ route('ubahusername') }}" method="POST" id="form-ubah-username" class="flex flex-col gap-3">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <x-help-tooltip id="help-ubah-username" fill="#fff">
                            <label for="new_username" class="mr-2 text-white">Username</label>
                        </x-help-tooltip>
                        <input id="new_username" name="new_username" type="text" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan username baru">
                        <input type="hidden" name="old_username" id="old_username">
                        <input type="hidden" name="role" id="role">
                    </div>
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                  <button onclick="document.getElementById('form-ubah-username').submit()" class="px-4 py-1 rounded-lg bg-indigo-200 text-indigo-600 mr-2">Ubah</button>
                  <button onclick="document.getElementById('modal-ubah-username').classList.replace('flex', 'hidden')" class="px-4 py-1 rounded-lg text-indigo-200 mr-2">Tutup</button>
                </div>

              </div>
            </div>
          </div>
          {{-- Modal reset password --}}
        <div class="modal fixed w-full h-full top-0 left-0 hidden items-center justify-center" id="modal-reset-password">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-slate-700 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

              <!-- Add margin if you want to see some of the overlay behind the modal-->
              <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                  <p class="text-lg font-bold text-white">Reset Kata Sandi</p>
                </div>

                <!--Body-->
                <form action="{{ route('resetpasswordfromadmin') }}" method="POST" id="form-reset-password" class="flex flex-col gap-3">
                    @csrf
                    <div class="flex flex-col">
                        <label for="password" class="mr-2 text-white">Kata Sandi Baru</label>
                        <x-peek-password fill="#fff">
                            <input id="password" name="password" type="password" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan kata sandi baru">
                        </x-peek-password>
                        <input type="hidden" id="userid" name="userid">
                    </div>
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                  <button onclick="document.getElementById('form-reset-password').submit()" class="px-4 py-1 rounded-lg bg-indigo-200 text-indigo-600 mr-2">Ubah</button>
                  <button onclick="document.getElementById('modal-reset-password').classList.replace('flex', 'hidden')" class="px-4 py-1 rounded-lg text-indigo-200 mr-2">Tutup</button>
                </div>

              </div>
            </div>
        </div>

        {{-- Modal Tambah Owner --}}
        <div class="modal fixed w-full h-full top-0 left-0 hidden items-center justify-center" id="modal-tambah-owner">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-slate-700 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

              <!-- Add margin if you want to see some of the overlay behind the modal-->
              <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                  <p class="text-lg font-bold text-white">Tambah Akun Owner Baru</p>
                </div>

                <!--Body-->
                <form action="{{ route('tambahownerfromadmin') }}" method="POST" id="form-tambah-owner" class="flex flex-col gap-3">
                    @csrf
                    <div class="flex flex-col">
                        <label for="username_owner" class="mr-2 text-white">Username</label>
                        <input id="username_owner" name="username_owner" type="text" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan username">
                        <label for="password_owner" class="mr-2 text-white">Kata Sandi</label>
                        <x-peek-password fill="#fff">
                            <input id="password_owner" name="password_owner" type="password" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan kata sandi">
                        </x-peek-password>
                    </div>
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                  <button onclick="document.getElementById('form-tambah-owner').submit()" class="px-4 py-1 rounded-lg bg-indigo-200 text-indigo-600 mr-2">Tambah</button>
                  <button onclick="document.getElementById('modal-tambah-owner').classList.replace('flex', 'hidden')" class="px-4 py-1 rounded-lg text-indigo-200 mr-2">Tutup</button>
                </div>

              </div>
            </div>
        </div>
        {{-- Modal Tambah Pekerja --}}
        <div class="modal fixed w-full h-full top-0 left-0 hidden items-center justify-center" id="modal-tambah-pekerja">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-slate-700 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

              <!-- Add margin if you want to see some of the overlay behind the modal-->
              <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                  <p class="text-lg font-bold text-white">Tambah Akun Pekerja Baru</p>
                </div>

                <!--Body-->
                <form action="{{ route('tambahpekerjafromadmin') }}" method="POST" id="form-tambah-pekerja" class="flex flex-col gap-3">
                    @csrf
                    <div class="flex flex-col">
                        <label for="username_pekerja" class="mr-2 text-white">Username</label>
                        <input required id="username_pekerja" name="username_pekerja" type="text" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan username">
                        <label for="username_owner_for_pekerja" class="mr-2 text-white">Username Owner</label>
                        <input required id="username_owner_for_pekerja" name="username_owner_for_pekerja" type="text" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan username">
                        <label for="password_for_tambah_pekerja" class="mr-2 text-white">Kata Sandi</label>
                        <x-peek-password fill="#fff">
                            <input required id="password_for_tambah_pekerja" name="password_pekerja" type="password" class="h-10 pl-2 outline-none rounded-lg bg-slate-900 placeholder:text-slate-700 text-white" placeholder="Masukkan kata sandi">
                        </x-peek-password>
                    </div>
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                  <button onclick="document.getElementById('form-tambah-pekerja').submit()" class="px-4 py-1 rounded-lg bg-indigo-200 text-indigo-600 mr-2">Tambah</button>
                  <button onclick="document.getElementById('modal-tambah-pekerja').classList.replace('flex', 'hidden')" class="px-4 py-1 rounded-lg text-indigo-200 mr-2">Tutup</button>
                </div>

              </div>
            </div>
        </div>

        <div id="app">
            <div class="container mx-auto mt-10 mb-2">
                <div class="flex justify-center md:gap-4 lg:flex-row flex-col items-center gap-2">
                    @if (Request::is('dashboard'))
                        <a href="{{ route('datapekerjadanowner') }}" class="block text-blue-600 bg-blue-200 w-max p-1.5 px-3 rounded-lg lg:my-4 cursor-pointer">DATA PEKERJA DAN OWNER</a>
                    @elseif (Request::is('datapekerjadanowner'))
                        <a href="{{ route('dashboard') }}" class="block text-blue-600 bg-blue-200 w-max p-1.5 px-3 rounded-lg lg:my-4 cursor-pointer">DATA MESIN</a>
                    @endif
                    <a href="{{ route('logout') }}" class="block text-red-600 bg-red-200 w-max p-1.5 px-3 rounded-lg mb-4 lg:mb-0 cursor-pointer">LOGOUT</a>
                </div>
                <div class="flex justify-center">
                    <x-help-tooltip id="petunjuk">
                        <div class="text-white">Petunjuk</div>
                    </x-help-tooltip>
                </div>
                <div class="my-4">
                    <h1 class="text-white font-bold text-xl text-center">{{ Request::is('dashboard') ? 'MANAJEMEN DATA MESIN' : 'MANAJEMEN OWNER DAN PEKERJA' }}</h1>
                </div>
                @if (Request::is('dashboard'))
                    <div onclick="document.getElementById('modal-tambah').classList.replace('hidden', 'flex')" class="text-blue-600 bg-blue-200 w-max p-1.5 px-3 rounded-lg mx-auto my-4 cursor-pointer">TAMBAH</div>
                @elseif(Request::is('datapekerjadanowner'))
                <div class="flex justify-center gap-2">
                    <div onclick="document.getElementById('modal-tambah-owner').classList.replace('hidden', 'flex')" class="text-sm text-blue-600 bg-blue-200 w-max p-1.5 px-3 rounded-lg my-4 cursor-pointer">TAMBAH OWNER</div>
                    <div onclick="document.getElementById('modal-tambah-pekerja').classList.replace('hidden', 'flex')" class="text-sm text-blue-600 bg-blue-200 w-max p-1.5 px-3 rounded-lg my-4 cursor-pointer">TAMBAH PEKERJA</div>
                </div>
                @endif

                @if (Session::has('success'))
                    <div onclick="this.hidden = true" class="cursor-pointer text-sm text-center text-green-500 bg-green-100 p-3">{{ Session::get('success') }}</div>
                @elseif (Session::has('failed'))
                    <div onclick="this.hidden = true" class="cursor-pointer text-sm text-center text-red-500 bg-red-100 p-3">{{ Session::get('failed') }}</div>
                @endif

                <div class="mx-6 overflow-auto rounded-lg border-2 mt-4">
                    <table class="w-full">
                        <thead class="bg-slate-700 border-b-2 border-gray-200">
                            <tr>
                                <th class="p-3 text-sm font-semibold text-white tracking-wide text-center w-4">No</th>
                                @if (Request::is('dashboard'))
                                    <th class="w-36 p-3 text-sm font-semibold text-white tracking-wide text-center">ID Mesin</th>
                                    <th class="w-28 p-3 text-sm font-semibold text-white tracking-wide text-center">Owner Username</th>
                                    <th class="w-28 p-3 text-sm font-semibold text-white tracking-wide text-center">Aksi</th>
                                @elseif (Request::is('datapekerjadanowner'))
                                    <th class="w-36 p-3 text-sm font-semibold text-white tracking-wide text-center">Username</th>
                                    <th class="w-28 p-3 text-sm font-semibold text-white tracking-wide text-center">Role</th>
                                    <th class="w-28 p-3 text-sm font-semibold text-white tracking-wide text-center">Owner Username</th>
                                    <th class="w-28 p-3 text-sm font-semibold text-white tracking-wide text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (Request::is('dashboard'))
                                @foreach ($datatables as $datatable)
                                    <tr class="{{ $loop->last ? '' : 'border-b'}} border-gray-200 bg-slate-900">
                                        <td class="p-2 text-center text-sm text-white">{{ $loop->iteration }}</td>
                                        <td class="p-2 text-center text-sm text-white">{{ $datatable->machineid }}</td>
                                        <td class="p-2 text-center text-sm text-white">{!! $datatable->owner_username == null ? '<span class="italic text-white/40">kosong</span class="italic text-white/40">' : $datatable->owner_username !!}</td>
                                        <td class="p-2 text-center text-sm flex justify-center gap-4">
                                            @if ($datatable->owner_username == null)
                                                <a title="Beri akses ke owner" onclick="openModalHubung('{{ $datatable->machineid }}')" class="bg-green-200 text-green-600 p-1.5 rounded-lg cursor-pointer" style="font-weight: 550; font-variation-settings: 'wght' 550">
                                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="currentColor" d="M25.06 13.72c-.944-5.173-5.46-9.095-10.903-9.095v4a7.104 7.104 0 0 1 7.094 7.094a7.104 7.104 0 0 1-7.093 7.092v4.002c5.442-.004 9.96-3.926 10.903-9.096h4.69v-4h-4.69zm-4.685 2a6.216 6.216 0 0 0-12.103-2.002H1.438v4h6.834a6.216 6.216 0 0 0 12.104-2z"/></svg>
                                                </a>
                                                @else
                                                <a title="Hapus akses owner" onclick="updateBond('{{ $datatable->machineid }}', 'unbind', '{{ $datatable->owner_username }}')" class="bg-red-200 text-red-600 p-1.5 rounded-lg cursor-pointer" style="font-weight: 550; font-variation-settings: 'wght' 550">
                                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="currentColor" d="M9.22 9.5a6.219 6.219 0 0 0-5.885 4.218H1.438v4h1.897a6.216 6.216 0 0 0 12.102-2A6.217 6.217 0 0 0 9.218 9.5zm18.465 4.22c-.944-5.173-5.46-9.095-10.903-9.095v4a7.104 7.104 0 0 1 7.094 7.094a7.106 7.106 0 0 1-7.094 7.092v4.002c5.442-.004 9.96-3.926 10.903-9.096h2.065v-4h-2.065z"/></svg>
                                                </a>
                                            @endif
                                            <form action="{{ route('deletemachineid') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="machineid" value="{{ $datatable->machineid }}">
                                                <button title="Hapus" type="submit" class="bg-red-200 text-red-600 p-1.5 rounded-lg " style="font-weight: 550; font-variation-settings: 'wght' 550">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21.5 6a1 1 0 0 1-.883.993L20.5 7h-.845l-1.231 12.52A2.75 2.75 0 0 1 15.687 22H8.313a2.75 2.75 0 0 1-2.737-2.48L4.345 7H3.5a1 1 0 0 1 0-2h5a3.5 3.5 0 1 1 7 0h5a1 1 0 0 1 1 1Zm-7.25 3.25a.75.75 0 0 0-.743.648L13.5 10v7l.007.102a.75.75 0 0 0 1.486 0L15 17v-7l-.007-.102a.75.75 0 0 0-.743-.648Zm-4.5 0a.75.75 0 0 0-.743.648L9 10v7l.007.102a.75.75 0 0 0 1.486 0L10.5 17v-7l-.007-.102a.75.75 0 0 0-.743-.648ZM12 3.5A1.5 1.5 0 0 0 10.5 5h3A1.5 1.5 0 0 0 12 3.5Z"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif (Request::is('datapekerjadanowner'))
                                @foreach ($users as $user)
                                    <tr class="border-b border-gray-200 bg-slate-900">
                                        <td class="p-2 text-center text-sm text-white">{{ $loop->iteration }}</td>
                                        <td class="p-2 text-center text-sm text-white">{{ $user->username }}</td>
                                        <td class="p-2 text-center text-sm text-white">{{ $user->role }}</td>
                                        <td class="p-2 text-center text-sm text-white">{!! $user->owner_username == null ? '<span class="italic text-white/40">kosong</span class="italic text-white/40">' : $user->owner_username !!}</td>
                                        <td class="p-2 text-center text-sm flex gap-2 justify-center">
                                            {{-- <button type="submit" class="bg-yellow-200 text-yellow-600 p-1.5 rounded-lg " style="font-weight: 500;">
                                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M11 15c0-.35.06-.687.17-1H4.253a2.249 2.249 0 0 0-2.249 2.249v.92c0 .572.179 1.13.51 1.596C4.057 20.929 6.58 22 10 22c.397 0 .783-.014 1.156-.043A2.997 2.997 0 0 1 11 21v-6ZM10 2.005a5 5 0 1 1 0 10 5 5 0 0 1 0-10ZM12 15a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-6Zm2.5 1a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Z"/></svg>
                                            </button> --}}
                                            <button onclick="showModalResetPassword({{ $user->id }})" title="klik untuk reset kata sandi" type="submit" class="bg-blue-200 text-blue-600 p-1.5 rounded-lg" style="font-weight: 500;">
                                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7.207 2.543a1 1 0 0 1 0 1.414L5.414 5.75h7.836a8 8 0 1 1-8 8 1 1 0 1 1 2 0 6 6 0 1 0 6-6H5.414l1.793 1.793a1 1 0 0 1-1.414 1.414l-3.5-3.5a1 1 0 0 1 0-1.414l3.5-3.5a1 1 0 0 1 1.414 0Z"/></svg>
                                            </button>
                                            <button onclick="showModalUbahUsername('{{ $user->username }}', '{{ $user->role }}')" title="klik untuk merubah username" type="submit" class="bg-green-200 text-green-600 p-1.5 rounded-lg " style="font-weight: 500;">
                                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9.75 2h3.998a.75.75 0 0 1 .102 1.493l-.102.007H12.5v17h1.246a.75.75 0 0 1 .743.648l.007.102a.75.75 0 0 1-.648.743l-.102.007H9.75a.75.75 0 0 1-.102-1.493l.102-.007h1.249v-17H9.75a.75.75 0 0 1-.743-.648L9 2.75a.75.75 0 0 1 .648-.743L9.75 2Zm8.496 2.997a3.253 3.253 0 0 1 3.25 3.25l.004 7.504a3.249 3.249 0 0 1-3.064 3.246l-.186.005h-4.745V4.996h4.74Zm-8.249 0L9.992 19H5.25A3.25 3.25 0 0 1 2 15.751V8.247a3.25 3.25 0 0 1 3.25-3.25h4.747Z"/></svg>
                                            </button>
                                            <form title="klik untuk hapus" action="{{ route('deletepekerjadanowner') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button type="submit" class="bg-red-200 text-red-600 p-1.5 rounded-lg " style="font-weight: 500;">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21.5 6a1 1 0 0 1-.883.993L20.5 7h-.845l-1.231 12.52A2.75 2.75 0 0 1 15.687 22H8.313a2.75 2.75 0 0 1-2.737-2.48L4.345 7H3.5a1 1 0 0 1 0-2h5a3.5 3.5 0 1 1 7 0h5a1 1 0 0 1 1 1Zm-7.25 3.25a.75.75 0 0 0-.743.648L13.5 10v7l.007.102a.75.75 0 0 0 1.486 0L15 17v-7l-.007-.102a.75.75 0 0 0-.743-.648Zm-4.5 0a.75.75 0 0 0-.743.648L9 10v7l.007.102a.75.75 0 0 0 1.486 0L10.5 17v-7l-.007-.102a.75.75 0 0 0-.743-.648ZM12 3.5A1.5 1.5 0 0 0 10.5 5h3A1.5 1.5 0 0 0 12 3.5Z"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script>
        const showModalResetPassword = (id) => {
            document.getElementById('modal-reset-password').classList.replace('hidden', 'flex')

            document.getElementById('userid').value = id
            document.getElementById('password').value = ''
            document.getElementById('password').focus()
        }
        const showModalUbahUsername = (old_username, role) => {
            document.getElementById('modal-ubah-username').classList.replace('hidden', 'flex')


            document.getElementById('new_username').value = ''
            document.getElementById('new_username').focus()
            document.getElementById('role').value = role
            document.getElementById('old_username').value = old_username
        }
        const openModalHubung = (machineid) => {
            document.getElementById('modal-hubung').classList.replace('hidden', 'flex')

            document.getElementById('machineid-for-hubung').value = machineid
            document.getElementById('option-for-hubung').value = 'bind'
        }

        const updateBond = (machineid, option, owner_username = null) => {
            if(option == 'unbind') {
                document.getElementById('owner_username-for-hubung').value = owner_username
                document.getElementById('machineid-for-hubung').value = machineid
                document.getElementById('option-for-hubung').value = 'unbind'
            }
            document.getElementById('form-hubung').submit()
        }
        tippy('#help-ubah-username', {
                theme: 'light',
                content: `Mengubah username dari seorang owner akan mengubah nama owner pada data pekerja (jika ada) dan mengubah nama owner pada mesin (jika terhubung)`,
                trigger: 'mouseenter click',
                placement: 'bottom',
                allowHTML: true
        });
        @if (Request::is('dashboard'))
            tippy('#petunjuk', {
                theme: 'light',
                content: `<table>
            <tr>
                <td><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="rgb(22 163 74)" d="M25.06 13.72c-.944-5.173-5.46-9.095-10.903-9.095v4a7.104 7.104 0 0 1 7.094 7.094a7.104 7.104 0 0 1-7.093 7.092v4.002c5.442-.004 9.96-3.926 10.903-9.096h4.69v-4h-4.69zm-4.685 2a6.216 6.216 0 0 0-12.103-2.002H1.438v4h6.834a6.216 6.216 0 0 0 12.104-2z"/></svg></td>
                <td><p class="text-xs">Tombol Hubung, Klik untuk beri akses ke seorang owner</p></td>
            </tr>
            <tr>
                <td><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="rgb(220 38 38)" d="M9.22 9.5a6.219 6.219 0 0 0-5.885 4.218H1.438v4h1.897a6.216 6.216 0 0 0 12.102-2A6.217 6.217 0 0 0 9.218 9.5zm18.465 4.22c-.944-5.173-5.46-9.095-10.903-9.095v4a7.104 7.104 0 0 1 7.094 7.094a7.106 7.106 0 0 1-7.094 7.092v4.002c5.442-.004 9.96-3.926 10.903-9.096h2.065v-4h-2.065z"/></svg></td>
                <td><p class="text-xs">Tombol Lepas, Klik untuk hapus akses owner yg terhubung</p></td>
            </tr>
            <tr>
                <td><svg class="mr-2" width="20" height="20" fill="rgb(220 38 38)" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21.5 6a1 1 0 0 1-.883.993L20.5 7h-.845l-1.231 12.52A2.75 2.75 0 0 1 15.687 22H8.313a2.75 2.75 0 0 1-2.737-2.48L4.345 7H3.5a1 1 0 0 1 0-2h5a3.5 3.5 0 1 1 7 0h5a1 1 0 0 1 1 1Zm-7.25 3.25a.75.75 0 0 0-.743.648L13.5 10v7l.007.102a.75.75 0 0 0 1.486 0L15 17v-7l-.007-.102a.75.75 0 0 0-.743-.648Zm-4.5 0a.75.75 0 0 0-.743.648L9 10v7l.007.102a.75.75 0 0 0 1.486 0L10.5 17v-7l-.007-.102a.75.75 0 0 0-.743-.648ZM12 3.5A1.5 1.5 0 0 0 10.5 5h3A1.5 1.5 0 0 0 12 3.5Z"/></svg></td>
                <td><p class="text-xs">Tombol Hapus, Klik untuk hapus id mesin</p></td>
            </tr>
        </table>`,
                trigger: 'mouseenter click',
                placement: 'bottom',
                allowHTML: true
            });
        @elseif(Request::is('datapekerjadanowner'))
            tippy('#petunjuk', {
                    theme: 'light',
                    content: `<table>
                <!-- <tr>
                    <td><svg width="20" height="20" fill="rgb(202 138 4)" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M11 15c0-.35.06-.687.17-1H4.253a2.249 2.249 0 0 0-2.249 2.249v.92c0 .572.179 1.13.51 1.596C4.057 20.929 6.58 22 10 22c.397 0 .783-.014 1.156-.043A2.997 2.997 0 0 1 11 21v-6ZM10 2.005a5 5 0 1 1 0 10 5 5 0 0 1 0-10ZM12 15a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-6Zm2.5 1a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Z"/></svg></td>
                    <td><p class="text-xs">Klik untuk melihat daftar pekerja dari owner</p></td>
                </tr> -->
                <tr>
                    <td><svg width="20" height="20" fill="rgb(37 99 235)" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7.207 2.543a1 1 0 0 1 0 1.414L5.414 5.75h7.836a8 8 0 1 1-8 8 1 1 0 1 1 2 0 6 6 0 1 0 6-6H5.414l1.793 1.793a1 1 0 0 1-1.414 1.414l-3.5-3.5a1 1 0 0 1 0-1.414l3.5-3.5a1 1 0 0 1 1.414 0Z"/></svg></td>
                    <td><p class="text-xs">Klik untuk reset kata sandi</p></td>
                </tr>
                <tr>
                    <td><svg width="20" height="20" fill="rgb(22 163 74)" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9.75 2h3.998a.75.75 0 0 1 .102 1.493l-.102.007H12.5v17h1.246a.75.75 0 0 1 .743.648l.007.102a.75.75 0 0 1-.648.743l-.102.007H9.75a.75.75 0 0 1-.102-1.493l.102-.007h1.249v-17H9.75a.75.75 0 0 1-.743-.648L9 2.75a.75.75 0 0 1 .648-.743L9.75 2Zm8.496 2.997a3.253 3.253 0 0 1 3.25 3.25l.004 7.504a3.249 3.249 0 0 1-3.064 3.246l-.186.005h-4.745V4.996h4.74Zm-8.249 0L9.992 19H5.25A3.25 3.25 0 0 1 2 15.751V8.247a3.25 3.25 0 0 1 3.25-3.25h4.747Z"/></svg></td>
                    <td><p class="text-xs">Klik untuk mengubah username</p></td>
                </tr>
                <tr>
                    <td><svg class="mr-2" width="20" height="20" fill="rgb(220 38 38)" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21.5 6a1 1 0 0 1-.883.993L20.5 7h-.845l-1.231 12.52A2.75 2.75 0 0 1 15.687 22H8.313a2.75 2.75 0 0 1-2.737-2.48L4.345 7H3.5a1 1 0 0 1 0-2h5a3.5 3.5 0 1 1 7 0h5a1 1 0 0 1 1 1Zm-7.25 3.25a.75.75 0 0 0-.743.648L13.5 10v7l.007.102a.75.75 0 0 0 1.486 0L15 17v-7l-.007-.102a.75.75 0 0 0-.743-.648Zm-4.5 0a.75.75 0 0 0-.743.648L9 10v7l.007.102a.75.75 0 0 0 1.486 0L10.5 17v-7l-.007-.102a.75.75 0 0 0-.743-.648ZM12 3.5A1.5 1.5 0 0 0 10.5 5h3A1.5 1.5 0 0 0 12 3.5Z"/></svg></td>
                    <td><p class="text-xs">Tombol Hapus, Klik untuk hapus pekerja / owner</p></td>
                </tr>
            </table>`,
                    trigger: 'mouseenter click',
                    placement: 'bottom',
                    allowHTML: true
                });
        @endif
    </script>
    </body>
</html>
