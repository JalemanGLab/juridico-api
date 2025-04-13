<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Handle user login request
     * 
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            // Buscar usuario por identificación y username
            $user = User::where('identification', $request->identification)
                        ->where('username', $request->username)
                        ->where('status', true)
                        ->first();

            // Verificar si existe el usuario y la contraseña es correcta
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Las credenciales proporcionadas son incorrectas.',
                    'errors' => [
                        'credentials' => ['Usuario o contraseña incorrectos']
                    ]
                ], 401, [], JSON_UNESCAPED_UNICODE);
            }

            // Crear token de acceso
            $token = $user->createToken('auth-token')->plainTextToken;

            // Retornar respuesta
            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'identification' => $user->identification,
                        'username' => $user->username,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'role' => $user->role,
                        'status' => $user->status
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error en el servidor',
                'errors' => [
                    'server' => ['Ha ocurrido un error en el servidor']
                ]
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Handle user logout request
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Revocar el token actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cierre de sesión exitoso'
        ], 200);
    }

    /**
     * Get authenticated user information
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'identification' => $request->user()->identification,
                    'username' => $request->user()->username,
                    'email' => $request->user()->email,
                    'phone' => $request->user()->phone,
                    'role' => $request->user()->role,
                    'status' => $request->user()->status
                ]
            ]
        ], 200);
    }
}