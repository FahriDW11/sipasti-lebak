<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Napi;
use App\Models\Pembina;

class NapiController
{
    private $BASE_PATH = 'admin.napi.';

    // display a listing of napi
    public function index(Request $request) {
        $search = $request->input('search');
        $napis = Napi::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->orderBy('nama', 'asc')->paginate(10);

        return view($this->BASE_PATH . 'index', compact('napis'));
    }

    // Show the form for creating new napi.
    public function create() {
        $pembinas = Pembina::get(['id', 'nama'])->sortBy('nama');
        return view($this->BASE_PATH . 'create', compact('pembinas'));
    }

    // Store new napi
    public function store(Request $request) {
        $pathPhoto = $this->savePhoto($request);
        Napi::create($request->only('nama','nama_ayah', 'pembina_id', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => $pathPhoto]);
        return redirect('/admin/napi')->with('success', 'Data napi berhasil disimmpan');
    }

    // Detail napi
    public function show(string $id) {
        $napi = Napi::findOrFail($id);
        return view($this->BASE_PATH . 'show', compact('napi'));
    }

    // Show the form for editing napi.
    public function edit(string $id) {
        $napi = Napi::findOrFail($id);
        $pembinas = Pembina::get(['id', 'nama'])->sortBy('nama');
        return view($this->BASE_PATH . 'edit', compact('napi', 'pembinas'));
    }

    // Update napi
    public function update(Request $request, string $id) {
        $napi = Napi::findOrFail($id);

        $oldPhoto = $napi->photo;
        $deleteOldPhoto = $request->has('deleteOldPhoto') && $request->deleteOldPhoto === 'on';
        $pathPhoto = $this->savePhoto($request);
        
        // Jika ada foto baru yang diunggah, simpan dan hapus foto lama jika ada
        if ($pathPhoto) {
            if($oldPhoto) {
                \Storage::disk('public')->delete($oldPhoto);
            }
            $napi->update($request->only('nama','nama_ayah','pembina_id', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => $pathPhoto]);
        } 
        // Jika tidak ada foto baru, tetapi pengguna memilih untuk menghapus foto lama
        else if($deleteOldPhoto && $oldPhoto) {
            \Storage::disk('public')->delete($oldPhoto);
            $napi->update($request->only('nama','nama_ayah', 'pembina_id', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => null]);
        } 
        // Jika tidak ada foto baru dan pengguna tidak memilih untuk menghapus foto lama, tetap gunakan foto lama
        else {
            $napi->update($request->only('nama','nama_ayah', 'pembina_id', 'alamat', 'jenis_kelamin', 'tgl_lahir'));
        }
        
        return redirect('/admin/napi')->with('success', 'Napi berhasil diperbarui');
    }

    // Remove napi
    public function destroy(string $id) {
        $napi = Napi::findOrFail($id);
        if($napi->photo) {
            \Storage::disk('public')->delete($napi->photo);
        }
        $napi->delete();
        return redirect('/admin/napi');
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
            return $request->file('photo')->store('images/napi', 'public');
        }
        return null;
    }
}
