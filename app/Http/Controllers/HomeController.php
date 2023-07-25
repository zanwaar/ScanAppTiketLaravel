<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\EtiketImport;
use App\Models\Etiket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function import(Request $request)
    {
        // dd($request->file);
        Excel::import(new EtiketImport, $request->file);
    }
    public function download()
    {
        return Excel::download(new UsersExport, 'datatiket.xlsx');
    }
    public function index()
    {
        $ada1 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET FISIK']);
        $ada2 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET EARLY BIRD']);
        $ada3 = Etiket::latest()->where(['status' => 1, 'jenis' => 'TIKET OTS']);
        // dd($ada1->count(), $ada2->count());
        return view('home', ['data1' => $ada1->count(), 'data2' => $ada2->count(), 'data3' => $ada3->count()]);
    }

    public function show($id)
    {
        $ada = Etiket::latest()
            ->where('barcode', $id);
        //return response
        if ($ada->count() > 0) {
            $data = $ada->get();
            if ($data[0]['status'] === 1) {
                return response()->json([
                    'icon' => 'warning',
                    'title' => 'Telah Terpakai',
                    'success' => 'Tiket Tidak Berlaku Lagi',
                ], 200);
            } else {
                $ada->update([
                    'status' => 1,
                    'ket' => 'scan app',
                ]);
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Tiket valid',
                    'success' => 'Berhasil ditambahkan',
                ], 200);
            }
        }
        return response()->json([
            'success' => 121,
        ], 404);
    }
}
