@extends('layouts.guest')

@section('slot')
    <div class="login-wrapper w-full flex justify-center lg:items-center h-full">
        <div class="wrapper flex flex-col gap-10 lg:bg-white lg:border-2 lg:border-stone-300/40 w-max h-max p-6 rounded-xl">
            <div class="w-full">
                <form action="{{ route('register-owner') }}" method="post" class="flex flex-col gap-4 items-center">
                    @csrf
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('icons/icon-72x72.png') }}" class="scale-90">
                    </a>
                    <h1 class="text-2xl tracking-wide mb-10 lg:mb-0" style="font-weight: 700; font-variation-settings: 'wght' 700">REGISTER OWNER</h1>
                    <div class="flex flex-col gap-2">
                        <label for="username_owner">Username</label>
                        <x-fill-space>
                            <input required id="username_owner" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="text" name="username_owner" placeholder="Masukkan username">
                        </x-fill-space>
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-help-tooltip>
                            <label for="machineid">ID Mesin</label>
                        </x-help-tooltip>
                        <x-peek-password>
                            <input required id="machineid" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="machineid" placeholder="Masukkan id mesin">
                        </x-peek-password>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="password_owner">Kata sandi</label>
                        <x-peek-password>
                            <input required id="password_owner" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="password_owner" placeholder="Masukkan kata sandi">
                        </x-peek-password>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="confirm_password_owner">Konfirmasi kata sandi</label>
                        <x-peek-password>
                            <input required id="confirm_password_owner" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="confirm_password_owner" placeholder="Masukkan ulang kata sandi">
                        </x-peek-password>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-xs text-red-500" id="error-machine-id">{{ $error }}</p>
                        @endforeach
                    @endif
                    <button type="submit" class="active:bg-sky-300 active:text-sky-600 bg-sky-200 text-sky-500 font-bold w-36 h-10 rounded-lg">Register</button>
                    {{-- <p class="text-xs ">Sudah punya akun? <a class="text-sky-500" href="{{ route('login') }}">login</a>, atau register sebagai <a class="text-sky-500" href="{{ route('register') }}">pekerja</a></p> --}}
                    <p class="text-xs ">Sudah punya akun? <a class="text-sky-500" href="{{ route('login') }}">login</a></p>
                </form>
            </div>
        </div>
</div>
@push('scripts')
    <script>
    tippy('#help-id-mesin', {
        content: '<strong style="color: #F5C642;">ID mesin</strong> digunakan untuk menghubungkan akun Anda dengan mesin pembuat bubuk cangkang telur anda. <br><br>Misalnya Anda ingin melihat data statistik dari mesin Anda, maka id mesin ini akan dikirim ke server untuk menentukan data statistik dari mesin yang mana yang akan diperlihatkan karena <strong style="color: #F5C642;">setiap owner memiliki id mesin yang berbeda-beda.</strong>',
        trigger: 'mouseenter click',
        placement: 'bottom',
        allowHTML: true
    });
    </script>
@endpush
@endsection
