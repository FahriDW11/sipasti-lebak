@extends('layouts.pembina', [
    'active' => 'log-kegiatan',
    'title' => 'Detail Log Kegiatan'
])

@section('pembina-content')

<div class="flex items-center justify-between mb-4 mx-4"> 
    <h1 class="text-lg font-semibold">Detail Log Kegiatan</h1>
    <a href="{{ route('pembina.log-kegiatan.index') }}" class="btn btn-sm btn-secondary text-xs tooltip tooltip-left" data-tip="Kembali ke Daftar Log Kegiatan">
        <x-lucide-arrow-left class="w-4 lg:w-6 text-white" />
    </a>
</div>

<table class="table w-full max-w-lg mx-auto card bg-base-100 shadow-md">
    <tr>
        <td class="w-1/4">Warga Binaan</td>
        <td class="w-1/6">:</td>
        <td>{{ $log->napi->nama }} bin {{ $log->napi->nama_ayah }}</td>
    </tr>
    <tr>
        <td>Kegiatan</td>
        <td>:</td>
        <td>{{ $log->kegiatan->nama }}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>{{ $log->tanggal_format }}</td>
    </tr>
    <tr>
        <td>Catatan</td>
        <td>:</td>
        <td>{{ $log->catatan ?? '-' }}</td>
    </tr>
</table>


@endsection