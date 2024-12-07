<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function listPegawai(Request $request)
    {
        $data = Pegawai::query();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                return $btn;
            })
            ->addColumn('image', function ($row) {
                $files = json_decode($row->files);
                $imageUrl = isset($files[0]) ? Storage::url($files[0]) : null;
                return $imageUrl ? $imageUrl : null;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addPegawai(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'kemampuan' => 'required|array',
            'tanggal_aktif' => 'required|date',
            'file.*' => 'mimes:jpg,png,gif,pdf|max:2048',
        ]);
        // dd($request->kemampuan);
        $pegawai = new Pegawai();
        $pegawai->name = $request->name;
        $pegawai->tanggal_aktif = \Carbon\Carbon::createFromFormat('m/d/Y', $request->tanggal_aktif)->format('Y-m-d');;
        $pegawai->kemampuan = implode(',', $request->kemampuan);
        $pegawai->save();


        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filename = $file->store('files', 'public'); // Store in storage/app/public/files
                $filePaths[] = $filename;
            }
        }

        $pegawai->files = json_encode($filePaths); // or implode(',', $filePaths) for a string
        $pegawai->save();

        return response()->json(['message' => 'Data successfully saved'], 200);
    }
}
