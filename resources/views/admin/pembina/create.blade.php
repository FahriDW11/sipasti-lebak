@extends('layouts.admin', [
    'active' => 'pembina',
    'title' => 'Tambah Pembina'
])

@section('admin-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Pembina</h1>
</div>

<form action="{{ route('admin.pembina.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf

    <!-- Nama -->
    <input name="nama" type="text" required placeholder="Nama Pembina" class="input input-bordered w-full" />


    <select name="jenis_kelamin" class="select select-bordered w-full mt-4" required>
        <option selected disabled>Jenis Kelamin</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>

    <!-- Email -->
    <label class="input validator w-full mt-4">
        <x-lucide-mail class="w-4 lg:w-6 text-gray-400" />
        <input name="email" type="email" placeholder="mail@site.com" required />
    </label>
    <p class="validator-hint hidden">Masukkan Email yang Valid</p>

    <!-- Nomor Telepon -->
    <label class="input validator w-full mt-4">
        <x-lucide-phone class="w-4 lg:w-6 text-gray-400" />
        <input 
        name="no_telp"
        type="tel"
        class="tabular-nums"
        required
        placeholder="Phone"
        pattern="[0-9]*"
        minlength="10"
        maxlength="13"
        title="Must be 10-13 digits" />
    </label>
    <p class="validator-hint">Harus 10-13 digits</p>

    <label class="label text-sm mt-4">Foto</label>
    <input name="photo" type="file" class="file-input w-full mb-4" />


    <button type="submit" class="btn btn-primary">Tambah Pembina</button>
</form>

@endsection