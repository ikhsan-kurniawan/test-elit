<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Pekerjaan;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('namaMahasiswa', 'LIKE', '%' . $search . '%')
                ->orWhere('nimMahasiswa', 'LIKE', '%' . $search . '%')
                ->orWhere('angkatanMahasiswa', 'LIKE', '%' . $search . '%')
                ->orWhere('judulskripsiMahasiswa', 'LIKE', '%' . $search . '%');
        }

        $mahasiswas = $query->orderBy('id', 'asc')->paginate(5);
        return view('mahasiswa.index', compact('mahasiswas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pekerjaans = Pekerjaan::get();
        return view('mahasiswa.create', compact('pekerjaans'));
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
            'namaMahasiswa' => 'required',
            'nimMahasiswa' => 'required|numeric',
            'angkatanMahasiswa' => 'required',
            'pekerjaanMahasiswa' => 'required',
            'judulskripsiMahasiswa' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
            'fotoMahasiswa' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'ijazahMahasiswa' => 'nullable|file|mimes:pdf|max:1024',
        ]);

        $fotoMahasiswa = $request->file('fotoMahasiswa') ? $request->file('fotoMahasiswa')->store('public/fotos') : null;
        $ijazahMahasiswa = $request->file('ijazahMahasiswa') ? $request->file('ijazahMahasiswa')->store('public/ijazahs') : null;

        $data = $request->all();
        $data['fotoMahasiswa'] = $fotoMahasiswa;
        $data['ijazahMahasiswa'] = $ijazahMahasiswa;

        Mahasiswa::create($data);
        return redirect()->route('mahasiswa.index')
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
        $mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.detail', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $pekerjaans = Pekerjaan::get();
        return view('mahasiswa.edit', [
            'pekerjaans' => $pekerjaans,
            'mahasiswa' => $mahasiswa,
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
            'namaMahasiswa' => 'required',
            'nimMahasiswa' => 'required',
            'angkatanMahasiswa' => 'required',
            'pekerjaanMahasiswa' => 'required',
            'judulskripsiMahasiswa' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
            'fotoMahasiswa' => 'nullable|mimes:jpg,png,jpeg|max:1024',
            'ijazahMahasiswa' => 'nullable|file|mimes:pdf|max:1024',
        ]);


        $mahasiswa = Mahasiswa::find($id);

        if ($request->hasFile('fotoMahasiswa')) {
            if ($mahasiswa->fotoMahasiswa) {
                Storage::delete($mahasiswa->fotoMahasiswa);
            }
            $mahasiswa->fotoMahasiswa = $request->file('fotoMahasiswa')->store('public/fotos');
        }

        if ($request->hasFile('ijazahMahasiswa')) {
            if ($mahasiswa->ijazahMahasiswa) {
                Storage::delete($mahasiswa->ijazahMahasiswa);
            }
            $mahasiswa->ijazahMahasiswa = $request->file('ijazahMahasiswa')->store('public/ijazahs');
        }

        $mahasiswa->namaMahasiswa = $request->get('namaMahasiswa');
        $mahasiswa->nimMahasiswa = $request->get('nimMahasiswa');
        $mahasiswa->angkatanMahasiswa = $request->get('angkatanMahasiswa');
        $mahasiswa->pekerjaanMahasiswa = $request->get('pekerjaanMahasiswa');
        $mahasiswa->judulskripsiMahasiswa = $request->get('judulskripsiMahasiswa');
        $mahasiswa->pembimbing1 = $request->get('pembimbing1');
        $mahasiswa->pembimbing2 = $request->get('pembimbing2');
        $mahasiswa->save();
        return redirect()->route('mahasiswa.index')
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
        $mahasiswa = Mahasiswa::find($id);

        if ($mahasiswa->fotoMahasiswa) {
            Storage::delete($mahasiswa->fotoMahasiswa);
        }
        if ($mahasiswa->ijazahMahasiswa) {
            Storage::delete($mahasiswa->ijazahMahasiswa);
        }
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data Alumni berhasil dihapus');
    }
}
