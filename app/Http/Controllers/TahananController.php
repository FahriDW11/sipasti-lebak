<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Tahanan;

class TahananController extends Controller
{
    // display a listing of tahanan
    public function index() {
        $tahanans = Tahanan::all();
        return view('pages.tahanan.index', compact('tahanans'));
    }

    // Show the form for creating new tahanan.
    public function create() {
        return view('pages.tahanan.addTahanan');
    }

    // Store new tahanan
    public function store(Request $request) {
        $pathPhoto = $this->savePhoto($request);
        Tahanan::create($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => $pathPhoto]);
        return redirect('/tahanan')->with('success', 'Data tahanan berhasil disimmpan');
    }

    // Detail tahanan
    public function show(string $id) {
        $tahanan = Tahanan::findOrFail($id);
        return view('pages.tahanan.detailTahanan', compact('tahanan'));
    }

    // Show the form for editing tahanan.
    public function edit(string $id) {
        $tahanan = Tahanan::findOrFail($id);
        return view('pages.tahanan.editTahanan', compact('tahanan'));
    }

    // Update tahanan
    public function update(Request $request, string $id) {
        $tahanan = Tahanan::findOrFail($id);

        $oldPhoto = $tahanan->photo;
        $deleteOldPhoto = $request->has('deleteOldPhoto') && $request->deleteOldPhoto === 'on';
        $pathPhoto = $this->savePhoto($request);
        
        if ($pathPhoto) {
            if($oldPhoto) {
                \Storage::disk('public')->delete($oldPhoto);
            }
            $tahanan->update($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => $pathPhoto]);
        } else if($deleteOldPhoto && $oldPhoto) {
            \Storage::disk('public')->delete($oldPhoto);
            $tahanan->update($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir') + ['photo' => null]);
        } else {
            $tahanan->update($request->only('nama','nama_ayah', 'alamat', 'jenis_kelamin', 'tgl_lahir'));
        }
        
        return redirect('/tahanan')->with('success', 'Tahanan berhasil diperbarui');
    }

    // Remove tahanan
    public function destroy(string $id) {
        $tahanan = Tahanan::findOrFail($id);
        if($tahanan->photo) {
            \Storage::disk('public')->delete($tahanan->photo);
        }
        $tahanan->delete();
        return redirect('/tahanan');
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
