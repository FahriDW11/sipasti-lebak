<dialog id="logout_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Konfirmasi Keluar</h3>
        <p class="py-4">Apakah Anda yakin ingin keluar dari aplikasi?</p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Batal</button>
            </form>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-error">Keluar</button>
            </form>
        </div>
    </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
</dialog>