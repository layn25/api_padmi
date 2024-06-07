<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = Akun::all();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = Akun::find($id);
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }
        return response()->json($user, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nip' => 'nullable',
            'password' => 'required',
            'whatsapp' => 'nullable',
            'is_admin' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = Akun::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Akun::find($id);
        if (!$user) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nip' => 'nullable',
            'password' => 'required',
            'whatsapp' => 'nullable',
            'is_admin' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $siswa = Akun::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
        $siswa->delete();
        return response()->json(['message' => 'User berhasil dihapus'], 200);
    }
}
