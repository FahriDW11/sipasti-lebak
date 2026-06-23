@extends('layouts.admin', ['active'=>'napi','title' => 'Detail Warga Binaan'])

@section('admin-content')

<div class="flex flex-col items-center gap-4 mb-4">
    <a class="btn btn-accent self-start" href="{{ route('admin.napi.index') }}">
        <x-lucide-arrow-left class="w-4 lg:w-6 text-white"/>
    </a>
    <div class="avatar">
        <div class="w-40 rounded">
            <img src="{{ $napi->photo ? asset('storage/' . $napi->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $napi->nama }}">
        </div>
    </div>
    <div class="w-full max-w-md">
        <h2 class="text-xl font-bold text-center">{{ $napi->nama }}</h2>
        <table class="table table-sm mt-2 md:table-md">
            <tbody>
                <tr>
                    <th>Nama Ayah</th>
                    <td>{{ $napi->nama_ayah }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $napi->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $napi->tgl_lahir_format }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $napi->alamat }}</td>
                </tr>
                <tr>
                    <th>Pembina</th>
                    <td>
                        @if($napi->pembina)
                           <a href="{{ route('admin.pembina.show', $napi->pembina->id) }}" class="link">{{ $napi->pembina->nama }}</a> 
                        @else
                            <span class="text-sm italic text-gray-500">Belum ada pembina</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection