<form action="/tahanan/{{ $tahanan->id }}" method="POST">
    @csrf
    @method('PUT')
    <input name="nama" type="text" required placeholder="Nama Tahanan" value="{{ $tahanan->nama }}">
    <input name="nama_ayah" type="text" required placeholder="Nama Ayah" value="{{ $tahanan->nama_ayah }}">
    <input name="alamat" type="text" required placeholder="Alamat" value="{{ $tahanan->alamat }}">
    <input name="jenis_kelamin" type="text" required placeholder="Jenis Kelamin" value="{{ $tahanan->jenis_kelamin }}">
    <input name="tgl_lahir" type="date" required placeholder="Tanggal Lahir" value="{{ $tahanan->tgl_lahir }}">
    <button type="submit">Update</button>
</form>