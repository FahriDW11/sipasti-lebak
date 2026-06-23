@extends('layouts.admin', [
    'active' => 'napi',
    'title' => 'Data Warga Binaan'
])

@section('admin-content')


<div class="flex items-center justify-between mb-4"> 
    <form action="{{ route('admin.napi.index') }}" method="GET">
        <div class="flex gap-2">
            <input type="search" name="search" placeholder="Cari Warga Binaan..." value="{{ request('search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            <button type="submit" class="btn btn-sm btn-primary text-xs tooltip tooltip-left" data-tip="Cari Warga Binaan">
                <x-lucide-search class="w-4 lg:w-6 text-white" />
            </button>
        </div>
    </form>
    <a href="{{ route('admin.napi.create') }}" class="btn btn-primary btn-sm text-xs tooltip tooltip-left" data-tip="Tambah Warga Binaan">
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
        @forelse($napis as $napi)
        <tr>
            <td>
                <div class="avatar">
                    <div class="w-16 rounded">
                        <img src="{{ $napi->photo ? asset('storage/' . $napi->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $napi->nama }}">
                    </div>
                </div>
            </td>
            <td class="truncate w-full max-w-xs">{{ $napi->nama }} bin {{ $napi->nama_ayah }}</td>
            <td>
                <div class="flex gap-0.5 justify-end">
                    <a href="{{ route('admin.napi.show', $napi->id) }}" class="btn btn-sm rounded-xl tooltip tooltip-top btn-info" data-tip="Lihat"><x-lucide-eye class="w-4 text-white" /></a>
                    <a href="{{ route('admin.napi.edit', $napi->id) }}" class="btn btn-sm rounded-xl tooltip tooltip-top btn-warning" data-tip="Edit"><x-lucide-edit class="w-4 text-white" /></a>
                    <button type="button" onclick="openDeleteModal('{{ route('admin.napi.destroy', $napi->id) }}', '{{ $napi->nama }}')" class="btn btn-sm rounded-xl tooltip tooltip-top tooltip-error btn-error" data-tip="Hapus">
                        <x-lucide-trash class="w-4 text-white" />
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak Ada Data Warga Binaan.</td>
        </tr>
        @endforelse
    </table>
</div>
@include('layouts.partials.pagination',['datas'=>$napis])

@endsection