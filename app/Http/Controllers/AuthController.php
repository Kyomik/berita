<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Berikan response user data dan key_kredensial (contohnya token JWT)
            return response()->json([
                'id_user' => $user->id_user,
                'nama' => $user->nama_user,
                'username' => $user->username,
                'password' => $user->password, // Jangan pernah mengembalikan password asli di response production!
                'key_kredensial' => 'example_token',
            ]);
        }

        return response()->json(['message' => 'Login failed'], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
        ]);

        $user = User::create([
            'nama_user' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hak_akses' => 'pembaca',
        ]);

        return response()->json([
            'id_user' => $user->id_user,
            'nama' => $user->nama_user,
            'username' => $user->username,
            'password' => $user->password,
        ]);
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
            'hak_akses' => 'required|in:admin,user_admin',
        ]);

        $user = User::create([
            'nama_user' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hak_akses' => $request->hak_akses,
        ]);

        return response()->json([
            'id_user' => $user->id_user,
            'nama' => $user->nama_user,
            'username' => $user->username,
            'password' => $user->password,
            'hak_akses' => $user->hak_akses,
        ]);
    }
}
