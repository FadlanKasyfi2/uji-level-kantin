<?php

namespace App\Http\Controllers;

use App\Kantin;
use App\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class KantinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kantin = Kantin::with('jenis')->get();
        return view('kantin/tabel_makanan', compact('kantin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kantin = Tipe::all();
        return view ('kantin/form', compact('kantin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Kantin;
        $add->nama_menu = $request->nama_menu;
        $add->harga = $request->harga;
        $add->tipe = $request->tipe;

        $file = $request->file('gambar');

        $ext = $file->getClientOriginalName();
        $file->move('upload/', $ext);
        $add->gambar = $ext;
        $add->save();
        
        return redirect('tabel_makanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kantin  $kantin
     * @return \Illuminate\Http\Response
     */
    public function show(Kantin $kantin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kantin  $kantin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kantin = Tipe::all();
        $edit = Kantin::find($id);
        return view('kantin/edit', compact('edit', 'kantin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kantin  $kantin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = Kantin::find($request->id);
        $update->nama_menu = $request->nama_menu;
        $update->harga = $request->harga;
        $update->tipe = $request->tipe;

        $file = $request->file('gambar');

        $ext = $file->getClientOriginalName();
        $file->move('upload/', $ext);
        $update->gambar = $ext;

        $update->save();
        
        return redirect('tabel_makanan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kantin  $kantin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Kantin::find($id);
        $del->delete();
        return back();
    }
}
