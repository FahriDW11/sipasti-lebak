@extends('layouts.admin', ['active'=>'tahanan','title' => 'Detail Tahanan'])

@section('admin-content')

<div class="flex flex-col items-center gap-4 mb-4">
    <a class="btn btn-accent self-start" href="{{ route('admin.tahanan.index') }}">
        <x-lucide-arrow-left class="w-4 lg:w-6 text-white"/>
    </a>
    <div class="avatar">
        <div class="w-40 rounded">
            <img src="{{ $tahanan->photo ? asset('storage/' . $tahanan->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $tahanan->nama }}">
        </div>
    </div>
    <div class="w-full max-w-md">
        <h2 class="text-xl font-bold text-center">{{ $tahanan->nama }}</h2>
        <table class="table table-sm mt-2 md:table-md">
            <tbody>
                <tr>
                    <th>Nama Ayah</th>
                    <td>{{ $tahanan->nama_ayah }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $tahanan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $tahanan->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $tahanan->alamat }}</td>
                </tr>
                <tr>
                    <th>Pembina</th>
                    <td>
                        @if($tahanan->pembina)
                           <a href="{{ route('admin.pembina.show', $tahanan->pembina->id) }}" class="link">{{ $tahanan->pembina->nama }}</a> 
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