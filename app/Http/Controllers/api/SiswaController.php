<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bullying;
use App\Models\Kelulusan;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json($siswa, 200);
    }

    public function show($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        return response()->json($siswa, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nis' => 'required|string',
            'tahun' => 'required|string|max:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $siswa = Siswa::create($request->all());
        return response()->json($siswa, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Siswa::find($id);
        if (!$user) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nis' => 'required|string',
            'tahun' => 'required|string|max:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
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
        return response()->json(['message' => 'User berhasil dihapus'], 200);
    }
}
