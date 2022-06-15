@extends('layouts.app')
@section('slot')
    @push('top')
        <h1 style="font-weight: 800;">{{ __('Kontrol') }}</h1>
        <p class="text-xs hidden">ID mesin : <span id="machine-id-value">{{ isset($machineid) ? $machineid : 'belum terhubung' }}</span></p>
    @endpush
    <div class="lg:h-full flex justify-center lg:flex-row flex-col items-center gap-7 mb-5 lg:mb-0 lg:translate-y-28">
        <div class="flex flex-col items-center justify-center w-max h-max mt-4 lg:mt-0 px-10 py-14 bg-emerald-100 rounded-2xl transition-transform active:scale-90 cursor-pointer" onclick="toggleState()">
            <span id="on-off-indicator-text" class=" text-zinc-900 tracking-wide text-lg -translate-y-7" style="font-weight: 800;">{{ __('Mesin Utama') }}</span>
            <div id="on-off-indicator" class="bg-emerald-300 rounded-full w-max h-max p-10 border-4 border-dashed border-emerald-700">
                <svg class="fill-emerald-700" width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g><rect fill="none" height="24" width="24"/></g><g><path d="M10,15l5.88,0c0.27-0.31,0.67-0.5,1.12-0.5c0.83,0,1.5,0.67,1.5,1.5c0,0.83-0.67,1.5-1.5,1.5c-0.44,0-0.84-0.19-1.12-0.5 l-3.98,0c-0.46,2.28-2.48,4-4.9,4c-2.76,0-5-2.24-5-5c0-2.42,1.72-4.44,4-4.9l0,2.07C4.84,13.58,4,14.7,4,16c0,1.65,1.35,3,3,3 s3-1.35,3-3V15z M12.5,4c1.65,0,3,1.35,3,3h2c0-2.76-2.24-5-5-5l0,0c-2.76,0-5,2.24-5,5c0,1.43,0.6,2.71,1.55,3.62l-2.35,3.9 C6.02,14.66,5.5,15.27,5.5,16c0,0.83,0.67,1.5,1.5,1.5s1.5-0.67,1.5-1.5c0-0.16-0.02-0.31-0.07-0.45l3.38-5.63 C10.49,9.61,9.5,8.42,9.5,7C9.5,5.35,10.85,4,12.5,4z M17,13c-0.64,0-1.23,0.2-1.72,0.54l-3.05-5.07C11.53,8.35,11,7.74,11,7 c0-0.83,0.67-1.5,1.5-1.5S14,6.17,14,7c0,0.15-0.02,0.29-0.06,0.43l2.19,3.65C16.41,11.03,16.7,11,17,11l0,0c2.76,0,5,2.24,5,5 c0,2.76-2.24,5-5,5c-1.85,0-3.47-1.01-4.33-2.5l2.67,0C15.82,18.82,16.39,19,17,19c1.65,0,3-1.35,3-3S18.65,13,17,13z"/></g>
                </svg>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center w-max h-max mt-4 lg:mt-0 px-10 py-14 bg-indigo-100 rounded-2xl transition-transform active:scale-90 cursor-pointer" onclick="toggleStateAyakan()">
            <span id="ayakan-on-off-indicator-text" class=" text-zinc-900 tracking-wide text-lg -translate-y-7" style="font-weight: 800;">{{ __('Ayakan') }}</span>
            <div id="ayakan-on-off-indicator" class="bg-indigo-300 rounded-full w-max h-max p-10 border-4 border-dashed border-indigo-700">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="56" viewBox="0 0 24 24" width="56" fill="none" class="fill-indigo-700"><g><path d="M0,0h24 M24,24H0" fill="none"/><path d="M7,6h10l-5.01,6.3L7,6z M4.25,5.61C6.27,8.2,10,13,10,13v6c0,0.55,0.45,1,1,1h2c0.55,0,1-0.45,1-1v-6 c0,0,3.72-4.8,5.74-7.39C20.25,4.95,19.78,4,18.95,4H5.04C4.21,4,3.74,4.95,4.25,5.61z"/><path d="M0,0h24v24H0V0z" fill="none"/></g></svg>
            </div>
        </div>
        <div class="flex flex-col gap-7">
            <div class="transition-transform active:scale-90 card flex flex-col w-56 h-32 rounded-xl text-center gap-6 pt-4 bg-orange-100">
                <span class="text-xl text-zinc-900" style="font-weight: 800;">{{ __('Suhu Mesin') }} </span>
                <span id="temp" class="text-2xl animate-pulse text-orange-500" style="font-weight: 800;">0&deg; C</span>
            </div>
            @if (auth()->user()->role == 'owner')
                <div class="transition-transform active:scale-90 card flex flex-col w-56 h-32 rounded-xl text-center gap-6 pt-4 bg-teal-100">
                    <span class="text-xl text-zinc-900" style="font-weight: 800;">{{ 'Produksi Hr ini' }} </span>
                    <span id="prod" class="text-2xl animate-pulse text-teal-500" style="font-weight: 800;">0 Kg</span>
                </div>
            @endif
        </div>
    </div>
    @if (auth()->user()->role == 'pekerja')
        <div class="lg:translate-y-32 flex justify-center mb-4">
            <form action="#" method="post" id="form-tambah-produksi">
                <div class="flex flex-col lg:flex-row gap-3 lg:gap-2 justify-center items-center">
                    <label for="berat" class="text-sm mr-2" style="font-weight: 600;">Tambah Produksi</label>
                    <input type="text" name="berat" id="berat" placeholder="Masukkan berat dalam gram" class="h-10 w-72 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md placeholder:text-sm text-sm">
                    <input type="hidden" value="{{ isset($machineid) ? $machineid : 'belum terhubung' }}">
                    <button class="w-28 h-10 rounded-full appearance-none bg-red-100 text-red-500 cursor-pointer outline-none border-0" type="submit" id="tambah-produksi">Tambah</button>
                </div>
            </form>
        </div>
    @endif

    @push('styles')
        <style>
            .custom-spin {
                -webkit-animation: rotate-center 0.6s linear infinite forwards;
                animation: rotate-center 0.6s linear infinite forwards;
            }
            .vibrate {
	            -webkit-animation: vibrate-animation 0.5s infinite both;
	            animation: vibrate-animation 0.5s infinite both;
            }
            @-webkit-keyframes vibrate-animation {
                0% {
                    -webkit-transform: translate(0);
                            transform: translate(0);
                }
                10% {
                    -webkit-transform: translate(-2px, -2px);
                            transform: translate(-2px, -2px);
                }
                20% {
                    -webkit-transform: translate(2px, -2px);
                            transform: translate(2px, -2px);
                }
                30% {
                    -webkit-transform: translate(-2px, 2px);
                            transform: translate(-2px, 2px);
                }
                40% {
                    -webkit-transform: translate(2px, 2px);
                            transform: translate(2px, 2px);
                }
                50% {
                    -webkit-transform: translate(-2px, -2px);
                            transform: translate(-2px, -2px);
                }
                60% {
                    -webkit-transform: translate(2px, -2px);
                            transform: translate(2px, -2px);
                }
                70% {
                    -webkit-transform: translate(-2px, 2px);
                            transform: translate(-2px, 2px);
                }
                80% {
                    -webkit-transform: translate(-2px, -2px);
                            transform: translate(-2px, -2px);
                }
                90% {
                    -webkit-transform: translate(2px, -2px);
                            transform: translate(2px, -2px);
                }
                100% {
                    -webkit-transform: translate(0);
                            transform: translate(0);
                }
            }
            @keyframes vibrate-animation {
                0% {
                    -webkit-transform: translate(0);
                            transform: translate(0);
                }
                10% {
                    -webkit-transform: translate(-2px, -2px);
                            transform: translate(-2px, -2px);
                }
                20% {
                    -webkit-transform: translate(2px, -2px);
                            transform: translate(2px, -2px);
                }
                30% {
                    -webkit-transform: translate(-2px, 2px);
                            transform: translate(-2px, 2px);
                }
                40% {
                    -webkit-transform: translate(2px, 2px);
                            transform: translate(2px, 2px);
                }
                50% {
                    -webkit-transform: translate(-2px, -2px);
                            transform: translate(-2px, -2px);
                }
                60% {
                    -webkit-transform: translate(2px, -2px);
                            transform: translate(2px, -2px);
                }
                70% {
                    -webkit-transform: translate(-2px, 2px);
                            transform: translate(-2px, 2px);
                }
                80% {
                    -webkit-transform: translate(-2px, -2px);
                            transform: translate(-2px, -2px);
                }
                90% {
                    -webkit-transform: translate(2px, -2px);
                            transform: translate(2px, -2px);
                }
                100% {
                    -webkit-transform: translate(0);
                            transform: translate(0);
                }
            }
            @-webkit-keyframes rotate-center {
            0% {
                -webkit-transform: rotate(0);
                        transform: rotate(0);
            }
            100% {
                -webkit-transform: rotate(360deg);
                        transform: rotate(360deg);
            }
            }
            @keyframes rotate-center {
            0% {
                -webkit-transform: rotate(0);
                        transform: rotate(0);
            }
            100% {
                -webkit-transform: rotate(360deg);
                        transform: rotate(360deg);
            }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            const id = document.getElementById('machine-id-value')
            const onOffIndicator = document.getElementById('on-off-indicator')
            const onOffIndicatorText = document.getElementById('on-off-indicator-text')
            const ayakanOnOffIndicator = document.getElementById('ayakan-on-off-indicator')
            const ayakanOnOffIndicatorText = document.getElementById('ayakan-on-off-indicator-text')
            const temp = document.getElementById('temp')
            const prod = document.getElementById('prod')
            const btnTambahProduksi = document.getElementById('tambah-produksi')

            // looping untuk terus cek keadaan mesin off /on
            window.addEventListener('DOMContentLoaded', () => {
                if(id.innerText != 'belum terhubung') {
                        setInterval(() => {
                            fetch(`${window.location.origin}/api/machine-state?machineid=${id.innerText}`, {
                                'method': 'GET',
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.isactive) {
                                    onOffIndicator.classList.add('custom-spin')

                                }else if(!data.isactive) {
                                    onOffIndicator.classList.remove('custom-spin')
                                }
                                temp.innerText = `${Math.round(data.temperature)}\u00B0 C`
                                @if(auth()->user()->role == 'owner')
                                    prod.innerText = `${(data.todayprod / 1000).toFixed(2)} Kg`
                                @endif
                            })
                            .catch(err => console.log(err))

                            fetch(`${window.location.origin}/api/ayakan-state?machineid=${id.innerText}`, {
                                'method': 'GET',
                            })
                            .then(response => response.json())
                            .then(isayakanactive => {
                                if(isayakanactive) {
                                    ayakanOnOffIndicator.classList.add('vibrate')

                                }else if(!isayakanactive) {
                                    ayakanOnOffIndicator.classList.remove('vibrate')
                                }
                            })
                            .catch(err => console.log(err))
                        }, 1000);
                } else if(id.innerText == 'belum terhubung') {
                    emitError()
                }
            })
            // toggle on / off mesin ketika di klik
            const toggleState = () => {
                if(id.innerText != 'belum terhubung') {
                    fetch(`${window.location.origin}/api/set-machine-power`, {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({
                            machineid: id.innerText,
                            power: onOffIndicator.classList.contains("custom-spin")
                                ? 0
                                : 1,
                            }),
                        })
                        .then((response) => response.status == 204 ? console.log('on off berhasil') : response.status)
                        .catch(err => console.log(err))
                }else {
                    emitError()
                }
            }

            // toggle on / off ayakan ketika di klik
            const toggleStateAyakan = () => {
                if(id.innerText != 'belum terhubung') {
                    fetch(`${window.location.origin}/api/set-ayakan-power`, {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({
                            machineid: id.innerText,
                            power: ayakanOnOffIndicator.classList.contains("vibrate")
                                ? 0
                                : 1,
                            }),
                        })
                        .then((response) => response.status == 204 ? console.log('on off ayakan berhasil') : response.status)
                        .catch(err => console.log(err))
                }else {
                    emitError()
                }
            }
            @if (auth()->user()->role == 'pekerja')
                btnTambahProduksi.addEventListener('click', () => {
                if(id.innerText != 'belum terhubung') {
                    fetch(`${window.location.origin}/api/set-prod-alt`, {
                                    method: "POST",
                                    headers: { "Content-Type": "application/json" },
                                    body: JSON.stringify({
                                        machineid: id.innerText,
                                        berat: parseFloat(berat.value)
                                        }),
                                    })
                                    .then((response) => {
                                        response.status == 200 ? alert('berhasil') : alert('tambah produksi gagal')
                                        document.location.reload()
                                    })
                                    .catch(err => console.log(err))
                }else {
                    alert('anda belum menghubungkan id mesin')
                }
            @endif
        </script>
    @endpush
@endsection
