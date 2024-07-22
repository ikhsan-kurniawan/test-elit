<?php

namespace App\Http\Controllers;

use App\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaans = Pekerjaan::orderBy('id', 'asc')->paginate(5);
        return view('pekerjaan.index', compact('pekerjaans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pekerjaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaPekerjaan' => 'required',
            'alamatPekerjaan' => 'required',
            'nomorHP' => 'required',
        ]);

        Pekerjaan::create($request->all());
        return redirect()->route('pekerjaan.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pekerjaan = Pekerjaan::find($id);
        return view('pekerjaan.detail', compact('pekerjaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pekerjaan = Pekerjaan::find($id);
        return view('pekerjaan.edit', [
            'pekerjaan' => $pekerjaan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaPekerjaan' => 'required',
            'alamatPekerjaan' => 'required',
            'nomorHP' => 'required',
        ]);
        $pekerjaan = Pekerjaan::find($id);
        $pekerjaan->namaPekerjaan = $request->get('namaPekerjaan');
        $pekerjaan->alamatPekerjaan = $request->get('alamatPekerjaan');
        $pekerjaan->nomorHP = $request->get('nomorHP');
        $pekerjaan->save();
        return redirect()->route('pekerjaan.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::find($id);
        $pekerjaan->delete();
        return redirect()->route('pekerjaan.index')
            ->with('success', 'Data Pekerjaan berhasil dihapus');
    }
}
