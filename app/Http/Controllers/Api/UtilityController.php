<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function rajaongkirProvince(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ]
        ]);

        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content, true);

        return response()->json($data);
    }

    public function rajaongkirCity(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
            'query' => [
                'province' => $request->province
            ]
        ]);

        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content, true);

        return response()->json($data);
    }

    public function rajaongkirCost(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
            'form_params' => [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier
            ]
        ]);

        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content, true);

        return response()->json($data);
    }

    public function paymentInfo(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $metode_pembayaran = MetodePembayaran::find($id);
            if ($metode_pembayaran) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data metode pembayaran berhasil didapatkan',
                    'data' => $metode_pembayaran
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Metode pembayaran tidak ditemukan'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'ID metode pembayaran tidak boleh kosong'
            ], 400);
        }
    }
}
