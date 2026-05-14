<form action="/tahanan" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="nama" type="text" required placeholder="Nama Tahanan">
    <input name="nama_ayah" type="text" required placeholder="Nama Ayah">
    <input name="alamat" type="text" required placeholder="Alamat">
    <input name="jenis_kelamin" type="text" required placeholder="Jenis Kelamin">
    <input name="tgl_lahir" type="date" required placeholder="Tanggal Lahir">
    <span>Foto:</span><input name="photo" type="file">
    <button type="submit">Tambah Tahanan</button>
</form>