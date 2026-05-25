@extends('layouts.admin', [
    'active' => 'kegiatan',
    'title' => 'Edit Kegiatan'
])

@section('admin-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kegiatan</h1>
</div>

<form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf
    @method('PUT')

    <!-- Nama Kegiatan -->
    <label for="nama" class="label">Nama Kegiatan<span class="text-red-500">*</span></label>
    <input name="nama" type="text" required placeholder="Nama Kegiatan" class="input input-bordered w-full" value="{{ $kegiatan->nama }}"/>

    <!-- Deskripsi -->
    <label for="deskripsi" class="label mt-4">Deskripsi</label>
    <textarea name="deskripsi" placeholder="Deskripsi Kegiatan" class="textarea textarea-bordered w-full">{{ $kegiatan->deskripsi }}</textarea>  

    <!-- Photo -->
    <label for="photo" class="label mt-4">Foto</label>
    <input name="photo" type="file" class="file-input w-full mb-2"/>
    <div class="flex items-center gap-2 {{ $kegiatan->photo ? '' : 'hidden' }}">
        <input type="checkbox" name="deleteOldPhoto" class="checkbox checkbox-sm" />
        <span>Hapus Foto Lama</span>
    </div>

    <button type="submit" class="btn btn-primary mt-6">Simpan</button>

</form>

@endsection