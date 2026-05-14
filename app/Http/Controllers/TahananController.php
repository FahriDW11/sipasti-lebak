<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tahanan;

class TahananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahanans = Tahanan::all();
        return view('pages.tahanan.index', compact('tahanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.tahanan.addTahanan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Tahanan::create($request->all());
        return redirect('/tahanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tahanan = Tahanan::findOrFail($id);
        // return view('pages.tahanan.detailTahanan', compact('tahanan'));
        return view('pages.tahanan.detailTahanan', compact('tahanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tahanan = Tahanan::findOrFail($id);
        return view('pages.tahanan.editTahanan', compact('tahanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $tahanan = Tahanan::findOrFail($id);
        $tahanan->update($request->all());
        return redirect('/tahanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tahanan = Tahanan::findOrFail($id);
        $tahanan->delete();
        return redirect('/tahanan');
    }
}
