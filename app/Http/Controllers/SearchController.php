<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Tahanan;

abstract class SearchController
{
    //
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $tahanans = Tahanan::query()
            ->where('nama', 'LIKE', "%$keyword%")
            ->orWhere('nama_bapak', 'LIKE', "%$keyword%")
            ->orWhereRaw('nama SOUNDS LIKE ?', ["%$keyword%"])
            ->orderByRaw("CASE WHEN nama = ? THEN 1 WHEN nama LIKE ? THEN 2 WHEN nama_bapak LIKE ? THEN 3 ELSE 4 END", [$keyword, "%$keyword%", "%$keyword%"])
            ->get();
        return view('public.search.results', compact('tahanans'));
    }
   

}