@extends('layouts.guest')

@section('slot')
    <div class="login-wrapper w-full flex justify-center lg:items-center h-full">
        <div class="wrapper flex flex-col gap-10 lg:bg-white lg:border-2 lg:border-stone-300/40 w-max h-max p-6 rounded-xl">
            <div class="w-full">
                <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4 items-center">
                    @csrf
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('icons/icon-72x72.png') }}" class="scale-90">
                    </a>
                    <h1 class="text-2xl tracking-wide mb-10 lg:mb-0" style="font-weight: 700; font-variation-settings: 'wght' 700">LOGIN</h1>
                    <div class="flex flex-col gap-2">
                        <label for="username">Username</label>
                        <x-fill-space>
                            <input autocomplete-"off" id="username" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="text" name="username" placeholder="Masukkan username" required>
                        </x-fill-space>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="password">Kata sandi</label>
                        <x-peek-password>
                            <input autocomplete-"off" id="password" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="password" placeholder="Masukkan kata sandi" required>
                        </x-peek-password>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-xs text-red-500" id="error-machine-id">{{ $error }}</p>
                        @endforeach
                    @endif
                    <button type="submit" class="active:bg-sky-300 active:text-sky-600 bg-sky-200 text-sky-500 font-bold w-36 h-10 rounded-lg">Login</button>
                    {{-- <p class="text-xs " id="error-machine-id">Belum punya akun? <a class="text-sky-500" href="{{ route('register') }}">register</a> atau <a class="text-sky-500" href="{{ route('register-owner') }}">register owner</a></p> --}}
                    <p class="text-xs " id="error-machine-id">Anda seorang Owner dan belum memiliki akun?<br>hubungi admin atau <a class="text-sky-500" href="{{ route('register-owner') }}">register secara mandiri</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection
