<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AlertController extends Controller
{
    /**
     * Display a listing of the alerts.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $alerts = Alert::latest('alert_datetime')->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'alerts' => $alerts
                ]
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener las alertas',
                'errors' => [
                    'server' => ['Ha ocurrido un error en el servidor']
                ]
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Store a newly created alert in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'operation' => 'required|string',
                'credit_bank' => 'required|string',
                'assignment' => 'required|string',
                'customer_type' => 'required|string',
                'customer_name' => 'required|string',
                'description' => 'required|string',
                'alert_datetime' => 'required|date'
            ]);

            $alert = Alert::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Alerta creada exitosamente',
                'data' => [
                    'alert' => $alert
                ]
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la alerta',
                'errors' => [
                    'server' => ['Ha ocurrido un error en el servidor']
                ]
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Display the specified alert.
     *
     * @param Alert $alert
     * @return JsonResponse
     */
    public function show(Alert $alert): JsonResponse
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'alert' => $alert
                ]
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener la alerta',
                'errors' => [
                    'server' => ['Ha ocurrido un error en el servidor']
                ]
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Update the specified alert in storage.
     *
     * @param Request $request
     * @param Alert $alert
     * @return JsonResponse
     */
    public function update(Request $request, Alert $alert): JsonResponse
    {
        try {
            $validated = $request->validate([
                'operation' => 'sometimes|required|string',
                'credit_bank' => 'sometimes|required|string',
                'assignment' => 'sometimes|required|string',
                'customer_type' => 'sometimes|required|string',
                'customer_name' => 'sometimes|required|string',
                'description' => 'sometimes|required|string',
                'alert_datetime' => 'sometimes|required|date'
            ]);

            $alert->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Alerta actualizada exitosamente',
                'data' => [
                    'alert' => $alert
                ]
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar la alerta',
                'errors' => [
                    'server' => ['Ha ocurrido un error en el servidor']
                ]
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Remove the specified alert from storage.
     *
     * @param Alert $alert
     * @return JsonResponse
     */
    public function destroy(Alert $alert): JsonResponse
    {
        try {
            $alert->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Alerta eliminada exitosamente'
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar la alerta',
                'errors' => [
                    'server' => ['Ha ocurrido un error en el servidor']
                ]
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
