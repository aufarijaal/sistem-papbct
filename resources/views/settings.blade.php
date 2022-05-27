@extends('layouts.app')

@section('slot')
    @push('top')
        <h1 style="font-weight: 780; font-variation-settings: 'wght' 780">{{ __('Pengaturan') }}</h1>
        <p class="text-xs">ID mesin : <span id="machine-id-value">{{ isset($machineid) ? $machineid : 'belum terhubung' }}</span></p>
    @endpush
    <div class="settings w-full lg:mt-4 flex justify-center">
        <div class="wrapper flex flex-col gap-10 lg:bg-zinc-100 w-max h-max p-6 rounded-xl">
            <div class="machine-setting w-full flex justify-center">
                <form action="{{ route('bond') }}" method="POST" class="flex flex-col gap-4 items-center">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="machineid-label">Konfigurasi ID mesin</label>
                        <input class="disabled:bg-zinc-400 invalid:border-red-500 h-10 w-72 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="text" name="machineid" placeholder="masukkan id mesin" required {{ isset($machineid) ? 'readonly' : '' }} value="{{ $machineid == null ? '' : $machineid }}">
                        <input type="hidden" name="option" value="{{ $machineid == null ? 'bind' : 'unbind' }}">
                        @if (Session::has('failed'))
                            <p class="text-xs text-red-500" id="error-machine-id">{{ Session::get('failed') }}</p>
                            @php
                                Session::forget('failed');
                            @endphp
                        @endif
                        @if (Session::has('success'))
                        <p class="text-xs text-green-500" id="success-machine-id">{{ Session::get('success') }}</p>
                        @php
                            Session::forget('success');
                        @endphp
                        @endif
                    </div>
                    <button class="font-bold w-36 h-10 rounded-lg active:bg-sky-300 active:text-sky-600 bg-sky-200 text-sky-500" type="submit">{{ isset($machineid) ? 'Hapus' : 'Simpan ID' }}</button>
                </form>
            </div>
            <div class="account-setting w-full">
                <form action="{{ route('changepassword') }}" method="POST" class="flex flex-col gap-4 items-center">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="current_password">Kata sandi lama</label>
                        <input id="current_password" class="h-10 w-72 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="current_password" placeholder="masukkan sandi lama" required>
                        @foreach ($errors->all() as $error)
                            <p class="text-xs text-red-500" id="error-password-change">{{ $error }}</p>
                        @endforeach
                        @if (Session::has('change-success'))
                            <p class="text-xs text-green-500" id="success-password-change">{{ Session::get('change-success') }}</p>
                        @endif
                        @php
                            Session::forget('change-success');
                        @endphp
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="new_password">Kata sandi baru</label>
                        <input id="new_password" class="h-10 w-72 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="new_password" required placeholder="masukkan sandi baru">
                    </div>
                    <button type="submit" class="active:bg-sky-300 active:text-sky-600 bg-sky-200 text-sky-500 font-bold w-36 h-10 rounded-lg">Simpan Sandi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
