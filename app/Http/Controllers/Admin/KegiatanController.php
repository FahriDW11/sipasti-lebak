<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Kegiatan;

class KegiatanController
{
    private $BASE_VIEW = 'admin.kegiatan.';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kegiatans = Kegiatan::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->orderBy('created_at', 'asc')->paginate(12);

        return view($this->BASE_VIEW . 'index', compact('kegiatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view($this->BASE_VIEW . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $pathPhoto = $this->savePhoto($request);
        Kegiatan::create($request->only('nama','deskripsi') + ['photo' => $pathPhoto]);
        return redirect('/admin/kegiatan')->with('success', 'Data kegiatan berhasil disimmpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
            $kegiatan = Kegiatan::findOrFail($id);
            return view($this->BASE_VIEW . 'show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kegiatan = Kegiatan::findOrFail($id);
        return view($this->BASE_VIEW . 'edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $kegiatan = Kegiatan::findOrFail($id);

        $oldPhoto = $kegiatan->photo;
        $deleteOldPhoto = $request->has('deleteOldPhoto') && $request->deleteOldPhoto === 'on';
        $pathPhoto = $this->savePhoto($request);
        
        // Jika ada foto baru yang diunggah, simpan dan hapus foto lama jika ada
        if ($pathPhoto) {
            if($oldPhoto) {
                \Storage::disk('public')->delete($oldPhoto);
            }
            $kegiatan->update($request->only('nama', 'deskripsi') + ['photo' => $pathPhoto]);
        } 
        // Jika tidak ada foto baru, tetapi pengguna memilih untuk menghapus foto lama
        else if($deleteOldPhoto && $oldPhoto) {
            \Storage::disk('public')->delete($oldPhoto);
            $kegiatan->update($request->only('nama', 'deskripsi') + ['photo' => null]);
        } 
        // Jika tidak ada foto baru dan pengguna tidak memilih untuk menghapus foto lama, tetap gunakan foto lama
        else {
            $kegiatan->update($request->only('nama', 'deskripsi'));
        }
        
        return redirect('/admin/kegiatan')->with('success', 'kegiatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kegiatan = Kegiatan::findOrFail($id);
        if($kegiatan->photo) {
            \Storage::disk('public')->delete($kegiatan->photo);
        }
        $kegiatan->delete();
        return redirect('/admin/kegiatan');
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
            return $request->file('photo')->store('images/kegiatan', 'public');
        }
        return null;
    }
}
