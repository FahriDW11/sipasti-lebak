<h2 class="text-blue-100">{{ $tahanan->nama }}</h2>
<img src="{{ asset('storage/' . $tahanan->photo) }}" alt="Foto Tahanan" class="w-32 h-32 object-cover rounded-full mb-4">
<p>{{ $tahanan->photo }}</p>
<p>Alamat: {{ $tahanan->alamat }}</p>
<p>Jenis Kelamin: {{ $tahanan->jenis_kelamin }}</p>
<p>Tanggal Lahir: {{ $tahanan->tgl_lahir }}</p>
<p>Pembina: {{ $tahanan->pembina->nama ?? 'Tidak ada' }}</p>