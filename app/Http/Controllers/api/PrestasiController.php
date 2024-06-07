<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrestasiController extends Controller
{
    
    public function index()
    {
        $user = Prestasi::all();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = Prestasi::find($id);
        if (!$user) {
            return response()->json(['message' => 'Prestasi tidak ditemukan'], 404);
        }
        return response()->json($user, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'kategori' => 'nullable',
            'capaian' => 'nullable',
            'siswaId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = Prestasi::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Prestasi::find($id);
        if (!$user) {
            return response()->json(['message' => 'Prestasi tidak ditemukan'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'kategori' => 'nullable',
            'capaian' => 'nullable',
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
        $siswa = Prestasi::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Prestasi tidak ditemukan'], 404);
        }
        $siswa->delete();
        return response()->json(['message' => 'Prestasi berhasil dihapus'], 200);
    }
}
