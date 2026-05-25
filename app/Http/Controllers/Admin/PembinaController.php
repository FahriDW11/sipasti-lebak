<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Pembina;
use App\Models\Tahanan;
use App\Models\User;

class PembinaController
{
    private $BASE_PATH = 'admin.pembina.';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pembinas = Pembina::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->orderBy('nama', 'asc')->paginate(10);

        return view($this->BASE_PATH . 'index', compact('pembinas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view($this->BASE_PATH . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        DB::transaction(function () use ($request) {
            $photoPath = $this->savePhoto($request);
            $defaultPassword = 'admin123'; // Password default untuk pembina baru
            $user_id = User::create([
                'username' => $this->getUsername(),
                'password' => $defaultPassword,
                'role' => 'pembina',
                'status' => 'active',
                ])->id;        
            Pembina::create($request->only('nama', 'jenis_kelamin', 'email', 'no_telp', 'status') + ['photo' => $photoPath, 'user_id' => $user_id]);
        });

        return redirect('/admin/pembina')->with('success', 'Data pembina berhasil disimmpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tahanans = Tahanan::where('pembina_id', null)->get();
        $pembina = Pembina::findOrFail($id);
        return view($this->BASE_PATH . 'show', compact('pembina', 'tahanans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembina = Pembina::findOrFail($id);
        return view($this->BASE_PATH . 'edit', compact('pembina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pembina = Pembina::findOrFail($id);

        $oldPhoto = $pembina->photo;
        $deleteOldPhoto = $request->has('deleteOldPhoto') && $request->deleteOldPhoto === 'on';
        $pathPhoto = $this->savePhoto($request);
        
        // Jika ada foto baru yang diunggah, simpan dan hapus foto lama jika ada
        if ($pathPhoto) {
            if($oldPhoto) {
                \Storage::disk('public')->delete($oldPhoto);
            }
            $pembina->update($request->only('nama', 'jenis_kelamin', 'email', 'no_telp', 'status') + ['photo' => $pathPhoto]);
        } 
        // Jika tidak ada foto baru, tetapi pengguna memilih untuk menghapus foto lama
        else if($deleteOldPhoto && $oldPhoto) {
            \Storage::disk('public')->delete($oldPhoto);
            $pembina->update($request->only('nama', 'jenis_kelamin', 'email', 'no_telp', 'status') + ['photo' => null]);
        } 
        // Jika tidak ada foto baru dan pengguna tidak memilih untuk menghapus foto lama, tetap gunakan foto lama
        else {
            $pembina->update($request->only('nama', 'jenis_kelamin', 'email', 'no_telp', 'status'));
        }
        
        return redirect('/admin/pembina')->with('success', 'Pembina berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembina = Pembina::findOrFail($id);

        DB::transaction(function () use ($pembina) {
            $user = $pembina->user;

            // Hapus pembina
            $pembina->delete();
            
            // Hapus user terkait
            if ($user) {
                $user->delete();
            }
        });
        
        if($pembina->photo) {
            \Storage::disk('public')->delete($pembina->photo);
        }
        return redirect('/admin/pembina')->with('success', 'Pembina berhasil dihapus');
    }

    public function assignTahanan(Request $request, string $id)
    {
        $request->validate([
            'tahanan_ids' => 'required|array',
            'tahanan_ids.*' => 'exists:tahanans,id',
        ]);
        $pembina = Pembina::findOrFail($id);
        $tahananIds = $request->input('tahanan_ids');
        Tahanan::whereIn('id', $tahananIds)->update(['pembina_id' => $pembina->id]);
        return redirect()->back()->with('success', 'Tahanan berhasil ditugaskan ke pembina');
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
            return $request->file('photo')->store('images/pembina', 'public');
        }
        return null;
    }

    private function getUsername(){
        $year = Carbon::now()->format('y');
        $prefix = $year . '03';

        // Cari username terakhir yang mirip di tahun ini
        $lastUser = User::where('username', 'like', $prefix . '%')
                ->orderBy('username', 'desc')
                ->first();

        if (!$lastUser) {
            $nextNumber = '01';
        } else {
            $lastNumber = substr($lastUser->username, -2);
            $nextNumber = str_pad((int)$lastNumber + 1, 2, '0', STR_PAD_LEFT);
        }

        return $prefix . $nextNumber;
    }
}
