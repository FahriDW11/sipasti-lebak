<dialog id="deleteDataModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg text-error">Konfirmasi Hapus Data</h3>
        
        <p class="py-4">Apakah Anda yakin ingin menghapus <span id="nama-terhapus" class="font-bold"></span>?</p>
        
        <div class="modal-action">
            <form id="form-hapus" action="" method="POST">
                @csrf
                @method('DELETE') <button type="button" class="btn" onclick="document.getElementById('deleteDataModal').close()">Batal</button>
                <button type="submit" class="btn btn-error">Ya, Hapus</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    function openDeleteModal(action, nama) {
        // 1. Ambil elemen form dan teks nama di dalam modal
        const form = document.getElementById('form-hapus');
        const txtNama = document.getElementById('nama-terhapus');
        
        // 2. Set teks nama agar user tidak salah hapus
        txtNama.innerText = nama;
        
        // 3. Ubah atribut action form secara dinamis mengarah ke route destroy Laravel
        // Sesuaikan dengan struktur URL/Route destroy kamu, misal: /admin/pembina/{id}
        form.action = action;
        
        // 4. Munculkan modal DaisyUI
        document.getElementById('deleteDataModal').showModal();
    }
</script>