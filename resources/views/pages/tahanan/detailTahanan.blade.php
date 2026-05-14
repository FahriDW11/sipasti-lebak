<h2 class="text-blue-100">{{ $tahanan->nama }}</h2>
<p>Alamat: {{ $tahanan->alamat }}</p>
<p>Jenis Kelamin: {{ $tahanan->jenis_kelamin }}</p>
<p>Tanggal Lahir: {{ $tahanan->tgl_lahir }}</p>
<p>Pembina: {{ $tahanan->pembina->nama ?? 'Tidak ada' }}</p>