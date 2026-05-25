@extends('layouts.pembina', [
    'active' => 'log-kegiatan',
    'title' => 'Tambah Log Kegiatan'
])

@section('pembina-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Log Kegiatan</h1>
</div>

<form action="{{ route('pembina.log-kegiatan.store') }}" method="POST" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf

    <div class="flex gap-4">
    <!-- kegiatan -->
    <div class="flex-1 flex flex-col gap-2 mb-6">
        <label class="label">
            <span class="label-text">Kegiatan</span>
        </label>
        <select name="kegiatan_id" class="select select-bordered w-full">
            <option value="" disabled selected>Pilih Kegiatan</option>
            @foreach($kegiatans as $kegiatan)
                <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }}</option>
            @endforeach
        </select>
    </div>
    
    <!-- tanggal -->
    <div class="flex flex-col gap-2 mb-6">
        <label class="label">
            <span class="label-text">Tanggal</span>
        </label>
        <input type="date" name="tanggal" class="input input-bordered w-full" />
    </div>
    </div>

    <!-- Tahanan -->
    <div class="flex flex-col w-full mb-6">
        <label class="label flex justify-between items-center mb-2">
            <span class="label-text font-semibold">Pilih Tahanan yang Mengikuti Kegiatan</span>
        </label>

        <div class="border border-base-300 rounded-xl bg-base-50 overflow-hidden">
            
            <div class="p-3 bg-base-200 border-b border-base-300 flex items-center gap-3">
                <input type="checkbox" id="select-all" class="checkbox checkbox-primary checkbox-sm" />
                <label for="select-all" class="label-text font-bold cursor-pointer select-none">Pilih Semua Tahanan</label>
            </div>

            <div class="max-h-64 overflow-y-auto divide-y divide-base-200">
                @forelse($tahanans as $tahanan)
                    <label class="flex items-center gap-4 p-3 hover:bg-base-100 cursor-pointer transition-colors select-none">
                        <input 
                            type="checkbox" 
                            name="tahanan_ids[]" 
                            value="{{ $tahanan->id }}" 
                            class="checkbox checkbox-primary checkbox-sm tahanan-checkbox" 
                        />
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-base-content">{{ $tahanan->nama }}</span>
                            <span class="text-xs text-base-content/70">ID: REG-{{ str_pad($tahanan->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </label>
                @empty
                    <div class="p-4 text-center text-sm text-base-content/70">
                        Belum ada tahanan yang ditugaskan di bawah pembinaan Anda.
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- catatan -->
    <div class="flex flex-col gap-2 mb-6">
        <label class="label">
            <span class="label-text">Catatan</span>
        </label>
        <textarea name="catatan" class="textarea textarea-bordered w-full" rows="3"></textarea>
    </div>

    <!-- submit -->
     <div class="flex justify-end gap-2 pt-4">
        <a href="{{ route('pembina.log-kegiatan.index') }}" class="btn btn-ghost btn-sm">Batal</a>
        <button type="submit" class="btn btn-primary btn-sm">Simpan Log Kegiatan</button>
    </div>

</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const tahananCheckboxes = document.querySelectorAll('.tahanan-checkbox');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                // Set semua status checkbox tahanan mengikuti status checkbox "Pilih Semua"
                tahananCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // Antisipasi jika salah satu checklist manual dimatikan, matikan juga centang "Pilih Semua"
            tahananCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const totalChecked = document.querySelectorAll('.tahanan-checkbox:checked').length;
                    
                    selectAllCheckbox.checked = (totalChecked === tahananCheckboxes.length);
                    // Membuat status partial (garis tengah) jika baru tercentang sebagian
                    selectAllCheckbox.indeterminate = (totalChecked > 0 && totalChecked < tahananCheckboxes.length);
                });
            });
        }
    });
</script>


@endsection