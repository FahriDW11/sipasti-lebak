@extends('layouts.pembina', [
    'active' => 'log-kegiatan',
    'title' => 'Edit Log Kegiatan'
])

@section('pembina-content')

<div class="text-center mb-6">
    <h1 class="text-2xl font-bold mb-4">Edit Log Kegiatan</h1>
</div>

<form action="{{ route('pembina.log-kegiatan.update', $log->id) }}" method="POST" class="flex flex-col w-full max-w-lg mx-auto mb-6">
    @csrf
    @method('PUT')

    <!-- Nama Warga Binaan -->
     <label class="label">
        <span class="label-text">Nama Warga Binaan</span>
    </label>
    <input type="text" class="input w-full border" value="{{ $log->napi->nama }}" disabled />

    <div class="flex flex-col lg:flex-row gap-4 mb-6">
    <!-- kegiatan -->
    <div class="flex-1 flex flex-col gap-2">
        <label class="label">
            <span class="label-text">Kegiatan</span>
        </label>
        <select name="kegiatan_id" class="select select-bordered w-full">
            <option value="" disabled selected>Pilih Kegiatan</option>
            @foreach($kegiatans as $kegiatan)
                <option value="{{ $kegiatan->id }}" {{ $log->kegiatan_id == $kegiatan->id ? 'selected' : '' }}>
                    {{ $kegiatan->nama }}
                </option>
            @endforeach
        </select>
    </div>
    
    <!-- tanggal -->
    <div class="flex flex-col gap-2">
        <label class="label">
            <span class="label-text">Tanggal</span>
        </label>
        <input type="text" id="my-datepicker" name="tanggal" class="input input-bordered w-full" value="{{ $log->tanggal }}" />
    </div>
    </div>

    <!-- catatan -->
    <div class="flex flex-col gap-2 mb-6">
        <label class="label">
            <span class="label-text">Catatan</span>
        </label>
        <textarea name="catatan" class="textarea textarea-bordered w-full" rows="3">{{ $log->catatan }}</textarea>
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
        const napiCheckboxes = document.querySelectorAll('.napi-checkbox');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                // Set semua status checkbox napi mengikuti status checkbox "Pilih Semua"
                napiCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // Antisipasi jika salah satu checklist manual dimatikan, matikan juga centang "Pilih Semua"
            napiCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const totalChecked = document.querySelectorAll('.napi-checkbox:checked').length;
                    
                    selectAllCheckbox.checked = (totalChecked === napiCheckboxes.length);
                    // Membuat status partial (garis tengah) jika baru tercentang sebagian
                    selectAllCheckbox.indeterminate = (totalChecked > 0 && totalChecked < napiCheckboxes.length);
                });
            });
        }
    });
</script>


@endsection