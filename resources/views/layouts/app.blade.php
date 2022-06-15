<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- @laravelPWA --}}
        <title>{{ env('APP_NAME', 'Sistem Kontrol dan Monitoring Prototype Alat Pembuat Bubuk Cangkang Telur') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800;900&display=swap" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

        {{-- @livewireStyles --}}

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/chart.min.js') }}"></script>
        @stack('styles')
        <style>
            * {
                font-family: 'Inter', sans-serif;
            }
            body {
                display: flex;
                height: 100vh;
            }
            #app {
                height: 100%;
                width: 100%;
            }
            .dashboard {
                display: grid;
                height: 100%;
                width: 100%;
                grid-template-columns: 1fr;
                grid-template-rows: auto 66px;
            }
            #main-content {
                width: 100%;
                display: grid;
                grid-template-columns: 1fr;
                grid-template-rows: 65px auto;
            }
            aside {
                height: 66px;
            }
            .slide-out-top {
                -webkit-animation: slide-out-top 0.5s cubic-bezier(0.600, -0.280, 0.735, 0.045) both;
                animation: slide-out-top 0.5s cubic-bezier(0.600, -0.280, 0.735, 0.045) both;
            }
            @-webkit-keyframes slide-out-top {
                0% {
                    -webkit-transform: translateY(0);
                            transform: translateY(0);
                    -webkit-transform: translateX(-50%);
                    transform: translateX(-50%);
                    opacity: 1;
                }
                100% {
                    -webkit-transform: translateY(-1000px);
                            transform: translateY(-1000px);
                    opacity: 0;
                }
            }
            @keyframes slide-out-top {
                0% {
                    -webkit-transform: translateY(0);
                            transform: translateY(0);
                    -webkit-transform: translateX(-50%);
                            transform: translateX(-50%);
                    opacity: 1;
                }
                100% {
                    -webkit-transform: translateY(-1000px);
                            transform: translateY(-1000px);
                    opacity: 0;
                }
            }
            #form-tambah-produksi {
                display: flex;
                flex-direction: column;
            }
            /* sm */
            @media (min-width: 640px) {

            }
            /* md */
            @media (min-width: 768px) {

            }
            /* lg */
            @media (min-width: 1024px) {
            #form-tambah-produksi {
                display: block;
            }
            .dashboard {
                grid-template-columns: 80px auto;
                grid-template-rows: 1fr;
            }
            aside {
                order: -1;
            }
            }
            /* xl */
            @media (min-width: 1280px) {

            }
            /* 2xl */
            @media (min-width: 1536px) {

            }
        </style>
    </head>
    <body class="font-sans antialiased">

        {{-- Custom Alert --}}
        <div id="alert" class="cursor-pointer bg-red-100 border-red-200 text-red-500 border-2 box-content shadow-lg w-52 h-auto hidden justify-center items-center p-2 fixed top-5 left-1/2 -translate-x-1/2 z-50">
            <span class="text-xs font-semibold" id="message"></span>
        </div>

        {{-- Custom modal menu --}}
        <div class="w-screen h-screen bg-black/80 fixed overflow-x-hidden overflow-y-hidden hidden justify-center items-center" style="z-index: 999999" id="menu-modal">
            <div class="w-64 h-36 bg-white absolute rounded-lg flex flex-col justify-center items-center gap-1 px-2" style="z-index: 10000000">
                <div id="close-modal" class="w-full flex justify-end" onclick="toggleModalMenu()">
                    <svg width="24" height="24" class="fill-zinc-700 cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m4.21 4.387.083-.094a1 1 0 0 1 1.32-.083l.094.083L12 10.585l6.293-6.292a1 1 0 1 1 1.414 1.414L13.415 12l6.292 6.293a1 1 0 0 1 .083 1.32l-.083.094a1 1 0 0 1-1.32.083l-.094-.083L12 13.415l-6.293 6.292a1 1 0 0 1-1.414-1.414L10.585 12 4.293 5.707a1 1 0 0 1-.083-1.32l.083-.094-.083.094Z"/></svg>
                </div>
                <a href="{{ route('settings') }}" class="font-bold w-full text-center py-2 rounded-lg bg-sky-100 text-sky-600">Pengaturan</a>
                <div class="font-bold w-full text-center py-2 rounded-lg bg-sky-100 text-sky-600 cursor-pointer" onclick="document.getElementById('lgt').submit()">
                    <form action="{{ route('logout') }}" method="GET" class="w-full h-full" id="lgt" x-data>
                        @csrf
                        <a class="flex justify-center items-center w-full h-full group" id="form-logout-mobile">
                            Logout
                        </a>
                    </form>
                </div>
                <div id="close-modal" class="w-full flex justify-end">
                    <svg width="24" height="24" class=" fill-transparent" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m4.21 4.387.083-.094a1 1 0 0 1 1.32-.083l.094.083L12 10.585l6.293-6.292a1 1 0 1 1 1.414 1.414L13.415 12l6.292 6.293a1 1 0 0 1 .083 1.32l-.083.094a1 1 0 0 1-1.32.083l-.094-.083L12 13.415l-6.293 6.292a1 1 0 0 1-1.414-1.414L10.585 12 4.293 5.707a1 1 0 0 1-.083-1.32l.083-.094-.083.094Z"/></svg>
                </div>
            </div>
        </div>
        {{-- Modal untuk reset password pekerja --}}
        <div class="w-screen h-screen bg-black/80 fixed overflow-x-hidden overflow-y-hidden hidden justify-center items-center" style="z-index: 999999" id="reset-password-pekerja-modal">
            <div class="w-80 h-44 bg-white absolute rounded-lg flex flex-col justify-center items-center gap-1 px-2" style="z-index: 10000000">
                <div id="close-modal" class="w-full flex justify-end" onclick="toggleModalResetPasswordPekerja()">
                    <svg width="24" height="24" class="fill-zinc-700 cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m4.21 4.387.083-.094a1 1 0 0 1 1.32-.083l.094.083L12 10.585l6.293-6.292a1 1 0 1 1 1.414 1.414L13.415 12l6.292 6.293a1 1 0 0 1 .083 1.32l-.083.094a1 1 0 0 1-1.32.083l-.094-.083L12 13.415l-6.293 6.292a1 1 0 0 1-1.414-1.414L10.585 12 4.293 5.707a1 1 0 0 1-.083-1.32l.083-.094-.083.094Z"/></svg>
                </div>
                <div class="w-full">
                    <form action="{{ route('resetpasswordpekerja') }}" method="POST" class="w-full h-full flex items-center flex-col gap-1" id="form-reset-password-pekerja">
                        @csrf
                        <input type="hidden" name="pekerja_id" id="pekerja_id">
                        <div class="flex flex-col gap-2">
                            <input id="pekerja_password" class="h-10 w-72 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="pekerja_password" required placeholder="sandi pekerja">
                        </div>
                        <button type="submit" class="active:bg-sky-300 active:text-sky-600 bg-sky-200 text-sky-500 font-bold w-36 h-10 rounded-lg">Simpan Sandi</button>
                    </form>
                </div>
                <div id="close-modal" class="w-full flex justify-end">
                    <svg width="24" height="24" class=" fill-transparent" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m4.21 4.387.083-.094a1 1 0 0 1 1.32-.083l.094.083L12 10.585l6.293-6.292a1 1 0 1 1 1.414 1.414L13.415 12l6.292 6.293a1 1 0 0 1 .083 1.32l-.083.094a1 1 0 0 1-1.32.083l-.094-.083L12 13.415l-6.293 6.292a1 1 0 0 1-1.414-1.414L10.585 12 4.293 5.707a1 1 0 0 1-.083-1.32l.083-.094-.083.094Z"/></svg>
                </div>
            </div>
        </div>

        <div id="app">
            <div class="dashboard">
                <main>
                  <div class="w-full h-full">
                    <!-- bg-slate-800 sm:bg-red-500 md:bg-orange-400 lg:bg-green-400 xl:bg-blue-900 -->
                      <div id="main-content" class="text-2xl flex items-center text-center text-zinc-900 tracking-wide lg:text-left lg:pl-10">
                        @stack('top')
                      </div>
                      <div class="h-full lg:h-auto">
                          @yield('slot')
                      </div>
                  </div>
                </main>
                <aside class="bg-zinc-900 lg:static fixed bottom-0 lg:bottom-auto w-full lg:h-auto">
                  <ul class="flex flex-row justify-between items-center h-full w-full lg:flex-col">
                    <li class="w-full h-full hidden lg:flex justify-center items-center">
                      <img class="scale-75" src="{{ asset('icons/icon-72x72.png') }}">
                    </li>
                    <li class="w-full h-full cursor-pointer" title="Dashboard">
                      <a href="{{ route('dashboard') }}" class="flex justify-center items-center w-full h-full group">
                          <div class="icon p-2 rounded-md hover:bg-white/10 {{ Request::is('dashboard') ? 'bg-white/10' : '' }}">
                            @if (!Request::is('dashboard'))
                                <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M10.55 2.532a2.25 2.25 0 0 1 2.9 0l6.75 5.692c.507.428.8 1.057.8 1.72v9.803a1.75 1.75 0 0 1-1.75 1.75h-3.5a1.75 1.75 0 0 1-1.75-1.75v-5.5a.25.25 0 0 0-.25-.25h-3.5a.25.25 0 0 0-.25.25v5.5a1.75 1.75 0 0 1-1.75 1.75h-3.5A1.75 1.75 0 0 1 3 19.747V9.944c0-.663.293-1.292.8-1.72l6.75-5.692Zm1.933 1.147a.75.75 0 0 0-.966 0L4.767 9.37a.75.75 0 0 0-.267.573v9.803c0 .138.112.25.25.25h3.5a.25.25 0 0 0 .25-.25v-5.5c0-.967.784-1.75 1.75-1.75h3.5c.966 0 1.75.783 1.75 1.75v5.5c0 .138.112.25.25.25h3.5a.25.25 0 0 0 .25-.25V9.944a.75.75 0 0 0-.267-.573l-6.75-5.692Z" fill="#fff"/></svg>
                            @else
                                <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M10.55 2.533a2.25 2.25 0 0 1 2.9 0l6.75 5.695c.508.427.8 1.056.8 1.72v9.802a1.75 1.75 0 0 1-1.75 1.75h-3a1.75 1.75 0 0 1-1.75-1.75v-5a.75.75 0 0 0-.75-.75h-3.5a.75.75 0 0 0-.75.75v5a1.75 1.75 0 0 1-1.75 1.75h-3A1.75 1.75 0 0 1 3 19.75V9.947c0-.663.292-1.292.8-1.72l6.75-5.694Z" fill="#fff"/></svg>
                            @endif
                          </div>
                      </a>
                    </li>
                    @if (auth()->user()->role == 'owner')
                        <li class="w-full h-full cursor-pointer" title="Statistik">
                        <a href="{{ route('stats') }}" class="flex justify-center items-center w-full h-full group">
                        <div class="icon p-2 rounded-md hover:bg-white/10 {{ Request::is('stats') ? 'bg-white/10' : '' }}">
                            @if (!Request::is('stats'))
                                <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M18.25 2.997A2.75 2.75 0 0 1 21 5.747v12.5a2.75 2.75 0 0 1-2.75 2.75H5.75A2.75 2.75 0 0 1 3 18.247v-12.5a2.75 2.75 0 0 1 2.75-2.75h12.5Zm0 1.5H5.75c-.69 0-1.25.56-1.25 1.25v12.5c0 .69.56 1.25 1.25 1.25h12.5c.69 0 1.25-.56 1.25-1.25v-12.5c0-.69-.56-1.25-1.25-1.25ZM7.75 9c.38 0 .693.281.743.646l.007.101v6.507a.748.748 0 0 1-.75.746.75.75 0 0 1-.743-.645L7 16.254V9.747C7 9.335 7.336 9 7.75 9Zm8.5-2c.38 0 .694.275.743.63l.007.1v8.541a.74.74 0 0 1-.75.73.744.744 0 0 1-.743-.631l-.007-.099V7.73a.74.74 0 0 1 .75-.73Zm-4.275 4.997a.73.73 0 0 1 .732.62l.008.1.035 3.547a.73.73 0 0 1-.725.733.73.73 0 0 1-.732-.62l-.008-.1-.035-3.546a.73.73 0 0 1 .725-.734Z" fill="#fff"/></svg>
                            @else
                                <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M18.25 2.997A2.75 2.75 0 0 1 21 5.747v12.5a2.75 2.75 0 0 1-2.75 2.75H5.75A2.75 2.75 0 0 1 3 18.247v-12.5a2.75 2.75 0 0 1 2.75-2.75h12.5ZM7.75 9a.748.748 0 0 0-.75.747v6.507c0 .412.336.746.75.746s.75-.334.75-.746V9.747A.748.748 0 0 0 7.75 9Zm8.5-2a.74.74 0 0 0-.75.73v8.541c0 .403.336.73.75.73a.74.74 0 0 0 .75-.73V7.73a.74.74 0 0 0-.75-.73Zm-4.275 4.997a.73.73 0 0 0-.725.734l.035 3.547a.73.73 0 0 0 .74.72.73.73 0 0 0 .725-.734l-.035-3.548a.73.73 0 0 0-.74-.719Z" fill="#fff"/></svg>
                            @endif
                        </div>
                        </a>
                        </li>
                    @endif
                    <li class="w-full h-full cursor-pointer hidden lg:block" title="Pengaturan">
                      <a href="{{ route('settings') }}" class="flex justify-center items-center w-full h-full group">
                      <div class="icon p-2 rounded-md hover:bg-white/10 {{ Request::is('settings') ? 'bg-white/10' : '' }}">
                        @if (!Request::is('settings'))
                            <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M12.012 2.25c.734.008 1.465.093 2.182.253a.75.75 0 0 1 .582.649l.17 1.527a1.384 1.384 0 0 0 1.927 1.116l1.401-.615a.75.75 0 0 1 .85.174 9.792 9.792 0 0 1 2.204 3.792.75.75 0 0 1-.271.825l-1.242.916a1.381 1.381 0 0 0 0 2.226l1.243.915a.75.75 0 0 1 .272.826 9.797 9.797 0 0 1-2.204 3.792.75.75 0 0 1-.848.175l-1.407-.617a1.38 1.38 0 0 0-1.926 1.114l-.169 1.526a.75.75 0 0 1-.572.647 9.518 9.518 0 0 1-4.406 0 .75.75 0 0 1-.572-.647l-.168-1.524a1.382 1.382 0 0 0-1.926-1.11l-1.406.616a.75.75 0 0 1-.849-.175 9.798 9.798 0 0 1-2.204-3.796.75.75 0 0 1 .272-.826l1.243-.916a1.38 1.38 0 0 0 0-2.226l-1.243-.914a.75.75 0 0 1-.271-.826 9.793 9.793 0 0 1 2.204-3.792.75.75 0 0 1 .85-.174l1.4.615a1.387 1.387 0 0 0 1.93-1.118l.17-1.526a.75.75 0 0 1 .583-.65c.717-.159 1.45-.243 2.201-.252Zm0 1.5a9.135 9.135 0 0 0-1.354.117l-.109.977A2.886 2.886 0 0 1 6.525 7.17l-.898-.394a8.293 8.293 0 0 0-1.348 2.317l.798.587a2.881 2.881 0 0 1 0 4.643l-.799.588c.32.842.776 1.626 1.348 2.322l.905-.397a2.882 2.882 0 0 1 4.017 2.318l.11.984c.889.15 1.798.15 2.687 0l.11-.984a2.881 2.881 0 0 1 4.018-2.322l.905.396a8.296 8.296 0 0 0 1.347-2.318l-.798-.588a2.881 2.881 0 0 1 0-4.643l.796-.587a8.293 8.293 0 0 0-1.348-2.317l-.896.393a2.884 2.884 0 0 1-4.023-2.324l-.11-.976a8.988 8.988 0 0 0-1.333-.117ZM12 8.25a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5Zm0 1.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" fill="#fff"/></svg>
                        @else
                            <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M12.012 2.25c.734.008 1.465.093 2.182.253a.75.75 0 0 1 .582.649l.17 1.527a1.384 1.384 0 0 0 1.927 1.116l1.401-.615a.75.75 0 0 1 .85.174 9.792 9.792 0 0 1 2.204 3.792.75.75 0 0 1-.271.825l-1.242.916a1.381 1.381 0 0 0 0 2.226l1.243.915a.75.75 0 0 1 .272.826 9.797 9.797 0 0 1-2.204 3.792.75.75 0 0 1-.848.175l-1.407-.617a1.38 1.38 0 0 0-1.926 1.114l-.169 1.526a.75.75 0 0 1-.572.647 9.518 9.518 0 0 1-4.406 0 .75.75 0 0 1-.572-.647l-.168-1.524a1.382 1.382 0 0 0-1.926-1.11l-1.406.616a.75.75 0 0 1-.849-.175 9.798 9.798 0 0 1-2.204-3.796.75.75 0 0 1 .272-.826l1.243-.916a1.38 1.38 0 0 0 0-2.226l-1.243-.914a.75.75 0 0 1-.271-.826 9.793 9.793 0 0 1 2.204-3.792.75.75 0 0 1 .85-.174l1.4.615a1.387 1.387 0 0 0 1.93-1.118l.17-1.526a.75.75 0 0 1 .583-.65c.717-.159 1.45-.243 2.201-.252ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" fill="#fff"/></svg>
                        @endif
                      </div>
                      </a>
                    </li>
                    <li class="w-full h-full cursor-pointer block lg:hidden" onclick="toggleModalMenu()">
                      <div class="flex justify-center items-center w-full h-full group">
                      <div class="icon p-2 rounded-md hover:bg-white/10 {{ Request::is('settings') ? 'bg-white/10' : '' }}">
                        @if (!Request::is('settings'))
                            <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M17.754 14a2.249 2.249 0 0 1 2.25 2.249v.575c0 .894-.32 1.76-.902 2.438-1.57 1.834-3.957 2.739-7.102 2.739-3.146 0-5.532-.905-7.098-2.74a3.75 3.75 0 0 1-.898-2.435v-.577a2.249 2.249 0 0 1 2.249-2.25h11.501Zm0 1.5H6.253a.749.749 0 0 0-.75.749v.577c0 .536.192 1.054.54 1.461 1.253 1.468 3.219 2.214 5.957 2.214s4.706-.746 5.962-2.214a2.25 2.25 0 0 0 .541-1.463v-.575a.749.749 0 0 0-.749-.75ZM12 2.004a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Z" fill="#ffffff"/></svg>
                        @else
                            <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M17.754 14a2.249 2.249 0 0 1 2.25 2.249v.918a2.75 2.75 0 0 1-.513 1.599C17.945 20.929 15.42 22 12 22c-3.422 0-5.945-1.072-7.487-3.237a2.75 2.75 0 0 1-.51-1.595v-.92a2.249 2.249 0 0 1 2.249-2.25h11.501ZM12 2.004a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z" fill="#ffffff"/></svg>
                        @endif
                      </div>
                      </div>
                    </li>
                    <li class="w-full h-full hidden lg:block cursor-pointer" title="logout">
                        <form action="{{ route('logout') }}" method="POST" class="w-full h-full" x-data id="lgt">
                            @csrf
                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();" class="flex justify-center items-center w-full h-full group" id="form-logout">
                              <div class="transition group icon p-2 hover:bg-white/10 rounded-md">
                                  <svg width="36" height="36" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="transition"><path d="M8.502 11.5a1.002 1.002 0 1 1 0 2.004 1.002 1.002 0 0 1 0-2.004Z" fill="#fff"/><path d="M12 4.354v6.651l7.442-.001L17.72 9.28a.75.75 0 0 1-.073-.976l.073-.084a.75.75 0 0 1 .976-.073l.084.073 2.997 2.997a.75.75 0 0 1 .073.976l-.073.084-2.996 3.004a.75.75 0 0 1-1.134-.975l.072-.085 1.713-1.717-7.431.001L12 19.25a.75.75 0 0 1-.88.739l-8.5-1.502A.75.75 0 0 1 2 17.75V5.75a.75.75 0 0 1 .628-.74l8.5-1.396a.75.75 0 0 1 .872.74Zm-1.5.883-7 1.15V17.12l7 1.236V5.237Z" fill="#fff"/><path d="M13 18.501h.765l.102-.006a.75.75 0 0 0 .648-.745l-.007-4.25H13v5.001ZM13.002 10 13 8.725V5h.745a.75.75 0 0 1 .743.647l.007.102.007 4.251h-1.5Z" fill="#fff"/></svg>
                              </div>
                            </a>
                        </form>
                    </li>
                  </ul>
                </aside>
              </div>
        </div>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            if(window.location.pathname == '/dashboard' || window.location.pathname == '/stats' || window.location.pathname == '/settings') {
                const machineid = document.getElementById('machine-id-value')
                localStorage.setItem('machineid', machineid.innerText != 'belum terhubung' ? machineid.innerText : 'belum terhubung')
                localStorage.setItem('loggedin', 'true')
                if(machineid.innerText != 'belum terhubung') {
                    for (let i = 0; i < 3; i++) {
                        let url = `${window.location.origin}/api/get-prod?filter=${i == 0 ? 'hari' : i == 1 ? 'pekan' : 'bulan'}&machineid=${id.innerText}`
                        let response = await fetch(url)
                        let data = await response.json()

                        const result =  {
                            length: data.length,
                            title: i == 0 ? 'Produksi hari ini' : i == 1 ? 'Produksi selama 7 hari' : 'Produksi selama 30 hari',
                            data: data.map((e) => e.weight),
                            labels: data.map((e) => {return i == 0 ? e.created_at.split(' ')[1].substring(0, 5) : e.created_at.split(' ')[0].substring(5).replace('-', '/')})
                        }
                        localStorage.setItem(i == 0 ? 'cache_hari' : i == 1 ? 'cache_pekan' : 'cache_bulan', JSON.stringify(result))
                        console.log((i == 0 ? 'cache_hari saved ' : i == 1 ? 'cache_pekan saved ' : 'cache_bulan saved ').concat(new Date().toLocaleDateString('id-ID', {
                            day: "2-digit",
                            month: "2-digit",
                            year: "numeric",
                            hour: "2-digit",
                            minute: "2-digit",
                            second: "2-digit",
                            hour12: false
                        })))
                    }
                }
            }
        })
        const toggleModalMenu = () => {
            if(document.getElementById('menu-modal').classList.contains('hidden')) {
                document.getElementById('menu-modal').classList.remove('hidden')
                document.getElementById('menu-modal').classList.add('flex')
            } else if(document.getElementById('menu-modal').classList.contains('flex')) {
                document.getElementById('menu-modal').classList.remove('flex')
                document.getElementById('menu-modal').classList.add('hidden')
            }
        }
        const toggleModalResetPasswordPekerja = (pekerja_id) => {
            if(document.getElementById('reset-password-pekerja-modal').classList.contains('hidden')) {
                document.getElementById('pekerja_id').value = pekerja_id
                document.getElementById('reset-password-pekerja-modal').classList.remove('hidden')
                document.getElementById('reset-password-pekerja-modal').classList.add('flex')
            } else if(document.getElementById('reset-password-pekerja-modal').classList.contains('flex')) {
                document.getElementById('reset-password-pekerja-modal').classList.remove('flex')
                document.getElementById('reset-password-pekerja-modal').classList.add('hidden')
            }
        }
        const emitLogout = () => {
            document.getElementById('form-logout').dispatchEvent(new Event('click'))
        }
        const emitError = () => {
            const alert = document.getElementById('alert')
                    alert.firstElementChild.innerText = 'Anda belum menghubungkan id mesin'
                    alert.classList.replace('hidden', 'flex')

                    setTimeout(() => {
                        alert.classList.add('slide-out-top')
                    }, 3000);
                    setTimeout(() => {
                        alert.classList.remove('slide-out-top')
                        alert.classList.replace('flex', 'hidden')
            }, 4000);
        }
    </script>
    </body>
</html>
