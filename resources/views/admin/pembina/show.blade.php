@extends('layouts.admin', [
    'active' => 'pembina',
    'title' => $pembina->nama
])

@section('admin-content')
<div class="flex flex-col items-center gap-4 mb-4">
    <a class="btn btn-accent self-start" href="{{ route('admin.pembina.index') }}">
        <x-lucide-arrow-left class="w-4 lg:w-6 text-white"/>
    </a>
    <div class="avatar">
        <div class="w-40 rounded">
            <img src="{{ $pembina->photo ? asset('storage/' . $pembina->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $pembina->nama }}">
        </div>
    </div>
    <div class="w-full max-w-md">
        <h2 class="text-xl font-bold text-center">{{ $pembina->nama }}</h2>
        <table class="table table-sm mt-2 md:table-md">
            <tbody>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $pembina->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pembina->email }}</td>
                </tr>
                <tr>
                    <th>No. Telp</th>
                    <td>{{ $pembina->no_telp }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="divider"></div>

<!-- Tahanan Binaan -->
<div class="w-full mt-4">
    <div class="mx-2 mt-2 p-4 rounded-box border border-base-content/5 bg-base-100">
        <div class="flex">
            <h3 class="text-lg font-bold">Tahanan Binaan</h3>
            <button class="btn btn-sm btn-primary ml-auto tooltip tooltip-left" data-tip="Tambah Tahanan" onclick="document.getElementById('tambahTahananModal').showModal()">
                <x-lucide-plus class="w-4 lg:w-6 text-white" />
            </button>
        </div>
        <p class="text-sm">{{ $pembina->tahanans->count() }} tahanan</p>
        <table class="table table-sm mt-2 md:table-md">
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
            </tr>
            @forelse($pembina->tahanans as $tahanan)
            <tr>
                <td>{{ $tahanan->nama }}</td>
                <td>{{ $tahanan->umur }}</td>
                <td>{{ $tahanan->alamat }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Tidak ada tahanan binaan.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>

<dialog class="modal" id="tambahTahananModal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Tambah Tahanan Binaan</h3>
        
        <form action="{{ route('admin.pembina.assign-tahanan', $pembina->id) }}" method="post">
            @csrf
            
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold">Pilih Tahanan Binaan (Bisa Lebih dari Satu)</span>
                </label>

                <select id="pilih-tahanan" name="tahanan_ids[]" multiple placeholder="Ketik nama atau nomor tahanan..." autocomplete="off">
                    @foreach($tahanans as $tahanan)
                        <option value="{{ $tahanan->id }}">{{ $tahanan->nama }} bin {{ $tahanan->nama_ayah}}</option>
                    @endforeach
                </select>
            </div>

            <div class="modal-action flex justify-end gap-2 mt-4">
                <button type="button" class="btn btn-sm btn-error" onclick="document.getElementById('tambahTahananModal').close()">Batal</button>
                
                <button type="submit" class="btn btn-sm btn-primary">Tugaskan Tahanan</button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


<script>
    // Pastikan DOM sudah termuat sepenuhnya
    document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#pilih-tahanan", {
            plugins: ['remove_button'], // Memunculkan tombol silang (x) untuk menghapus pilihan
            maxItems: null,             // Null artinya tidak ada batasan jumlah pilihan
            create: false,              // User tidak bisa menambahkan opsi teks baru di luar daftar
            render: {
                no_results: function(data, escape) {
                    return '<div class="no-results text-sm p-2 text-gray-500">Data tahanan tidak ditemukan...</div>';
                }
            }
        });
    });
</script>
@endsection