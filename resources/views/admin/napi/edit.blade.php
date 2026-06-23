@extends('layouts.admin', [
    'active' => 'napi',
    'title' => 'Edit Warga Binaan'
])

@section('admin-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Edit Warga Binaan</h1>
</div>

<form action="{{ route('admin.napi.update', $napi->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf
    @method('PUT')

    <!-- Nama -->
     <label for="nama" class="label">Nama</label>
    <input name="nama" type="text" required placeholder="Nama Warga Binaan" class="input input-bordered w-full" value="{{ $napi->nama }}" />

    <!-- Nama Ayah -->
    <label for="nama_ayah" class="label mt-4">Nama Ayah</label>
    <input name="nama_ayah" type="text" required placeholder="Nama Ayah Warga Binaan" class="input input-bordered w-full" value="{{ $napi->nama_ayah }}" />

    <!-- Pembina -->
    <label for="pembina_id" class="label mt-4">Pembina</label>
    <select name="pembina_id" class="select select-bordered w-full" required>
        <option disabled>Pembina</option>
        @foreach($pembinas as $item)
            <option value="{{ $item->id }}" {{ $napi->pembina_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
        @endforeach
    </select>

    <!-- Alamat -->
    <label for="alamat" class="label mt-4">Alamat</label>
    <input name="alamat" type="text" required placeholder="Alamat" class="input input-bordered w-full" value="{{ $napi->alamat }}" />

    <!-- Tanggal Lahir -->
    <label for="tgl_lahir" class="label mt-4">Tanggal Lahir</label>
    <input name="tgl_lahir" type="text" id="my-datepicker" required placeholder="Tanggal Lahir" class="input input-bordered w-full" value="{{ $napi->tgl_lahir }}" />

    <!-- Jenis Kelamin -->
    <label for="jenis_kelamin" class="label mt-4">Jenis Kelamin</label>
    <select name="jenis_kelamin" class="select select-bordered w-full" required>
        <option disabled>Jenis Kelamin</option>
        <option value="L" {{ $napi->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ $napi->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>

    <!-- Photo -->
    <label for="photo" class="label mt-4">Foto</label>
    <input name="photo" type="file" class="file-input w-full mb-2" value="{{ $napi->photo }}"/>
    <div class="flex items-center gap-2 mb-4">
        <input type="checkbox" name="deleteOldPhoto" class="checkbox checkbox-sm {{ $napi->photo ? '' : 'hidden' }}" />
        <span class="{{ $napi->photo ? '' : 'hidden' }}">Hapus Foto Lama</span>
    </div>
    


    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection