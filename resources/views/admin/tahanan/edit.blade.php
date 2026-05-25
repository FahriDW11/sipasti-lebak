@extends('layouts.admin', [
    'active' => 'tahanan',
    'title' => 'Edit Tahanan'
])

@section('admin-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Edit Tahanan</h1>
</div>

<form action="{{ route('admin.tahanan.update', $tahanan->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf
    @method('PUT')

    <!-- Nama -->
     <label for="nama" class="label">Nama</label>
    <input name="nama" type="text" required placeholder="Nama Tahanan" class="input input-bordered w-full" value="{{ $tahanan->nama }}" />

    <!-- Nama Ayah -->
    <label for="nama_ayah" class="label mt-4">Nama Ayah</label>
    <input name="nama_ayah" type="text" required placeholder="Nama Ayah Tahanan" class="input input-bordered w-full" value="{{ $tahanan->nama_ayah }}" />

    <!-- Alamat -->
    <label for="alamat" class="label mt-4">Alamat</label>
    <input name="alamat" type="text" required placeholder="Alamat" class="input input-bordered w-full" value="{{ $tahanan->alamat }}" />

    <!-- Tanggal Lahir -->
    <label for="tgl_lahir" class="label mt-4">Tanggal Lahir</label>
    <input name="tgl_lahir" type="date" required placeholder="Tanggal Lahir" class="input input-bordered w-full" value="{{ $tahanan->tgl_lahir }}" />

    <!-- Jenis Kelamin -->
    <label for="jenis_kelamin" class="label mt-4">Jenis Kelamin</label>
    <select name="jenis_kelamin" class="select select-bordered w-full" required>
        <option disabled>Jenis Kelamin</option>
        <option value="L" {{ $tahanan->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ $tahanan->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>

    <!-- Photo -->
    <label for="photo" class="label mt-4">Foto</label>
    <input name="photo" type="file" class="file-input w-full mb-2" value="{{ $tahanan->photo }}"/>
    <div class="flex items-center gap-2 mb-4">
        <input type="checkbox" name="deleteOldPhoto" class="checkbox checkbox-sm {{ $tahanan->photo ? '' : 'hidden' }}" />
        <span class="{{ $tahanan->photo ? '' : 'hidden' }}">Hapus Foto Lama</span>
    </div>
    


    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection