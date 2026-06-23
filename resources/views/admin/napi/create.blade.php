@extends('layouts.admin', [
    'active' => 'napi',
    'title' => 'Tambah Warga Binaan'
])

@section('admin-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Warga Binaan</h1>
</div>

<form action="{{ route('admin.napi.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf

    <!-- Nama -->
    <label for="nama" class="label">Nama<span class="text-red-500">*</span></label>
    <input name="nama" type="text" required placeholder="Nama Warga Binaan" class="input input-bordered w-full"/>

    <!-- Nama Ayah -->
    <label for="nama_ayah" class="label mt-4">Nama Ayah<span class="text-red-500">*</span></label>
    <input name="nama_ayah" type="text" required placeholder="Nama Ayah Warga Binaan" class="input input-bordered w-full"  />

    <!-- Pembina -->
    <label for="pembina_id" class="label mt-4">Pembina</label>
    <select name="pembina_id" class="select select-bordered w-full" required>
        <option disabled selected value=null>Pembina</option>
        @foreach($pembinas as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
    </select>
    
    <!-- Tanggal Lahir -->
    <label for="tgl_lahir" class="label mt-4">Tanggal Lahir<span class="text-red-500">*</span></label>
    <input name="tgl_lahir" type="text" id="my-datepicker" required placeholder="Tanggal Lahir" class="input input-bordered w-full text-base-content" />

    <!-- Jenis Kelamin -->
    <label for="jenis_kelamin" class="label mt-4">Jenis Kelamin<span class="text-red-500">*</span></label>
    <select name="jenis_kelamin" class="select select-bordered w-full" required>
        <option selected disabled>Jenis Kelamin</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>
    
    <!-- Alamat -->
    <label for="alamat" class="label mt-4">Alamat</label>
    <input name="alamat" type="text" placeholder="Alamat" class="input input-bordered w-full" />

    <!-- Photo -->
    <label for="photo" class="label mt-4">Foto</label>
    <input name="photo" type="file" class="file-input w-full mb-6"/>
    


    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection