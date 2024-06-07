<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bullying;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BullyingController extends Controller
{
    public function index()
    {
        $user = Bullying::all();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = Bullying::find($id);
        if (!$user) {
            return response()->json(['message' => 'Kasus tidak ditemukan'], 404);
        }
        return response()->json($user, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'keterangan' => 'nullable',
            'pelaku' => 'required',
            'korban' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = Bullying::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Bullying::find($id);
        if (!$user) {
            return response()->json(['message' => 'Kasus tidak ditemukan'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'keterangan' => 'nullable',
            'pelaku' => 'required',
            'korban' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $siswa = Bullying::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Kasus tidak ditemukan'], 404);
        }
        $siswa->delete();
        return response()->json(['message' => 'Kasus berhasil dihapus'], 200);
    }
}
