<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('city.index');
    }

    public function getData(Request $request) {
        if ($request->ajax()) {
            $cities = City::select(['id', 'name', 'luas', 'jumlah_penduduk', 'created_at'])->orderBy('id', 'asc');

            return DataTables::of($cities)
                ->addIndexColumn()
                ->addColumn('action', function ($city) {
                    return '<div class="d-flex align-items-center gap-2 justify-content-center">
                        <a href="edit/'. $city->id .'" class="btn btn-warning btn-sm">Edit</a>
                        <button onClick="onDeleteCity(this)" class="btn btn-danger btn-sm delete-btn" data-id="'.$city->id.'">Hapus</button>
                    </div>';
                })
                ->editColumn('luas', function ($city) {
                    return number_format($city->luas);
                })
                ->editColumn('jumlah_penduduk', function ($city) {
                    return number_format($city->jumlah_penduduk);
                })
                ->editColumn('created_at', function ($city) {
                    $date = Carbon::parse($city->created_at);
                    return $date->format('d M Y H:i');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
        return redirect()->to('/')->with('success', 'Berhasil menyimpan data');
    }

    /**
     * Display the specified resource.
     */
    public function export()
    {
        $data = City::get();
        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('city.pdf')->with('data', $data)->render());
        $pdf->render();

        return $pdf->stream('laporan-data-kota.pdf');
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
        return redirect()->to('/')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // City::where('id', $id)->delete();
        // return redirect()->to('/')->with('success', 'Berhasil menghapus data');
        if ($request->ajax()) {
            $city = City::findOrFail($id);
            $city->delete();

            return response()->json(['success' => true]);
        }
        abort(403);
    }
}
