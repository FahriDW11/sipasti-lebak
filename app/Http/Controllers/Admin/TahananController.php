<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Tahanan;

class TahananController
{
    private $BASE_PATH = 'admin.tahanan.';

    // display a listing of tahanan
    public function index(Request $request) {
        $search = $request->input('search');
        $tahanans = Tahanan::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->orderBy('nama', 'asc')->paginate(10);

        return view($this->BASE_PATH . 'index', compact('tahanans'));
    }

    // Show the form for creating new tahanan.
    public function create() {
        return view($this->BASE_PATH . 'create');
    }

    // Store new tahanan
    public function store(Request $request) {
        $pathPhoto = $this->savePhoto($request);
        Tahanan::create($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => $pathPhoto]);
        return redirect('/admin/tahanan')->with('success', 'Data tahanan berhasil disimmpan');
    }

    // Detail tahanan
    public function show(string $id) {
        $tahanan = Tahanan::findOrFail($id);
        return view($this->BASE_PATH . 'show', compact('tahanan'));
    }

    // Show the form for editing tahanan.
    public function edit(string $id) {
        $tahanan = Tahanan::findOrFail($id);
        return view($this->BASE_PATH . 'edit', compact('tahanan'));
    }

    // Update tahanan
    public function update(Request $request, string $id) {
        $tahanan = Tahanan::findOrFail($id);

        $oldPhoto = $tahanan->photo;
        $deleteOldPhoto = $request->has('deleteOldPhoto') && $request->deleteOldPhoto === 'on';
        $pathPhoto = $this->savePhoto($request);
        
        // Jika ada foto baru yang diunggah, simpan dan hapus foto lama jika ada
        if ($pathPhoto) {
            if($oldPhoto) {
                \Storage::disk('public')->delete($oldPhoto);
            }
            $tahanan->update($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => $pathPhoto]);
        } 
        // Jika tidak ada foto baru, tetapi pengguna memilih untuk menghapus foto lama
        else if($deleteOldPhoto && $oldPhoto) {
            \Storage::disk('public')->delete($oldPhoto);
            $tahanan->update($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => null]);
        } 
        // Jika tidak ada foto baru dan pengguna tidak memilih untuk menghapus foto lama, tetap gunakan foto lama
        else {
            $tahanan->update($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir'));
        }
        
        return redirect('/admin/tahanan')->with('success', 'Tahanan berhasil diperbarui');
    }

    // Remove tahanan
    public function destroy(string $id) {
        $tahanan = Tahanan::findOrFail($id);
        if($tahanan->photo) {
            \Storage::disk('public')->delete($tahanan->photo);
        }
        $tahanan->delete();
        return redirect('/admin/tahanan');
    }

    private function savePhoto(Request $request){
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'File harus berformat jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ],);

        if($request->hasFile('photo')) {
            return $request->file('photo')->store('images/tahanan', 'public');
        }
        return null;
    }
}
