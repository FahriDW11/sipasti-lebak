@extends('layouts.admin', [
    'active' => 'tahanan',
    'title' => 'Data Tahanan'
])

@section('admin-content')


<div class="flex items-center justify-between mb-4"> 
    <form action="{{ route('admin.tahanan.index') }}" method="GET">
        <div class="flex gap-2">
            <input type="search" name="search" placeholder="Cari Tahanan..." value="{{ request('search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            <button type="submit" class="btn btn-sm btn-primary text-xs tooltip tooltip-left" data-tip="Cari Tahanan">
                <x-lucide-search class="w-4 lg:w-6 text-white" />
            </button>
        </div>
    </form>
    <a href="{{ route('admin.tahanan.create') }}" class="btn btn-primary btn-sm text-xs tooltip tooltip-left" data-tip="Tambah Tahanan">
        <x-lucide-plus class="w-4 lg:w-6 text-white" />
    </a>
</div>

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        @forelse($tahanans as $tahanan)
        <tr>
            <td>
                <div class="avatar">
                    <div class="w-16 rounded">
                        <img src="{{ $tahanan->photo ? asset('storage/' . $tahanan->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $tahanan->nama }}">
                    </div>
                </div>
            </td>
            <td class="truncate w-full max-w-xs">{{ $tahanan->nama }} bin {{ $tahanan->nama_ayah }}</td>
            <td>
                <div class="flex gap-0.5 justify-end">
                    <a href="{{ route('admin.tahanan.show', $tahanan->id) }}" class="btn btn-sm btn-info"><x-lucide-eye class="w-4 lg:w-6 text-white" /></a>
                    <a href="{{ route('admin.tahanan.edit', $tahanan->id) }}" class="btn btn-sm btn-warning"><x-lucide-edit class="w-4 lg:w-6 text-white" /></a>
                    <button type="button" onclick="openDeleteModal('{{ route('admin.tahanan.destroy', $tahanan->id) }}', '{{ $tahanan->nama }}')" class="btn btn-sm btn-error">
                        <x-lucide-trash class="w-4 lg:w-6 text-white" />
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak Ada Data Tahanan.</td>
        </tr>
        @endforelse
    </table>
</div>
@include('layouts.partials.pagination',['datas'=>$tahanans])

@endsection