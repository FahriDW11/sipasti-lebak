@extends('layouts.admin', [
    'active' => 'kegiatan',
    'title' => 'Tambah Kegiatan'
])

@section('admin-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Kegiatan</h1>
</div>

<form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf

    <!-- Nama Kegiatan -->
    <label for="nama" class="label">Nama Kegiatan<span class="text-red-500">*</span></label>
    <input name="nama" type="text" required placeholder="Nama Kegiatan" class="input input-bordered w-full"/>

    <!-- Deskripsi -->
    <label for="deskripsi" class="label mt-4">Deskripsi</label>
    <textarea name="deskripsi" placeholder="Deskripsi Kegiatan" class="textarea textarea-bordered w-full"></textarea>  

    <!-- Photo -->
    <label for="photo" class="label mt-4">Foto</label>
    <input name="photo" type="file" class="file-input w-full mb-6"/>

    <button type="submit" class="btn btn-primary">Simpan</button>

</form>

@endsection