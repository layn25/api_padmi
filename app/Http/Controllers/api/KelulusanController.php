<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bullying;
use App\Models\Kelulusan;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelulusanController extends Controller
{
    public function index()
    {
        $user = Kelulusan::all();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = Kelulusan::find($id);
        if (!$user) {
            return response()->json(['message' => 'Kelulusan tidak ditemukan'], 404);
        }
        return response()->json($user, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|string|max:4',
            'universitas' => 'nullable',
            'siswaId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = Kelulusan::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Kelulusan::find($id);
        if (!$user) {
            return response()->json(['message' => 'Kelulusan tidak ditemukan'], 404);
        }
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|string|max:4',
            'universitas' => 'nullable',
            'siswaId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $siswa = Kelulusan::find($id);
        
        if (!$siswa) {
            return response()->json(['message' => 'Kelulusan tidak ditemukan'], 404);
        }
        $prestasi = Prestasi::where('siswaId', $id);
        $kelulusan = Kelulusan::where('siswaId', $id);
        $pelangaran = Pelanggaran::where('siswaId', $id);
        $bullying = Bullying::where('pelaku', $id);
        $bullying2 = Bullying::where('korban', $id);
        $prestasi->delete();
        $kelulusan->delete();
        $pelangaran->delete();
        $bullying->delete();
        $bullying2->delete();
        
        $siswa->delete();
        return response()->json(['message' => 'Kelulusan berhasil dihapus'], 200);
    }
}
