<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Session::flash('search',  $request->search);
        $search = $request->search;
        if(strlen($search)) {
            $data = City::where('name', 'like', "%$search%")
            ->orderBy('id', 'asc')
            ->paginate(5);
        } else {
            $data = City::orderBy('id', 'asc')->paginate(5);
        }
        return view('city.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name',  $request->name);
        Session::flash('luas',  $request->luas);
        Session::flash('penduduk',  $request->penduduk);
        $request->validate([
            'name'=>'required',
            'luas'=>'required|numeric',
            'penduduk'=>'required|numeric',
        ], [
            'name.required'=>'Silahkan masukan nama kota',
            'luas.required'=>'Luas tidak boleh kosong!',
            'penduduk.required'=>'Jumlah penduduk tidak boleh kosong!',
        ]);
        $data  = [
        'name'=> $request->name,
        'luas'=> $request->luas,
        'jumlah_penduduk'=> $request->penduduk,
        ];
        City::create($data);
        return redirect()->to('city')->with('success', 'Berhasil menyimpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = City::where('id', $id)->first();
        return view('city.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'luas'=>'required|numeric',
            'penduduk'=>'required|numeric',
        ], [
            'name.required'=>'Silahkan masukan nama kota',
            'luas.required'=>'Luas tidak boleh kosong!',
            'penduduk.required'=>'Jumlah penduduk tidak boleh kosong!',
        ]);
        $data  = [
        'name'=> $request->name,
        'luas'=> $request->luas,
        'jumlah_penduduk'=> $request->penduduk,
        ];
        City::where('id', $id)->update($data);
        return redirect()->to('city')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::where('id', $id)->delete();
        return redirect()->to('city')->with('success', 'Berhasil menghapus data');
    }
}
