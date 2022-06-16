@extends('layouts.app')

@section('slot')
    @push('top')
        <h1 style="font-weight: 800;">{{ __('Pengaturan') }}</h1>
        <p class="text-xs hidden">ID mesin : <span id="machine-id-value">{{ isset($machineid) ? $machineid : 'belum terhubung' }}</span></p>
    @endpush
    <div class="settings w-full lg:mt-4 flex lg:items-start justify-center items-center flex-col lg:flex-row gap-2">
        <div class="wrapper flex flex-col bg-zinc-100 w-max h-max p-6 rounded-xl">
            <span class="text-lg font-bold text-center">{{ auth()->user()->role == 'owner' ? 'AKUN DAN MESIN' : 'GANTI KATA SANDI' }}</span>
            <div class="machine-setting w-full flex justify-center mt-5">
                @if (auth()->user()->role == 'owner')
                    <form action="{{ route('bond') }}" method="POST" class="flex flex-col gap-4 items-center">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <x-help-tooltip>
                                <label for="machineid-label">ID mesin</label>
                            </x-help-tooltip>
                            <x-peek-password>
                                <input class="disabled:bg-zinc-400 invalid:border-red-500 h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="machineid" placeholder="masukkan id mesin" required {{ isset($machineid) ? 'readonly' : '' }} value="{{ $machineid == null ? '' : $machineid }}">
                            </x-peek-password>
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
                @endif
            </div>
            <div class="account-setting w-full mt-5">
                <form action="{{ route('changepassword') }}" method="POST" class="flex flex-col gap-4 items-center">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="current_password">Kata sandi lama</label>
                        <x-peek-password>
                            <input id="current_password" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="current_password" placeholder="masukkan sandi lama" required>
                            @foreach ($errors->all() as $error)
                                <p class="text-xs text-red-500" id="error-password-change">{{ $error }}</p>
                            @endforeach
                            @if (Session::has('change-success'))
                                <p class="text-xs text-green-500" id="success-password-change">{{ Session::get('change-success') }}</p>
                            @endif
                            @php
                                Session::forget('change-success');
                            @endphp
                        </x-peek-password>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="new_password">Kata sandi baru</label>
                        <x-peek-password>
                            <input id="new_password" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="new_password" required placeholder="masukkan sandi baru">
                        </x-peek-password>
                    </div>
                    <button type="submit" class="active:bg-sky-300 active:text-sky-600 bg-sky-200 text-sky-500 font-bold w-36 h-10 rounded-lg">Simpan Sandi</button>
                </form>
            </div>
        </div>
        @if (auth()->user()->role == 'owner')
            <div class="wrapper flex flex-col bg-zinc-100 w-max h-max p-6 rounded-xl">
                <span class="text-lg font-bold text-center">DATA AKUN PEKERJA</span>
                <form action="{{ route('registerpekerjafromowner') }}" method="post" class="flex flex-col gap-4 items-center mt-5">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="pekerja_username">Username</label>
                        <x-fill-space>
                            <input id="pekerja_username" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="text" name="pekerja_username" required placeholder="username pekerja">
                        </x-fill-space>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="pekerja_password">Kata sandi</label>
                        <x-peek-password>
                            <input id="pekerja_password" class="h-10 w-68 pl-2 outline-none focus:border-sky-300 border-2 border-zinc-200 bg-zinc-200 rounded-md" type="password" name="pekerja_password" required placeholder="sandi pekerja">
                        </x-peek-password>
                    </div>
                    @if (Session::has('owner-settings-pekerja-success'))
                        <p class="text-xs text-green-500">{{ Session::get('owner-settings-pekerja-success') }}</p>
                        @php
                            Session::forget('owner-settings-pekerja-success');
                        @endphp
                    @elseif (Session::has('owner-settings-pekerja-failed'))
                        <p class="text-xs text-green-500">{{ Session::get('owner-settings-pekerja-failed') }}</p>
                        @php
                            Session::forget('owner-settings-pekerja-failed');
                        @endphp
                    @endif
                    <button type="submit" class="active:bg-sky-300 active:text-sky-600 bg-sky-200 text-sky-500 font-bold w-36 h-10 rounded-lg">Simpan Data</button>
                </form>
                <div class="flex justify-center flex-col mt-5">
                    <table class="table text-sm border border-black/20 text-center">
                        <thead class="border border-black/20">
                            <tr>
                                <th class="border border-black/20">#</th>
                                <th class="border border-black/20">Nama</th>
                                <th class="border border-black/20">Hapus</th>
                            </tr>
                        </thead>
                        <tbody class="border-collapse">
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="border border-black/20">{{ $loop->iteration }}</td>
                                    <td class="border border-black/20">{{ $employee->username }}</td>
                                    <td class="flex gap-3 justify-center border border-black/20">
                                        <div title="reset password" id="reset-password-pekerja" class="cursor-pointer" onclick="toggleModalResetPasswordPekerja({{ $employee->id }})">
                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7.207 2.543a1 1 0 0 1 0 1.414L5.414 5.75h7.836a8 8 0 1 1-8 8 1 1 0 1 1 2 0 6 6 0 1 0 6-6H5.414l1.793 1.793a1 1 0 0 1-1.414 1.414l-3.5-3.5a1 1 0 0 1 0-1.414l3.5-3.5a1 1 0 0 1 1.414 0Z" fill="#0284c7"/></svg>
                                        </div>
                                        <div id="hapus-pekerja" title="Hapus" class="cursor-pointer" onclick="this.firstElementChild.submit()">
                                            <form action="{{ route('deletepekerja') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="pekerja_id" value="{{ $employee->id }}">
                                            </form>
                                            <svg class="fill-red-500" width="24" height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21.5 6a1 1 0 0 1-.883.993L20.5 7h-.845l-1.231 12.52A2.75 2.75 0 0 1 15.687 22H8.313a2.75 2.75 0 0 1-2.737-2.48L4.345 7H3.5a1 1 0 0 1 0-2h5a3.5 3.5 0 1 1 7 0h5a1 1 0 0 1 1 1Zm-7.25 3.25a.75.75 0 0 0-.743.648L13.5 10v7l.007.102a.75.75 0 0 0 1.486 0L15 17v-7l-.007-.102a.75.75 0 0 0-.743-.648Zm-4.5 0a.75.75 0 0 0-.743.648L9 10v7l.007.102a.75.75 0 0 0 1.486 0L10.5 17v-7l-.007-.102a.75.75 0 0 0-.743-.648ZM12 3.5A1.5 1.5 0 0 0 10.5 5h3A1.5 1.5 0 0 0 12 3.5Z"/></svg>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
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
